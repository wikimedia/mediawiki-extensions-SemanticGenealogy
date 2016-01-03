<?php

/**
 * Printer class for creating GEDCOM exports
 *
 * @file GedcomResultPrinter.php
 * @ingroup SemanticGenealogy
 *
 * @licence GNU GPL v2+
 * @author Thomas Pellissier Tanon < thomaspt@hotmail.fr >
 */
class Gedcom5ResultPrinter extends SMWResultPrinter {
	public $ids = array();

	public function getMimeType( $res ) {
		return 'application/x-gedcom';
	}

	public function getFileName( $res ) {
		if( $this->getSearchLabel( SMW_OUTPUT_WIKI ) != '' ) {
			return str_replace( ' ', '_', $this->getSearchLabel( SMW_OUTPUT_WIKI ) ) . '.ged';
		} else {
			return 'GEDCOM.ged';
		}
	}

	public function getQueryMode( $context ) {
		return ( $context == SMWQueryProcessor::SPECIAL_PAGE ) ? SMWQuery::MODE_INSTANCES : SMWQuery::MODE_NONE;
	}

	public function getName() {
		return wfMessage( 'semanticgenealogy-gedcomexport-desc' )->text();
	}

	protected function getResultText( SMWQueryResult $res, $outputmode ) {
		$result = '';

		if( $outputmode == SMW_OUTPUT_FILE ) {
			$people = array();
			$row = $res->getNext();
			while( $row !== false ) {
				$people[] = new PersonPageValues( $row[0]->getResultSubject() );
				$row = $res->getNext();
			}
			$printer = new Gedcom5FilePrinter();
			$printer->addPeople( $people );
			$result = $printer->getFile();
		} else { // just make link
			if( $this->getSearchLabel( $outputmode ) ) {
				$label = $this->getSearchLabel( $outputmode );
			} else {
				$label = wfMessage( 'semanticgenealogy-gedcomexport-link' )->inContentLanguage()->text();
			}
			$link = $res->getQueryLink( $label );
			$link->setParameter( 'gedcom5', 'format' );
			if( $this->getSearchLabel( SMW_OUTPUT_WIKI ) != '' ) {
				$link->setParameter( $this->getSearchLabel( SMW_OUTPUT_WIKI ), 'searchlabel' );
			}
			if( array_key_exists( 'limit', $this->m_params ) ) {
				$link->setParameter( $this->m_params['limit'], 'limit' );
			} else { // use a reasonable default limit
				$link->setParameter( 20, 'limit' );
			}
			$result .= $link->getText( $outputmode, $this->mLinker );
			$this->isHTML = ( $outputmode == SMW_OUTPUT_HTML ); // yes, our code can be viewed as HTML if requested, no more parsing needed
		}
		return $result;
	}

	public function getParameters() {
		return array_merge( parent::getParameters(), $this->exportFormatParameters() );
	}
}
