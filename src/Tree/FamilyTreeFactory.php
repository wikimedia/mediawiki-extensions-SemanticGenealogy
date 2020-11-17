<?php

/**
 * FamilyTreeFactory object
 *
 * Create a FamilyTree subclass object from the given type
 *
 * @file    FamilyTreeFactory.php
 * @ingroup SemanticGenealogy
 *
 * @license GPL-2.0-or-later
 * @author  Thibault Taillandier <thibault@taillandier.name>
 */
class FamilyTreeFactory {

	/**
	 * Create a new FamilyTree object
	 *
	 * @param string $name the name of the wanted FamilyTree
	 * @param string $decorator the decorator name
	 *
	 * @return FamilyTree
	 */
	public static function create( $name, $decorator ) {
		$trees = static::listTrees();
		foreach ( $trees as $tree ) {
			if ( $name == $tree::NAME ) {
				return new $tree( $decorator );
			}
		}
		throw new SemanticGenealogyException(
			wfMessage( 'semanticgenealogy-specialfamilytree-error-unknowntype', $name )->text() );
	}

	/**
	 * List the existing tree types
	 *
	 * @return array the list of FamilyTree classes availables
	 */
	public static function listTrees() {
		return Tools::getSubclassesOf( __DIR__, 'FamilyTree' );
	}
}
