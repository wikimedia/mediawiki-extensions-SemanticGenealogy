<?php

/**
 * Gedcom5FilePrinter object
 *
 * Generate a GeDCOM file
 *
 * @file    Gedcom5FilePrinter.php
 * @ingroup SemanticGenealogy
 *
 * @licence GNU GPL v2+
 * @author  Thomas Pellissier Tanon <thomaspt@hotmail.fr>
 */
class Gedcom5FilePrinter extends GenealogicalFilePrinter {

	protected $families = [];
	protected $familiesByPerson = [];

	/**
	 * Set file in $this->file property
	 *
	 * @return void
	 */
	protected function setFile() {
		$this->setFamiliesList();

		$this->addHead();
		foreach ( $this->people as $key => $person ) {
			$this->addPerson( $key, $person );
		}
		foreach ( $this->families as $key => $children ) {
			$this->addFamily( $key, $children );
		}
		$this->addRow( 0, 'TRLR' );
	}

	/**
	 * Set Families List
	 *
	 * @return void
	 */
	protected function setFamiliesList() {
		foreach ( $this->people as $child ) {
			$familyId = $this->getFamilyIdForChild( $child );
			if ( $familyId != '0S0' ) {
				$this->addChildToFamily( $familyId, $child );
				list( $fatherId, $motherId ) = explode( 'S', $familyId );
				$this->addFamilyToPerson( $familyId, $fatherId );
				$this->addFamilyToPerson( $familyId, $motherId );
			}
		}
	}

	/**
	 * Get the family Id if the given child
	 *
	 * @param object $child the PersonPageValues object of the child
	 *
	 * @return string the key
	 */
	protected function getFamilyIdForChild( PersonPageValues $child ) {
		$key = '';
		if ( $child->father instanceof SMWDIWikiPage
			&& isset( $this->people[$child->father->getTitle()->getArticleID()] ) ) {
			$key .= $child->father->getTitle()->getArticleID() . 'S';
			if ( $child->mother instanceof SMWDIWikiPage
				&& isset( $this->people[$child->mother->getTitle()->getArticleID()] ) ) {
				$key .= $child->mother->getTitle()->getArticleID();
			} else {
				$key .= '0';
			}
		} else {
			$key .= '0S';
			if ( $child->mother instanceof SMWDIWikiPage
				&& isset( $this->people[$child->mother->getTitle()->getArticleID()] ) ) {
				$key .= $child->mother->getTitle()->getArticleID();
			} else {
				$key .= '0';
			}
		}
		return $key;
	}

	/**
	 * Adds a child to a family
	 *
	 * @param string $familyKey the family key
	 * @param object $child the PersonPageValues object of the child to add
	 *
	 * @return void
	 */
	protected function addChildToFamily( $familyKey, PersonPageValues $child ) {
		$childId = $child->title->getArticleID();
		if ( isset( $this->families[$familyKey] ) ) {
			if ( !in_array( $childId, $this->families[$familyKey] ) ) {
				$this->families[$familyKey][] = $childId;
			}
		} else {
			$this->families[$familyKey] = [ $childId ];
		}
	}

	/**
	 * Adds a family to a person
	 *
	 * @param integer $familyId the id of the family
	 * @param integer $personId the id of the person
	 *
	 * @return void
	 */
	protected function addFamilyToPerson( $familyId, $personId ) {
		if ( $personId != 0 ) {
			if ( isset( $this->familiesByPerson[$personId] ) ) {
				if ( !in_array( $familyId, $this->familiesByPerson[$personId] ) ) {
					$this->familiesByPerson[$personId][] = $familyId;
				}
			} else {
				$this->familiesByPerson[$personId] = [ $familyId ];
			}
		}
	}

	/**
	 * Add GEDCOM header
	 *
	 * @return void
	 */
	protected function addHead() {
		global $wgSitename, $wgRightsText;

		$this->addRow( 0, 'HEAD' );
		$this->addRow( 1, 'SOUR', 'unregistered' );
		$this->addRow( 2, 'NAME', 'Semantic Genealogy' );
		$this->addRow( 2, 'VERS', SGENEA_VERSION );
		$this->addRow( 2, 'DATA', $wgSitename );
		if ( isset( $wgRightsText ) && $wgRightsText ) {
			$this->addRow( 3, 'COPR', $wgRightsText );
		}
		// $this->addRow( 1, 'FILE',  ); //TODO name of the file
		$this->addRow( 1, 'DATE', strtoupper( date( 'd M Y' ) ) );
		   // TODO hh:mm:ss.fs
		$this->addRow( 2, 'TIME', date( 'H:i:s' ) );
		$this->addRow( 1, 'GEDC' );
		$this->addRow( 2, 'VERS', 5.5 );
		$this->addRow( 2, 'FORM', 'LINEAGE-LINKED' );
		$this->addRow( 1, 'CHAR', 'UTF8' );
		// $this->addRow( 1, 'LANG',  ); //TODO ?
	}

