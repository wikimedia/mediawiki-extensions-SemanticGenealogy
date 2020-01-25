<?php

/**
 * DescandantFamilyTree object
 *
 * Handle a FamilyTree to display the descendants of a person
 *
 * @file    DescendantListFamilyTree.php
 * @ingroup SemanticGenealogy
 *
 * @license GPL-2.0-or-later
 * @author  Thomas Pellissier Tanon <thomaspt@hotmail.fr>
 * @author  Thibault Taillandier <thibault@taillandier.name>
 */
class DescendantListFamilyTree extends FamilyTree {
	const NAME = 'descendantlist';

	/**
	 * List the descendants for all needed generations
	 *
	 * @param PersonPageValues $person
	 * @param string $pellissier I don't know
	 * @param int $end counter to know whether we should stop
	 *
	 * @return void
	 */
	private function outputDescendantLine( $person, $pellissier, $end ) {
		$output = $this->getOutput();
		$output->addHTML( '<div class="descendant-line">' );
		$children = $person->getChildren();
		$count = 1;
		$depth = substr_count( $pellissier, '.' ) + 1;
		foreach ( $children as $child ) {
			$pel = $pellissier . $count . '.';
			$output->addHtml( '<span class="number depth-' . $depth . '">' . $pel . '</span> ' );
			$output->addWikiText( $child->getDescriptionWikiText( false ) );
			if ( $end > 0 ) {
				$this->outputDescendantLine( $child, $pel, $end - 1 );
			}
			$count++;
		}
		$output->addHTML( '</div>' );
	}

	/**
	 * Render the tree of descendants
	 *
	 * @return void
	 */
	public function render() {
		$output = $this->getOutput();
		$output->addHTML( '<div class="decorator-' . $this->decorator . ' smg-tree-root-descendant">' );
		$main = new PersonPageValues( $this->person );
		$output->addWikiText( $main->getDescriptionWikiText( false ) );
		$this->outputDescendantLine( $main, '', $this->numOfGenerations );
		$output->addHTML( '</div>' );
	}
}
