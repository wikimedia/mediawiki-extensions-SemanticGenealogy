<?php

/**
 * Static class for hooks handled by the Semantic Genealogy extension.
 *
 * @file    SemanticGenealogy.body.php
 * @ingroup SemanticGenealogy
 *
 * @license GPL-2.0-or-later
 * @author  Thomas Pellissier Tanon <thomaspt@hotmail.fr>
 */
class SemanticGenealogy {

	/**
	 * Get an array key => value of genealogical properties as SMWDIProperty
	 *
	 * @throws MWException
	 *
	 * @return array the properties array
	 */
	public static function getProperties() {
		static $properties;

		if ( $properties !== null ) {
			return $properties;
		}

		global $wgGenealogicalProperties;
		$properties = [];

		if ( !is_array( $wgGenealogicalProperties ) ) {
			throw new MWException( 'Configuration variable $wgGenealogicalProperties must be an array !' );
		}

		foreach ( $wgGenealogicalProperties as $key => $value ) {
			if ( $value ) {
				$properties[$key] = SMWDIProperty::newFromUserLabel( $value );
			}
		}
		return $properties;
	}
}
