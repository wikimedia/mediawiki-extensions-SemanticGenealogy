<?php


class TreeDecoratorFactory {

	/**
	 * Create a new FamilyTree object
	 *
	 * @param string $name the name of the wanted FamilyTree
	 *
	 * @return object a new FamilyTree Object
	 */
	public static function create( $name ) {
		$decorators = static::listDecorators();
		foreach ( $decorators as $decorator ) {
			if ( $name == $decorator::NAME ) {
				return new $decorator();
			}
		}
		throw new SemanticGenealogyException(
			wfMessage( 'semanticgenealogy-specialfamilytree-error-unknowndecorator', $name )->text() );
	}

	/**
	 * List the existing tree types
	 *
	 * @return array the list of FamilyTree classes availables
	 */
	public static function listDecorators() {
		return Tools::getSubclassesOf( __DIR__, 'TreeDecorator' );
	}

}
