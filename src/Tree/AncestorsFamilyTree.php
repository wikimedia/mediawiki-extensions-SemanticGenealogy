<?php

/**
 * AncestorsFamilyTree object
 *
 * Handle a FamilyTree to display the ancestors of the person
 *
 * @file    AncestorsFamilyTree.php
 * @ingroup SemanticGenealogy
 *
 * @licence GNU GPL v2+
 * @author  Thomas Pellissier Tanon <thomaspt@hotmail.fr>
 * @author  Thibault Taillandier <thibault@taillandier.name>
 */
class AncestorsFamilyTree extends FamilyTree {

	const NAME = 'ancestors';

	/**
	 * List the ancestors of the person for all needed generations
	 *
	 * @return array the generations tree
	 */
	private function getAncestors() {
		$tree = [];
		$tree[0][1] = new PersonPageValues( $this->person );

		for ( $i = 0; $i < $this->numOfGenerations && $tree[$i] !== null; $i++ ) {
			$tree = $this->addGenInTree( $i + 1, $tree );
		}
		return $tree;
	}

	/**
	 * Render the tree of ancestors
	 *
	 * @return void
	 */
	public function render() {
		$tree = $this->getAncestors();
		$output = $this->getOutput();
		$output->addHTML( '<table class="decorator-'.$this->decorator. ' smg-tree-root-ancestors">' );

		$col = 1;
		for ( $i = $this->numOfGenerations - 1; $i >= 0; $i-- ) {
			if ( isset( $tree[$i] ) ) {
				$output->addHTML( '<tr class="smg-tree-line">' );
				foreach ( $tree[$i] as $sosa => $person ) {
					$output->addHTML( '<td class="smg-tree-person col-width-'.$col.'" colspan="'.$col.'">' );
					if ( $person !== null ) {
						$output->addHTML( '<span class="sosa-num">'.$sosa.'</span><br/>' );
						$output->addWikiText( $person->getDescriptionWikiText( true, $this->displayName ) );
						if ( $sosa != 1 ) {
							if ( $sosa % 2 == 0 ) {
								$output->addHTML( '<table class="father-link"><tr><td></td><td></td><td></td></tr>'
									.'<tr><td></td><td></td><td></td></tr></table>' );
							} else {
								$output->addHTML( '<table class="mother-link"><tr><td></td><td></td><td></td></tr>'
									.'<tr><td></td><td></td><td></td></tr></table>' );
							}
						}
					}
					$output->addHTML( '</td>' );
				}
				$output->addHTML( '</tr>' );
			}
			$col *= 2;
		}
		$output->addHTML( '</table>' );
	}
}
