<?php

/**
 * Special page that output genealogical content in some file formats
 *
 * @file PersonPageValues.php
 * @ingroup SemanticGenealogy
 *
 * @licence GNU GPL v2+
 * @author Thomas Pellissier Tanon < thomaspt@hotmail.fr >
 */
abstract class GenealogicalFilePrinter {
	protected $file = '';
	protected $people = array();

	/**
	 * Add people to the GEDCOM file
	 * @param $people array|PersonPageValues
	 */
	public function addPeople( $people ) {
		foreach( $people as $person ) {
			$this->people[$person->title->getArticleID()] = $person;
		}
		if( !empty( $people ) && $this->file !== '' ) {
			$this->file  = '';
		}
	}

	/**
	 * Return the file
	 * @return string
	 */
	public function getFile() {
		if( $this->file === '' ) {
			$this->setFile();
		}
		return $this->file;
	}

	/**
	 * set file in $this->file property
	 */
	protected abstract function setFile();
}


class Gedcom5FilePrinter extends GenealogicalFilePrinter {

	protected $families = array();
	protected $familiesByPerson = array();

	/**
	 * set file in $this->file property
	 */
	protected function setFile() {
		$this->setFamiliesList();

		$this->addHead();
		foreach( $this->people as $key => $person ) {
			$this->addPerson( $key, $person );
		}
		foreach( $this->families as $key => $children ) {
			$this->addFamily( $key, $children );
		}
		$this->addRow( 0, 'TRLR' );
	}

	protected function setFamiliesList() {
		$i = 1;
		foreach( $this->people as $child ) {
			$id = $this->getFamilyIdForChild( $child );
			if( $id != '0S0' ) {
				$this->addChildToFamily( $id, $child );
				list( $fatherId, $motherId ) = explode('S', $id );
				$this->addFamilyToPerson( $id, $fatherId );
				$this->addFamilyToPerson( $id, $motherId );
			}
		}
	}

	protected function getFamilyIdForChild( PersonPageValues $child ) {
		$key = '';
		if( $child->father instanceof SMWDIWikiPage && isset( $this->people[$child->father->getTitle()->getArticleID()] ) ) {
			$key .= $child->father->getTitle()->getArticleID() . 'S';
			if( $child->mother instanceof SMWDIWikiPage && isset( $this->people[$child->mother->getTitle()->getArticleID()] ) ) {
				$key .= $child->mother->getTitle()->getArticleID();
			} else {
				$key .= '0';
			}
		} else {
			$key .= '0S';
			if( $child->mother instanceof SMWDIWikiPage && isset( $this->people[$child->mother->getTitle()->getArticleID()] ) ) {
				$key .= $child->mother->getTitle()->getArticleID();
			} else {
				$key .= '0';
			}
		}
		return $key;
	}

	protected function addChildToFamily( $familyKey, PersonPageValues $child ) {
		$childId = $child->title->getArticleID();
		if( isset( $this->families[$familyKey] ) ) {
			if( !in_array( $childId, $this->families[$familyKey] ) ) {
				$this->families[$familyKey][] = $childId;
			}
		} else {
			$this->families[$familyKey] = array( $childId );
		}
	}

	protected function addFamilyToPerson( $familyId, $personId ) {
		if( $personId != 0 ) {
			if( isset( $this->familiesByPerson[$personId] ) ) {
				if( !in_array( $familyId, $this->familiesByPerson[$personId] ) ) {
					$this->familiesByPerson[$personId][] = $familyId;
				}
			} else {
				$this->familiesByPerson[$personId] = array( $familyId );
			}
		}
	}

	/**
	 * add GEDCOM header
	 */
	protected function addHead() {
		global $wgSitename, $wgRightsText;

		$this->addRow( 0, 'HEAD' );
		$this->addRow( 1, 'SOUR', 'unregistered' );
		$this->addRow( 2, 'NAME', 'Semantic Genealogy' );
		$this->addRow( 2, 'VERS', SG_VERSION  );
		$this->addRow( 2, 'DATA', $wgSitename );
		if( isset( $wgRightsText ) && $wgRightsText ) {
			$this->addRow( 3, 'COPR', $wgRightsText );
		}
		//$this->addRow( 1, 'FILE',  ); //TODO name of the file
		$this->addRow( 1, 'DATE', strtoupper( date( 'd M Y' ) ) );
		$this->addRow( 2, 'TIME', date( 'H:i:s' ) ); //TODO hh:mm:ss.fs
		$this->addRow( 1, 'GEDC' );
		$this->addRow( 2, 'VERS', 5.5 );
		$this->addRow( 2, 'FORM', 'LINEAGE-LINKED' );
		$this->addRow( 1, 'CHAR', 'UTF8' );
		//$this->addRow( 1, 'LANG',  ); //TODO ?
	}

