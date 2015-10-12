<?php



class Tools {

	/**
	 * Find the subclasses of that superclass in one directory
	 *
	 * @param string $dir the directory
	 * @param string $superClass the superclass name
	 *
	 * @return array an array of $classes subclass of the superClass
	 */
	public static function getSubclassesOf( $dir, $superClass ) {
		$classes = [];
		foreach ( new DirectoryIterator( $dir ) as $file ) {
			if ( $file->isDot() ) {
				continue;
			}
			if ( !$file->isFile() ) {
				continue;
			}
			if ( !preg_match( "#.php$#", $file->getFilename() ) ) {
				continue;
			}
			require_once $file->getPathname();
			$className = $file->getBasename( '.php' );
			try {
				$classRef = new ReflectionClass( $className );
			} catch ( ReflectionException $e ) {
				continue;
			}

			if ( !$classRef->isAbstract() && $classRef->isSubclassOf( $superClass ) ) {
				$classes[] = new $className;
			}
		}
		return $classes;
	}
}
