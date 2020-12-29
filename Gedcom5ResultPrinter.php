<?php

/**
 * Printer class for creating GEDCOM exports
 *
 * @file    GedcomResultPrinter.php
 * @ingroup SemanticGenealogy
 *
 * @license GPL-2.0-or-later
 * @author  Thomas Pellissier Tanon <thomaspt@hotmail.fr>
 */
class Gedcom5ResultPrinter extends SMWResultPrinter {
	public $ids = [];

	/**
	 * Get the mimetype of the result printer
	 *
	 * @param string|SMWQueryResult $res the result printer
	 *
	 * @return string the mimetype
	 */
	public function getMimeType( $res ) {
		return 'application/x-gedcom';
	}

	/**
	 * Get the filename of the result printer
	 *
	 * @param string|SMWQueryResult $res the result printer
	 *
	 * @return string the filename
	 */
	public function getFileName( $res ) {
		if ( $this->getSearchLabel( SMW_OUTPUT_WIKI ) != '' ) {
			return str_replace( ' ', '_', $this->getSearchLabel( SMW_OUTPUT_WIKI ) ) . '.ged';
		} else {
			return 'GEDCOM.ged';
		}
	}

	/**
	 * Get the query mode
	 *
	 * @param string $context
	 *
	 * @return string the query mode
	 */
	public function getQueryMode( $context ) {
		return ( $context == SMWQueryProcessor::SPECIAL_PAGE )
			? SMWQuery::MODE_INSTANCES : SMWQuery::MODE_NONE;
	}

	/**
	 * Get the Result printer name
	 *
	 * @return the name of the result printer
	 */
	public function getName() {
		return wfMessage( 'semanticgenealogy-gedcomexport-desc' )->text();
	}

	/**
	 * Get the result test of the result printer
	 *
	 * @param SMWQueryResult $res
	 * @param int $outputmode the output mode chosen
	 *
	 * @return string the result text
	 */
	protected function getResultText( SMWQueryResult $res, $outputmode ) {
		$result = '';

		if ( $outputmode == SMW_OUTPUT_FILE ) {
			$people = [];
			$row = $res->getNext();
			while ( $row !== false ) {
				$people[] = new PersonPageValues( $row[0]->getResultSubject() );
				$row = $res->getNext();
			}
			$printer = new Gedcom5FilePrinter();
			$printer->addPeople( $people );
			$result = $printer->getFile();
		} else {
			   // just make link
			if ( $this->getSearchLabel( $outputmode ) ) {
				$label = $this->getSearchLabel( $outputmode );
			} else {
				$label = wfMessage( 'semanticgenealogy-gedcomexport-link' )->inContentLanguage()->text();
			}
			$link = $res->getQueryLink( $label );
			$link->setParameter( 'gedcom5', 'format' );
			if ( $this->getSearchLabel( SMW_OUTPUT_WIKI ) != '' ) {
				$link->setParameter( $this->getSearchLabel( SMW_OUTPUT_WIKI ), 'searchlabel' );
			}
			if ( array_key_exists( 'limit', $this->m_params ) ) {
				$link->setParameter( $this->m_params['limit'], 'limit' );
			} else {
				   // use a reasonable default limit
				$link->setParameter( 20, 'limit' );
			}
			$result .= $link->getText( $outputmode, $this->mLinker );
			// yes, our code can be viewed as HTML if requested, no more parsing needed
			$this->isHTML = ( $outputmode == SMW_OUTPUT_HTML );
		}
		return $result;
	}

	/**
	 * Get all the parameters
	 *
	 * @return array the base parameters and the export format parameters
	 */
	public function getParameters() {
		return array_merge( parent::getParameters(), $this->exportFormatParameters() );
	}
}
