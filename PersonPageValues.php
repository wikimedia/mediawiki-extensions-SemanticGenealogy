<?php

/**
 * Special page that store genealogical data of a person
 *
 * @file PersonPageValues.php
 * @ingroup SemanticGenealogy
 *
 * @licence GNU GPL v2+
 * @author Thomas Pellissier Tanon < thomaspt@hotmail.fr >
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
	protected $children;

	/**
	 * Constructor for a single indi in the file.
	 */
	public function __construct( SMWDIWikiPage $page ) {
		$values = array();
		$storage = smwfGetStore();
		$this->page = $page;
		$this->title = $page->getTitle();
		$properties = SemanticGenealogy::getProperties();
		foreach( $properties as $key => $prop ) {
			$values = $storage->getPropertyValues( $page, $prop );
			if ( count( $values ) != 0 && property_exists('PersonPageValues', $key) ) {
				$this->$key = $values[0];
			}
		}

		if( !( $this->fullname instanceof SMWDIBlob ) ) {
			if( $this->surname instanceof SMWDIBlob && $this->surname->getString() != '' ) {
				$fullname = '';
				if( $this->givenname instanceof SMWDIBlob ) {
					$fullname .= $this->givenname->getString() . ' ';
				}
				$this->fullname = new SMWDIBlob( $fullname . $this->surname->getString() );
			} else {
				$this->fullname = new SMWDIBlob( $this->title->getText() );
			}
		}
	}

	/**
	 * Return all the children as PersonPageValues
	 *
	 * @return array
	 */
	public function getChildren() {
		if( $this->children !== null )
			return $this->children;

		$this->children = array();
		$storage = smwfGetStore();
		$properties = SemanticGenealogy::getProperties();
		if( $properties['father'] instanceof SMWDIProperty ) {
			$childrenPage = $storage->getPropertySubjects( $properties['father'], $this->page );
			foreach($childrenPage as $page) {
				$this->children[] = new PersonPageValues( $page );
			}
		}
		if( $properties['mother'] instanceof SMWDIProperty ) {
			$childrenPage = $storage->getPropertySubjects( $properties['mother'], $this->page );
			foreach($childrenPage as $page) {
				$this->children[] = new PersonPageValues( $page );
			}
		}

		usort( $this->children, array( "PersonPageValues", "comparePeopleByBirthDate" ) );
		return $this->children;
	}

	public static function comparePeopleByBirthDate(PersonPageValues $a, PersonPageValues $b) {
		if( $a->birthdate instanceof SMWDITime ) {
			$aKey = $a->birthdate->getSortKey();
		} else {
			$aKey = 3000;
		}

		if( $b->birthdate instanceof SMWDITime ) {
			$bKey = $b->birthdate->getSortKey();
		} else {
			$bKey = 3000;
		}

		if( $bKey < $aKey ) {
			return 1;
		} elseif( $bKey == $aKey ) {
			return 0;
		} else {
			return -1;
		}
	}

	public function getDescriptionWikiText( $withBr = false ) {
		$text = '[[' . $this->title->getFullText() . '|' . $this->fullname->getString() . ']]';
		if( $this->birthdate || $this->deathdate ) {
			if( $withBr ) {
				$text .= '<br />';
			}
			$text .= ' (';
			if( $this->birthdate instanceof SMWDITime ) {
				$text .= self::getWikiTextDateFromSMWDITime( $this->birthdate ) . ' ';
			}
			$text .= '-';
			if( $this->deathdate instanceof SMWDITime ) {
				$text .= ' ' . self::getWikiTextDateFromSMWDITime( $this->deathdate );
			}
			$text .= ')';
		}
		return $text;
	}

	protected static function getWikiTextDateFromSMWDITime( SMWDITime $di ) {
		$val = new SMWTimeValue( SMWDataItem::TYPE_TIME );
		$val->setDataItem( $di );
		return $val->getShortWikiText();
	}
}
