<?php

/**
 * Special page that show a family tree
 * 
 * @file SpecialFamilyTree.php
 * @ingroup SemanticGenealogy
 *
 * @licence GNU GPL v2+
 * @author Thomas Pellissier Tanon < thomaspt@hotmail.fr >
 */
class SpecialFamilyTree extends SpecialPage {

	public function __construct( $name = 'FamilyTree' ) {
		parent::__construct( $name, 'other' );
		$this->mIncludable = true;
	}

	public function execute( $par ) {
		global $wgRequest, $wgScript;

		$this->setHeaders();
		$output = $this->getOutput();

		if( $par != '') {
			$parts = explode('/', urldecode( $par ));
		} else {
			$parts = array();
		}

		$type = isset( $parts[0] ) ? $parts[0] : $wgRequest->getText( 'type' );
		if($type == '') {
			$type = 'ancestors';
		}

		$pageName = isset( $parts[1] ) ? $parts[1] : $wgRequest->getText( 'page' );

		if( $type == 'link' ) {
			$pageName2 = isset( $parts[2] ) ? $parts[2] : $wgRequest->getText( 'page2' );
			$numOfGenerations = 0;
		} else {
			$numOfGenerations = isset( $parts[2] ) ? intval( $parts[2] ) : $wgRequest->getInt( 'gen' );
			if($numOfGenerations <= 0) {
				$numOfGenerations = 5;
			}
			$pageName2 = '';
		}

		if( !$this->mIncluding ) {
			$output->addModules( 'ext.smg.specialfamilytree' );
			$typeSelect = new XmlSelect( 'type', 'type', $type );
			$typeSelect->addOption( wfMsg( 'semanticgenealogy-specialfamilytree-type-ancestors' ), 'ancestors' );
			$typeSelect->addOption( wfMsg( 'semanticgenealogy-specialfamilytree-type-descendant' ), 'descendant' );
			$typeSelect->addOption( wfMsg( 'semanticgenealogy-specialfamilytree-type-link' ), 'link' );
			$output->addHTML(
				Xml::openElement( 'form', array( 'action' => $wgScript ) ) .
					Html::hidden( 'title', $this->getTitle()->getPrefixedText() ) .
					Xml::openElement( 'fieldset' ) .
						Xml::openElement( 'table', array( 'id' => 'smg-familyTree-form' ) ) .
							Xml::openElement( 'tr', array('id' => 'smg-form-entry-page' ) ) .
								Xml::openElement( 'th', array('class' => 'mw-label') ) .
									Xml::label( wfMsg( 'semanticgenealogy-specialfamilytree-label-page' ), 'page' ) .
								Xml::closeElement( 'th' ) .
								Xml::openElement( 'td', array('class' => 'mw-input') ) .
									Xml::input( 'page', 30, $pageName, array( 'class' => 'smg-input-page' ) ) .
								Xml::closeElement( 'td' ) .
							Xml::closeElement( 'tr' ) .
							Xml::openElement( 'tr', array('id' => 'smg-form-entry-type' ) ) .
								Xml::openElement( 'th', array('class' => 'mw-label') ) .
									Xml::label( wfMsg( 'semanticgenealogy-specialfamilytree-label-type' ), 'type' ) .
								Xml::closeElement( 'th' ) .
								Xml::openElement( 'td', array('class' => 'mw-input') ) .
									$typeSelect->getHtml() .
								Xml::closeElement( 'td' ) .
							Xml::closeElement( 'tr' ) .
							Xml::openElement( 'tr', array('id' => 'smg-form-entry-gen' ) ) .
								Xml::openElement( 'th', array('class' => 'mw-label') ) .
									Xml::label( wfMsg( 'semanticgenealogy-specialfamilytree-label-gen' ), 'gen' ) .
								Xml::closeElement( 'th' ) .
								Xml::openElement( 'td', array('class' => 'mw-input') ) .
									Xml::input( 'gen', 2, $numOfGenerations ) .
								Xml::closeElement( 'td' ) .
							Xml::closeElement( 'tr' ) .
							Xml::openElement( 'tr', array('id' => 'smg-form-entry-page2' ) ) .
								Xml::openElement( 'th', array('class' => 'mw-label') ) .
									Xml::label( wfMsg( 'semanticgenealogy-specialfamilytree-label-page2' ), 'page2' ) .
								Xml::closeElement( 'th' ) .
								Xml::openElement( 'td', array('class' => 'mw-input') ) .
									Xml::input( 'page2', 30, $pageName2, array( 'class' => 'smg-input-page' ) ) .
								Xml::closeElement( 'td' ) .
							Xml::closeElement( 'tr' ) .
						Xml::closeElement( 'table' ) .
						Xml::submitButton( wfMsg( 'semanticgenealogy-specialfamilytree-button-submit' ) ) .
					Xml::closeElement( 'fieldset' ) .
				Xml::closeElement( 'form' )
			);
		}

		if( $pageName == '')
			return;

		$pageTitle = Title::newFromText( $pageName );
		$page = SMWDIWikiPage::newFromTitle( $pageTitle );

		if($type == '')
			$type = 'ancestors';
		switch($type) {
			case 'ancestors':
				$tree = $this->getAncestors( $page, $numOfGenerations );
				$this->outputAncestorsTree( $tree, $numOfGenerations );
				break;
			case 'descendant':
				$this->outputDescendantList( $page, $numOfGenerations );
				break;
			case 'link':
				if($pageName2 == '') {
					$output->addWikiText( '<span class="error">' . wfMsg( 'semanticgenealogy-specialfamilytree-error-nosecondpagename' ) . '</span>' );
					return;
				}
				$pageTitle2 = Title::newFromText( $pageName2 );
				$page2 = SMWDIWikiPage::newFromTitle( $pageTitle2 );
				$tree = $this->getRelation( $page, $page2 );
				if( $tree !== null) {
					$this->outputRelationTree( $tree );
				} else {
					$output->addWikiText( '<span class="error">' . wfMsg( 'semanticgenealogy-specialfamilytree-error-nolinkfound', $pageName, $pageName2 ) . '</span>' );
				}
				break;
			default:
				$output->addWikiText( '<span class="error">' . wfMsg( 'semanticgenealogy-specialfamilytree-error-unknowntype', $type ) . '</span>' );
		}
		return Status::newGood();
	}

