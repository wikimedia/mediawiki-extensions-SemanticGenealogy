<?php

/**
 * Special page that output genealogical content in some file formats
 *
 * @file    GenealogicalFilePrinter.php
 * @ingroup SemanticGenealogy
 *
 * @license GPL-2.0-or-later
 * @author  Thomas Pellissier Tanon <thomaspt@hotmail.fr>
 */
abstract class GenealogicalFilePrinter {
	protected $file = '';
	protected $people = [];

	/**
	 * Add people to the GEDCOM file
	 *
	 * @param PersonPageValues[] $people
	 *
	 * @return void
	 */
	public function addPeople( $people ) {
		foreach ( $people as $person ) {
			$this->people[$person->title->getArticleID()] = $person;
		}
		if ( !empty( $people ) && $this->file !== '' ) {
			$this->file = '';
		}
	}

	/**
	 * Return the file
	 *
	 * @return string
	 */
	public function getFile() {
		if ( $this->file === '' ) {
			$this->setFile();
		}
		return $this->file;
	}

	/**
	 * set file in $this->file property
	 */
	abstract protected function setFile();
}
