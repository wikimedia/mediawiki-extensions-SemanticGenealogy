<?php

/**
 * FamilyTree object
 *
 * This class is abstract and cannot be instanciated.
 * Please use the FamilyTreeFactory to create a specific type of FamilyTree
 * (ancestors, descendant or link)
 *
 * @file    FamilyTree.php
 * @ingroup SemanticGenealogy
 *
 * @licence GNU GPL v2+
 * @author  Thomas Pellissier Tanon <thomaspt@hotmail.fr>
 * @author  Thibault Taillandier <thibault@taillandier.name>
 */
abstract class FamilyTree {

	const NAME = 'root';

	protected $output;
	protected $person;
	protected $personName;
	protected $numOfGenerations;
	protected $decorator;
	protected $displayName;

	/**
	 * @param string $decorator the decorator name
	 */
	public function __construct( $decorator=null ) {
		$this->decorator = $decorator;
	}

	/**
	 * Setter for the person
	 *
	 * @param string $personName the name of the page of the person
	 */
	public function setPerson( $personName ) {
		$this->personName = $personName;
		$this->person = PersonPageValues::getPageFromName( $personName );
	}

	/**
	 * Setter for the number of generations
	 *
	 * @param integer $numOfGenerations the number of generations
	 */
	public function setNumberOfGenerations( $numOfGenerations ) {
		$this->numOfGenerations = $numOfGenerations;
	}

	/**
	 * Setter for preference for displayname
	 *
	 * @param string $displayName the name to display
	 */
	public function setDisplayName( $displayName ) {
		$this->displayName = $displayName;
	}

	/**
	 * @param OutputPage $output
	 */
	public function setOutput( $output ) {
		$this->output = $output;
	}

	/**
	 * @return OutputPage
	 */
	public function getOutput() {
		return $this->output;
	}

	/**
	 * Return the number of people in a generation
	 *
	 * @param  int $gen The number of the generation (beginning at 0)
	 * @return int
	 */
	public function getNumOfPeopleInGen( $gen ) {
		$result = 1;
		for ( $i = 0; $i < $gen; $i++ ) {
			$result *= 2;
		}
		return $result;
	}

	/**
	 * Add a generation in a tree
	 *
	 * @param integer $gen the generation number
	 * @param array $tree the tree to add in
	 *
	 * @return array the resulting tree
	 */
	protected function addGenInTree( $gen, array $tree ) {
		$empty = true;
		$son = $this->getNumOfPeopleInGen( $gen - 1 );
		$end = $son * 4;
		for ( $parent = $son * 2; $parent < $end; true ) {
			if ( isset( $tree[$gen - 1][$son] ) ) {
				$father = $tree[$gen - 1][$son]->father;
				if ( $father instanceof SMWDIWikiPage ) {
					$tree[$gen][$parent] = new PersonPageValues( $father );
					$empty = false;
				} else {
					$tree[$gen][$parent] = null;
				}
				$parent++;

				$mother = $tree[$gen - 1][$son]->mother;
				if ( $mother instanceof SMWDIWikiPage ) {
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
		// Verif s'il n'y a personne dans la génération
		if ( $empty ) {
			$tree[$gen] = null;
		}
		return $tree;
	}

	/**
	 * Render the tree
	 *
	 * This should not be used,
	 * because you should not use a abstract FamilyTree
	 *
	 * @return void
	 */
	public function render() {
		$this->output->addHtml( "" );
	}
}