	public function isCacheable() {
		return false;
	}

	public function getDescription( ) {
		return wfMsg( 'semanticgenealogy-specialfamilytree-title' );
	}

	/**
	 * Return the number of people in a generation
	 *
	 * @param  int $gen The number of the generation (beginning at 0)
	 * @return int
	 */
	protected static function getNumOfPeopleInGen( $gen ) {
		$result = 1;
		for($i = 0; $i < $gen; $i++ ) {
			$result *= 2;
		}
		return $result;
	}

	protected function getAncestors( SMWDIWikiPage $page, $numOfGenerations ) {
		$tree = array();
		$tree[0][1] = new PersonPageValues( $page );

		for($i = 0; $i < $numOfGenerations && $tree[$i] !== null; $i++ ) {
			$tree = $this->addGenInTree( $i + 1, $tree );
		}
		return $tree;
	}

	protected function addGenInTree( $gen, array $tree ) {
		$empty = true;
		$son = self::getNumOfPeopleInGen( $gen - 1 );
		$end = $son * 4;
		for( $parent = $son * 2; $parent < $end; $parent++ ) {
			if( isset( $tree[$gen - 1][$son] ) ) {
				$father = $tree[$gen - 1][$son]->father;
				if( $father instanceof SMWDIWikiPage ) {
					$tree[$gen][$parent] = new PersonPageValues( $father );
					$empty = false;
				} else {
					$tree[$gen][$parent] = null;
				}
				$parent++;

				$mother = $tree[$gen - 1][$son]->mother;
				if( $mother instanceof SMWDIWikiPage ) {
					$tree[$gen][$parent] = new PersonPageValues( $mother );
					$empty = false;
				} else {
					$tree[$gen][$parent] = null;
				}
				$parent++;
			} else {
				$parent += 2;
			}
			$son++;
		}
		//Verif s'il n'y a personne dans la génération
		if($empty) {
			$tree[$gen] = null;
		}
		return $tree;
	}

	protected function outputAncestorsTree( array $tree, $numOfGenerations ) {
		$output = $this->getOutput();
		$output->addHTML('<table style="text-align:center;">');
		$col = 1;
		for( $i = $numOfGenerations - 1; $i >= 0; $i-- ) {
			if( isset( $tree[$i] ) ) {
				$output->addHTML('<tr>');
				foreach ($tree[$i] as $sosa => $person) {
					$output->addHTML('<td colspan="' . $col . '">');
					if($person !== null) {
						$output->addHTML($sosa . '<br/>' );
						 $output->addWikiText( $person->getDescriptionWikiText( true ) );
						if($sosa != 1) {
							if($sosa % 2 == 0)
								$output->addHTML( '<br/>\\' );
							else
								$output->addHTML( '<br/>/' );
						}
					}
					$output->addHTML('</td>');
				}
				$output->addHTML('</tr>');
			}
			$col *= 2;
		}
		$output->addHTML('</table>');
	}

