<?php

/**
 * LinkFamilyTree object
 *
 * Handle a FamilyTree to display the relationship between 2 persons.
 * Find the closest common ancestor
 *
 * @file    LinkFamilyTree.php
 * @ingroup SemanticGenealogy
 *
 * @licence GNU GPL v2+
 * @author  Thomas Pellissier Tanon <thomaspt@hotmail.fr>
 * @author  Thibault Taillandier <thibault@taillandier.name>
 */
class LinkFamilyTree extends FamilyTree {

	const NAME = 'link';

	protected $person2;
	protected $personName2;

	/**
	 * Setter of person2
	 *
	 * @param string $personName2 the page name of the person
	 *
	 * @see PersonPageValues::getPageFromName
	 *
	 * @return void
	 */
	public function setPerson2( $personName2 ) {
		$this->personName2 = $personName2;
		$this->person2 = PersonPageValues::getPageFromName( $personName2 );
	}

	/**
	 * Get the relation between the 2 persons (this->person and $this->person2)
	 *
	 * @return array an array of 2 trees
	 */
	private function getLink() {
		$tree1 = [];
		$tree2 = [];
		$tree1[0][1] = new PersonPageValues( $this->person );
		$tree2[0][1] = new PersonPageValues( $this->person2 );

		for ( $i = 0; $tree1[$i] !== null && $tree2[$i] !== null; $i++ ) {
			$tree1 = $this->addGenInTree( $i + 1, $tree1 );
			if ( $tree1[$i + 1] !== null ) {
				$result = $this->compareGenWith( $tree1[$i + 1], $tree2, $i );
				if ( $result !== null ) {
					list( $sosa1, $sosa2 ) = $result;
					break;
				}
			}

			$tree2 = $this->addGenInTree( $i + 1, $tree2 );
			if ( $tree2[$i + 1] !== null ) {
				$result = $this->compareGenWith( $tree2[$i + 1], $tree1, $i + 1 );
				if ( $result !== null ) {
					list( $sosa2, $sosa1 ) = $result;
					break;
				}
			}
		}

		if ( $result !== null ) {
			return [ $this->getListOfAncestors( $sosa1, $tree1 ),
				$this->getListOfAncestors( $sosa2, $tree2 ) ];
		}
	}

	/**
	 * Compare a generation with a tree
	 *
	 * @param array   $gen  the generation number
	 * @param array[] $tree
	 * @param integer $max  the max depth
	 *
	 * @return array an array of 2 SOSA
	 */
	private function compareGenWith( array $gen, array $tree, $max ) {
		for ( $i = $max; $i >= 0; $i-- ) {
			if ( isset( $tree[$i] ) ) {
				foreach ( $tree[$i] as $sosa2 => $person2 ) {
					if ( $person2 !== null ) {
						foreach ( $gen as $sosa1 => $person1 ) {
							if ( $person1 !== null ) {
								if ( $person1->title->equals( $person2->title ) ) {
									return [ $sosa1, $sosa2 ];
								}
							}
						}
					}
				}
			}
		}
	}

	/**
	 * Get the list of ancestors for a sosa number
	 *
	 * @param integer $sosa the SOSA number
	 * @param array   $tree the ancestors tree
	 *
	 * @return array the list of ancestors
	 */
	private function getListOfAncestors( $sosa, array $tree ) {
		$num = 1;
		$temp = 1;
		for ( $i = 0; $num < $sosa; $i++ ) {
			$temp *= 2;
			$num += $temp;
		}

		$list = [];
		for ( $j = $i; $j >= 0; $j-- ) {
			$list[] = $tree[$j][$sosa];
			$sosa /= 2;
		}
		return $list;
	}

	/**
	 * Render the tree
	 *
	 * @return void
	 */
	public function render() {
		$output = $this->getOutput();
		$tree = $this->getLink();

		if ( !$tree ) {
			throw new SemanticGenealogyException(
				wfMessage( 'semanticgenealogy-specialfamilytree-error-nolinkfound',
				$this->personName, $this->personName2 )->text()
			);
		}
		list( $tree1, $tree2 ) = $tree;

		$length = max( count( $tree1 ), count( $tree2 ) );
		$output->addHTML( '<table class="decorator-'.$this->decorator.' smg-tree-root-link">' );
		$output->addHTML( '<tr><td colspan="'.pow( 2, $length-1 ).'">' );
		$person = $tree1[0];
		if ( $person->fullname instanceof SMWDIBlob ) {
			$output->addWikiText( $person->getDescriptionWikiText( false, $this->displayName ) );
		}
		$output->addHTML( '</td></tr>' );

		$index1 = 0;
		$index2 = 0;
		for ( $i = 1; $i < $length; $i++ ) {
			$output->addHTML( '<tr>' );

			$person = isset( $tree1[$i] ) ? $tree1[$i] : false;
			$index1 = $this->renderPerson( $person, $length, $i, $index1, 'left' );

			$person = isset( $tree2[$i] ) ? $tree2[$i] : false;
			$index2 = $this->renderPerson( $tree2[$i], $length, $i, $index2, 'right' );

			$output->addHTML( '</tr>' );
		}
		$output->addHTML( '</table>' );
	}

	private function renderPerson( $person, $length, $i, $index, $side ) {
		$colspan = pow( 2, $length-$i-1 );
		$colwidth = pow( 2, $i-1 );
		$output = $this->getOutput();
		$emptytd = '<td colspan="'.$colspan.'" style="min-width: 30px">&nbsp;</td>';

		if ( ! $person ) {
			$output->addHTML( str_repeat( $emptytd, $colwidth ) );
			return $index*2;
		}
		$class = "";

		$index = $i == 1 ? 0 : $index*2 + ( $person->sex == 'M' ? 0 : 1 );
		$output->addHTML( str_repeat( $emptytd, $index ) );
		if ( $person->fullname instanceof SMWDIBlob ) {
			$output->addHTML( '<td colspan="'.$colspan.'">' );
			// ( $person->sex == 'M' ? '/' : '\\' ).'<br/>' .
			if ( $i == 1 ) {
				$class = $side == 'left' ? 'father' : 'mother';
			} else {
				$class = $person->sex == 'M' ? 'father' : 'mother';
			}

			$parentLink = '<table class="'.$class.'-link">'
				.'<tr><td></td><td></td><td></td></tr>'
				.'<tr><td></td><td></td><td></td></tr></table>';
			$output->addHTML( $parentLink );
			$output->addWikiText(
				$person->getDescriptionWikiText( false, $this->displayName )
			);
			$output->addHTML( '</td>' );
		}
		$indextail = $colwidth-1-$index;
		$output->addHTML( str_repeat( $emptytd, $indextail ) );
		return $index;
	}
}