	/**
	 * Add the GEDCOM for a person
	 *
	 * @param integer $personId the id of the person
	 * @param PersonPageValues $person
	 *
	 * @return void
	 */
	protected function addPerson( $personId, PersonPageValues $person ) {
		$this->addRow( 0, '@I'. $personId . '@', 'INDI' );
		$this->addRow( 1, 'NAME', $this->getGedcomName( $person ) );
		$this->addStringValueAsRow( 2, 'GIVN', $person->givenname );
		$this->addStringValueAsRow( 2, 'SURN', $person->surname );
		$this->addStringValueAsRow( 2, 'NICK', $person->nickname );
		$this->addStringValueAsRow( 2, 'NPFX', $person->prefix );
		$this->addStringValueAsRow( 2, 'NSFX', $person->suffix );
		$this->addStringValueAsRow( 1, 'SEX', $person->sex );
		$familyId = $this->getFamilyIdForChild( $person );
		if ( $familyId != '0S0' ) {
			$this->addRow( 1, 'FAMC', '@F'. $familyId . '@' );
		}
		if ( isset( $this->familiesByPerson[$personId] ) ) {
			foreach ( $this->familiesByPerson[$personId] as $familyId ) {
				$this->addRow( 1, 'FAMS', '@F'. $familyId . '@' );
			}
		}
		$this->addEvent( 'BIRT', $person->birthdate, $person->birthplace );
		$this->addEvent( 'DEAT', $person->deathdate, $person->deathplace );
	}

	/**
	 * Adds family to the gedcom
	 *
	 * @param integer $familyId the id of the family
	 * @param array $children the children array
	 *
	 * @return void
	 */
	protected function addFamily( $familyId, $children ) {
		list( $fatherId, $motherId ) = explode( 'S', $familyId );
		$this->addRow( 0, '@F'. $familyId . '@', 'FAM' );
		if ( $fatherId != 0 ) {
			$this->addRow( 1, 'HUSB', '@I' . $fatherId . '@' );
		}
		if ( $motherId != 0 ) {
			$this->addRow( 1, 'WIFE', '@I' . $motherId . '@' );
		}
		foreach ( $children as $childId ) {
			$this->addRow( 1, 'CHIL', '@I' . $childId . '@' );
		}
	}

	/**
	 * Get the gedcom name
	 *
	 * @param PersonPageValues $person
	 *
	 * @return string the name for the gedcom
	 */
	protected function getGedcomName( PersonPageValues $person ) {
		$name = '';
		if ( $person->givenname instanceof SMWDIBlob && $person->givenname->getString() != '' ) {
			$name .= $person->givenname->getString();
		}
		if ( $person->surname instanceof SMWDIBlob && $person->surname->getString() != '' ) {
			$name .= '/' . $person->surname->getString() . '/';
		}
		if ( $person->suffix instanceof SMWDIBlob && $person->suffix->getString() != '' ) {
			$name .= $person->suffixname->getString();
		}
		return $name;
	}

	/**
	 * Adds a row
	 *
	 * @param string $level the level of the row
	 * @param string $key
	 * @param object $value
	 *
	 * @return void
	 */
	protected function addRow( $level, $key, $value = null ) {
		$this->file .= $level . ' ' . $key;
		if ( $value !== null ) {
			$this->file .= ' ' . str_replace( '\n', ' ', $value );
		}
		$this->file .= "\n";
	}

	/**
	 * Add Event
	 *
	 * TODO add places metadata support.
	 *
	 * @param string $type
	 * @param string $date
	 * @param string $place
	 *
	 * @return void
	 */
	protected function addEvent( $type, $date, $place ) {
		if ( $date === null && $place === null ) {
			return;
		}
		$this->addRow( 1, $type );
		$this->addTimeValueAsRow( 2, 'DATE', $date );
		if ( $place instanceof SMWDIWikiPage ) {
			$this->addWikiPageValueAsRow( 2, 'PLAC', $place );
		} else {
			$this->addStringValueAsRow( 2, 'PLAC', $place );
		}
	}

	/**
	 * Adds a row from string value
	 *
	 * @param string $level the level of the row
	 * @param string $key
	 * @param object $value the string value
	 *
	 * @return void
	 */
	protected function addStringValueAsRow( $level, $key, $value ) {
		if ( $value instanceof SMWDIBlob ) {
			$this->addRow( $level, $key, $value->getString() );
		}
	}

	/**
	 * Adds a row from time value
	 *
	 * @param string $level the level of the row
	 * @param string $key
	 * @param object $value the time value
	 *
	 * @return void
	 */
	protected function addTimeValueAsRow( $level, $key, $value ) {
		if ( $value instanceof SMWDITime ) {
			$lang = Language::factory( 'en' );
			$this->addRow( $level, $key,
				strtoupper( $lang->sprintfDate( 'd M Y', $value->getMwTimestamp( TS_MW ) ) ) );
		}
	}

	/**
	 * Adds a row from the wiki page
	 *
	 * @param string $level the level of the row
	 * @param string $key
	 * @param object $value the wiki page value
	 *
	 * @return void
	 */
	protected function addWikiPageValueAsRow( $level, $key, $value ) {
		if ( $value instanceof SMWDIWikiPage ) {
			$this->addRow( $level, $key, $value->getTitle()->getText() );
		}
	}
}
