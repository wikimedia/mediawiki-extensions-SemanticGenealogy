<?php

use MediaWiki\Title\Title;

/**
 * Model object that store genealogical data of a person
 *
 * @file    PersonPageValues.php
 * @ingroup SemanticGenealogy
 *
 * @license GPL-2.0-or-later
 * @author  Thomas Pellissier Tanon <thomaspt@hotmail.fr>
 */
class PersonPageValues {
	protected $page;
	public $title;
	public $fullname;
	public $surname;
	public $givenname;
	public $nickname;
	public $prefix;
	public $suffix;
	public $sex;
	public $birthdate;
	public $birthplace;
	public $deathdate;
	public $deathplace;
	public $father;
	public $mother;
	public $partner;
	protected $children;

	/**
	 * Constructor for a single indi in the file.
	 *
	 * @param SMWDIWikiPage $page
	 */
	public function __construct( SMWDIWikiPage $page ) {
		$values = [];
		$storage = smwfGetStore();
		$this->page = $page;
		$this->title = $page->getTitle();
		$properties = SemanticGenealogy::getProperties();
		foreach ( $properties as $key => $prop ) {
			$values = $storage->getPropertyValues( $page, $prop );
			if ( count( $values ) != 0 && property_exists( 'PersonPageValues', $key ) ) {
				$this->$key = $values[0];
			}
		}

		if ( !( $this->fullname instanceof SMWDIBlob ) ) {
			if ( $this->surname instanceof SMWDIBlob && $this->surname->getString() != '' ) {
				$fullname = '';
				if ( $this->givenname instanceof SMWDIBlob ) {
					$fullname .= $this->givenname->getString() . ' ';
				}
				$this->fullname = new SMWDIBlob( $fullname . $this->surname->getString() );
			} else {
				$this->fullname = new SMWDIBlob( $this->title->getText() );
			}
		}
	}

	/**
	 * Get the page of the person
	 *
	 * @return SMWDIWikiPage the current page
	 */
	public function getPage() {
		return $this->page;
	}

	/**
	 * Return all the children as PersonPageValues
	 *
	 * @return array
	 */
	public function getChildren() {
		if ( $this->children !== null ) {
			return $this->children;
		}

		$this->children = [];
		$storage = smwfGetStore();
		$properties = SemanticGenealogy::getProperties();
		if ( $properties['father'] instanceof SMWDIProperty ) {
			$childrenPage = $storage->getPropertySubjects( $properties['father'], $this->page );
			foreach ( $childrenPage as $page ) {
				$this->children[] = new PersonPageValues( $page );
			}
		}
		if ( $properties['mother'] instanceof SMWDIProperty ) {
			$childrenPage = $storage->getPropertySubjects( $properties['mother'], $this->page );
			foreach ( $childrenPage as $page ) {
				$this->children[] = new PersonPageValues( $page );
			}
		}

		usort( $this->children, [ "PersonPageValues", "comparePeopleByBirthDate" ] );
		return $this->children;
	}

	/**
	 * Return the partner
	 *
	 * @return array
	 */
	public function getPartner() {
		if ( $this->partner !== null ) {
			return $this->partner;
		}

		$storage = smwfGetStore();
		$properties = SemanticGenealogy::getProperties();
		if ( $properties['partner'] instanceof SMWDIProperty ) {
			$page = $storage->getPropertySubjects( $properties['father'], $this->page );
			if ( $page instanceof SMWDIWikiPage ) {
				$this->partner = new PersonPageValues( $page );
			}
		}
		return $this->partner;
	}

	/**
	 * Sorter to compare 2 persons based on their date of birth
	 *
	 * @param PersonPageValues $personA
	 * @param PersonPageValues $personB
	 * @return int a comparaison integer
	 */
	private static function comparePeopleByBirthDate( PersonPageValues $personA,
		PersonPageValues $personB ) {
		if ( $personA->birthdate instanceof SMWDITime ) {
			$aKey = $personA->birthdate->getSortKey();
		} else {
			$aKey = 3000;
		}

		if ( $personB->birthdate instanceof SMWDITime ) {
			$bKey = $personB->birthdate->getSortKey();
		} else {
			$bKey = 3000;
		}

		if ( $bKey < $aKey ) {
			return 1;
		} elseif ( $bKey == $aKey ) {
			return 0;
		} else {
			return -1;
		}
	}

	/**
	 * Get the correct name to display a person (either the fullname, or the pagename)
	 *
	 * @param string $displayName the name to display
	 *
	 * @return string the name of the person
	 */
	public function getPersonName( $displayName ) {
		if ( $displayName == 'pagename' ) {
			return $this->title->getFullText();
		} elseif ( $displayName == 'fullname' ) {
			return $this->fullname->getString();
		}
		return $this->title->getFullText();
	}

	/**
	 * Generate the Person description wiki text based on the special pages options
	 *
	 * @param bool $withBr adding <br> tags or not
	 * @param string $displayName the display type tag
	 *
	 * @return string the text to display
	 */
	public function getDescriptionWikiText( $withBr = false, $displayName = 'fullname' ) {
		$yearRegexp = "/.*\b(\d\d\d\d)\b.*/";
		$text = '<div class="person-block">';
		$text .= '<div class="person-name">';
		$text .= '[[' . $this->title->getFullText() . '|' . $this->getPersonName( $displayName ) . ']]';
		$text .= '</div>';
		if ( $this->birthdate || $this->deathdate ) {
			$text .= '<span class="person-dates">';
			if ( $withBr ) {
				$text .= '<br />';
			}
			$text .= '(';
			if ( $this->birthdate instanceof SMWDITime ) {
				$text .= static::getWikiTextDateFromSMWDITime( $this->birthdate ) . ' ';
			} elseif ( is_string( $this->birthdate ) && preg_match( $yearRegexp, $this->birthdate ) ) {
				$text .= preg_replace( $yearRegexp, "$1", $this->birthdate );
			}
			$text .= '-';
			if ( $this->deathdate instanceof SMWDITime ) {
				$text .= ' ' . static::getWikiTextDateFromSMWDITime( $this->deathdate );
			} elseif ( is_string( $this->deathdate ) && preg_match( $yearRegexp, $this->deathdate ) ) {
				$text .= preg_replace( $yearRegexp, "$1", $this->deathdate );
			}
			$text .= ')</span>';
		}
		$text .= '</div>';
		return $text;
	}

	/**
	 * Get a string base on the SMWDITime object
	 *
	 * @param SMWDITime $dataItem the time item
	 *
	 * @return string the wiki text for a given date
	 */
	protected static function getWikiTextDateFromSMWDITime( SMWDITime $dataItem ) {
		$val = new SMWTimeValue( SMWDataItem::TYPE_TIME );
		$val->setDataItem( $dataItem );
		return $val->getShortWikiText();
	}

	/**
	 * Get the page from the pageName
	 *
	 * @param string $pageName the page name
	 *
	 * @return SMWDIWikiPage the page object
	 */
	public static function getPageFromName( $pageName ) {
		$pageTitle = Title::newFromText( $pageName );
		return SMWDIWikiPage::newFromTitle( $pageTitle );
	}
}