	/**
	 * add the GEDCOM for a person
	 * @param $person PersonPageValues
	 */
	protected function addPerson( $id, PersonPageValues $person ) {
		$this->addRow( 0, '@I'. $id . '@', 'INDI' );
		$this->addRow( 1, 'NAME', $this->getGedcomName( $person ) );
		$this->addStringValueAsRow( 2, 'GIVN', $person->givenname );
		$this->addStringValueAsRow( 2, 'SURN', $person->surname );
		$this->addStringValueAsRow( 2, 'NICK', $person->nickname );
		$this->addStringValueAsRow( 2, 'NPFX', $person->prefix );
		$this->addStringValueAsRow( 2, 'NSFX', $person->suffix );
		$this->addStringValueAsRow( 1, 'SEX', $person->sex );
		$familyId = $this->getFamilyIdForChild( $person );
		if( $familyId != '0S0' ) {
			$this->addRow( 1, 'FAMC', '@F'. $familyId . '@' );
		}
		if( isset( $this->familiesByPerson[$id] ) ) {
			foreach( $this->familiesByPerson[$id] as $familyId ) {
				$this->addRow( 1, 'FAMS', '@F'. $familyId . '@' );
			}
		}
		$this->addEvent( 'BIRT', $person->birthdate, $person->birthplace );
		$this->addEvent( 'DEAT', $person->deathdate, $person->deathplace );
	}

	protected function addFamily( $id, $children ) {
		list( $fatherId, $motherId ) = explode('S', $id );
		$this->addRow( 0, '@F'. $id . '@', 'FAM' );
		if( $fatherId != 0 ) {
			$this->addRow( 1, 'HUSB', '@I' . $fatherId . '@' );
		}
		if( $motherId != 0 ) {
			$this->addRow( 1, 'WIFE', '@I' . $fatherId . '@' );
		}
		foreach( $children as $childId ) {
			$this->addRow( 1, 'CHIL', '@I' . $childId . '@' );
		}
	}

	protected function getGedcomName( PersonPageValues $person ) {
		$name = '';
		if( $person->givenname instanceof SMWDIBlob && $person->givenname->getString() != '' ) {
			$name .= $person->givenname->getString();
		}
		if( $person->surname instanceof SMWDIBlob && $person->surname->getString() != '' ) {
			$name .= '/' . $person->surname->getString() . '/';
		}
		if( $person->suffix instanceof SMWDIBlob && $person->suffix->getString() != '' ) {
			$name .= $person->suffixname->getString();
		}
		return $name;
	}

	protected function addRow( $level, $key, $value = null ) {
		$this->file .= $level . ' ' . $key;
		if( $value !== null ) {
			$this->file .= ' ' . str_replace( '\n', ' ', $value );
		}
		$this->file .= "\n";
	}

	/**
	* TODO add places metadata support.
	*/
	protected function addEvent( $type, $date, $place ) {
		if( $date === null && $place === null ) {
			return;
		}
		$this->addRow( 1, $type );
		$this->addTimeValueAsRow( 2, 'DATE', $date );
		if( $place instanceof SMWDIWikiPage ) {
			$this->addWikiPageValueAsRow( 2, 'PLAC', $place );
		} else {
			$this->addStringValueAsRow( 2, 'PLAC', $place );
		}
	}

	protected function addStringValueAsRow( $level, $key, $value ) {
		if( $value instanceof SMWDIBlob ) {
			$this->addRow( $level, $key, $value->getString() );
		}
	}

	protected function addTimeValueAsRow( $level, $key, $value ) {
		if( $value instanceof SMWDITime ) {
			$lang = new Language();
			$this->addRow( $level, $key, strtoupper( $lang->sprintfDate( 'd M Y', $value->getMwTimestamp( TS_MW ) ) ) );
		}
	}

	protected function addWikiPageValueAsRow( $level, $key, $value ) {
		if( $value instanceof SMWDIWikiPage ) {
			$this->addRow( $level, $key, $value->getTitle()->getText() );
		}
	}
}