	protected function outputDescendantList( SMWDIWikiPage $main, $numOfGenerations ) {
		$output = $this->getOutput();
		$main = new PersonPageValues( $main );
		$output->addWikiText( $main->getDescriptionWikiText( false ) );
		$this->outputDescendantLine( $main, '', $numOfGenerations );
	}

	protected function outputDescendantLine( $person, $pellissier, $end ) {
		$output = $this->getOutput();
		$children = $person->getChildren();
		$i = 1;
		foreach($children as $child) {
			$pel = $pellissier . $i . '.';
			$output->addWikiText( $pel . ' ' . $child->getDescriptionWikiText( false ) );
			if( $end > 0 )
				$this->outputDescendantLine( $child, $pel, $end - 1);
			$i++;
		}
	}

	protected function getRelation( SMWDIWikiPage $page1, SMWDIWikiPage $page2 ) {
		$tree1 = array();
		$tree2 = array();
		$tree1[0][1] = new PersonPageValues( $page1 );
		$tree2[0][1] = new PersonPageValues( $page2 );

		for($i = 0; $tree1[$i] !== null && $tree2[$i] !== null; $i++ ) {
			$tree1 = $this->addGenInTree( $i + 1, $tree1 );
			if($tree1[$i + 1] !== null) {
				$result = $this->compareGenWith($tree1[$i + 1], $tree2, $i );
				if($result !== null) {
					list($sosa1, $sosa2) = $result;
					break;
				}
			}

			$tree2 = $this->addGenInTree( $i + 1, $tree2 );
			if($tree2[$i + 1] !== null) {
				$result = $this->compareGenWith($tree2[$i + 1], $tree1, $i + 1 );
				if($result !== null) {
					list($sosa2, $sosa1) = $result;
					break;
				}
			}
		}

		if($result !== null)
			return array( $this->getListOfAncestors( $sosa1, $tree1 ), $this->getListOfAncestors( $sosa2, $tree2 ) );
	}

	protected function compareGenWith( array $gen, array $tree, $max ) {
		for( $i = $max; $i >= 0; $i-- ) {
			if( isset( $tree[$i] ) ) {
				foreach( $tree[$i] as $sosa2 => $person2 ) {
					if($person2 !== null) {
						foreach( $gen as $sosa1 => $person1 ) {
							if($person1 !== null) {
								if( $person1->title->equals( $person2->title ) ) {
									return array( $sosa1, $sosa2 );
								}
							}
						}
					}
				}
			}
		}
	}

	protected function getListOfAncestors( $sosa, array $tree ) {
		$num = 1;
		$temp = 1;
		for($i = 0; $num < $sosa; $i++) {
			$temp *= 2;
			$num += $temp;
		}

		$list = array();
		for( $j = $i; $j >= 0; $j-- ) {
			$list[] = $tree[$j][$sosa];
			$sosa /= 2;
		}
		return $list;
	}

	protected function outputRelationTree( array $trees ) {
		$output = $this->getOutput();
		list( $tree1, $tree2 ) = $trees;

		$output->addHTML( '<table style="text-align:center;">' );
		$output->addHTML( '<tr><td colspan="2">' );
		$person = $tree1[0];
		if( $person->fullname instanceof SMWDIBlob )
			$output->addWikiText( $person->getDescriptionWikiText( false ) );
		$output->addHTML( '</td></tr>' );

		$length = max( count( $tree1 ), count( $tree2 ) );
		for($i = 1; $i < $length; $i++ ) {
			$output->addHTML('<tr><td>');
			if( isset( $tree1[$i] ) ) {
				$person = $tree1[$i];
				if( $person->fullname instanceof SMWDIBlob )
					$output->addWikiText( '|<br/>' . $person->getDescriptionWikiText( false ) );
			}
			$output->addHTML('</td><td>');
			if( isset( $tree2[$i] ) ) {
				$person = $tree2[$i];
				if( $person->fullname instanceof SMWDIBlob )
					$output->addWikiText( '|<br/>' . $person->getDescriptionWikiText( false ) );
			}
			$output->addHTML('</td></tr>');
		}
		$output->addHTML('</table>');
	}
}
