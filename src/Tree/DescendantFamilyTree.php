<?php

/**
 * DescandantFamilyTree object
 *
 * Handle a FamilyTree to display the descendants of a person
 *
 * @file    DescendantFamilyTree.php
 * @ingroup SemanticGenealogy
 *
 * @license GPL-2.0-or-later
 * @author  Thomas Pellissier Tanon <thomaspt@hotmail.fr>
 * @author  Thibault Taillandier <thibault@taillandier.name>
 */
class DescendantFamilyTree extends FamilyTree {
	const NAME = 'descendant';

	/**
	 * Show the descendants tree
	 *
	 * @param PersonPageValues $person the target person to create the descendant tree
	 * @param int $numOfGenerations number of generation to display
	 * @return PersonPageValues|bool
	 */
	private function showDescendants( $person, $numOfGenerations ) {
		$output = $this->getOutput();
		if ( $numOfGenerations == 0 ) {
			return true;
		}

		$infoPerson = $person->getDescriptionWikiText( true, $this->displayName );
		$infoEmpty = "&nbsp;";
		$infoPartner = "&nbsp;";
		$couple = '<td>&nbsp;</td><td class="father-link">&nbsp;</td>'
			. '<td class="mother-link">&nbsp;</td><td>&nbsp;</td>';
		$tdempty = '<td>&nbsp;</td><td>&nbsp;</td>';
		if ( $person->getPartner() ) {
			$partner = new PersonPageValues( $person->getPartner() );
			if ( isset( $partner ) ) {
				$infoPartner = $partner->getDescriptionWikiText( true, $this->displayName );
			}
		}

		$output->addHTML(
			'<table class="decorator-' . $this->decorator . ' smg-tree-root-descendant" style="width:100%">'
			. '<tr class="smg-tree-line">'
			. '<td colspan="2" class="center">'
			. '<table><tr>'
		);
		$nbChildren = count( $person->getChildren() );
		if ( $person->sex && $person->sex->getString() == 'M' ) {
			$output->addHTML( '<tr><td class="person" colspan="2">' );
			$output->addWikiText( $infoEmpty );
			$output->addHTML( '</td><td class="person" colspan="2">' );
			$output->addWikiText( $infoPerson );
			$output->addHTML( '</td><td class="person" colspan="2">' );
			$output->addWikiText( $infoPartner );
			$output->addHTML( '</td></tr><tr>' );
			$output->addHTML( $tdempty . ( $nbChildren ? $couple : $tdempty . $tdempty ) );
		} else {
			$output->addHTML( '<tr><td class="person" colspan="2">' );
			$output->addWikiText( $infoPartner );
			$output->addHTML( '</td><td class="person" colspan="2">' );
			$output->addWikiText( $infoPerson );
			$output->addHTML( '</td><td class="person" colspan="2">' );
			$output->addWikiText( $infoEmpty );
			$output->addHTML( '</td></tr><tr>' );
			$output->addHTML( ( $nbChildren ? $couple : $tdempty . $tdempty ) . $tdempty );
		}
		$output->addHTML(
			'</tr></table></td></tr>'
			. '<tr><td ' . ( $nbChildren ? ' class="couple-link"' : '' ) . '>&nbsp;</td><td>&nbsp;</td></tr>'
		 );

		$output->addHTML( '<tr><td colspan="2"><table><tr>' );
		$itemNumber = 1;
		foreach ( $person->getChildren() as $child ) {
			$class = $this->getClass( $itemNumber++, $nbChildren );
			$output->addHTML(
				'<td style="vertical-align: top"><table><tr>'
				. '<td class="child-left ' . $class . '">&nbsp;</td>'
				. '<td class="child-right ' . $class . '">&nbsp;</td>'
				. '</tr>'
				. '<tr><td colspan="2" class="center">'
			);
			$childPage = new PersonPageValues( $child->getPage() );
			$this->showDescendants( $childPage, $numOfGenerations - 1 );
			$output->addHTML( '</td></tr></table></td>' );
		}
		$output->addHTML( '</tr></td></table></td></tr></table>' );
		return $person;
	}

	/**
	 * Determine the class to display
	 *
	 * @param int $itemNumber the number of the current item
	 * @param int $nbChildren the number of total children
	 *
	 * @return string the class name
	 */
	private function getClass( $itemNumber, $nbChildren ) {
		if ( $nbChildren == 1 ) {
			return "child-one";
		}
		if ( $itemNumber == 1 ) {
			return "child-first";
		}
		if ( $itemNumber == $nbChildren ) {
			return "child-last";
		}
		return "child-middle";
	}

	/**
	 * Render the tree of descendants
	 *
	 * @return void
	 */
	public function render() {
		$output = $this->getOutput();
		$person = new PersonPageValues( $this->person );
		$this->showDescendants( $person, 4 );
	}
}
