<?php

use MediaWiki\Html\Html;

/**
 * Special page that show a family tree
 *
 * @file    SpecialFamilyTree.php
 * @ingroup SemanticGenealogy
 *
 * @license GPL-2.0-or-later
 * @author  Thomas Pellissier Tanon <thomaspt@hotmail.fr>
 */
class SpecialFamilyTree extends SpecialPage {

	private $type;
	private $gen;
	private $page;
	private $page2;
	private $decorator;

	private $params = [ 'type', 'gen', 'page', 'page2', 'decorator', 'displayname' ];

	/**
	 * @param string $name the name of the SpecialPage
	 */
	public function __construct( $name = 'FamilyTree' ) {
		parent::__construct( $name, '' );
		$this->mIncludable = true;
	}

	/**
	 * Parse the Form/Template parameters to feed the properties of the SpecialPage
	 *
	 * @param string $par
	 * @return void
	 */
	private function parseParameters( $par ) {
		global $wgRequest;

		if ( $par != '' ) {
			$parts = explode( '/', urldecode( $par ) );
		} else {
			$parts = [];
		}

		$this->type = isset( $parts[0] ) ? $parts[0] : $wgRequest->getText( 'type' );
		if ( $this->type == '' ) {
			$this->type = AncestorsFamilyTree::NAME;
		}

		$this->decorator = isset( $parts[1] ) ? $parts[1] : $wgRequest->getText( 'decorator' );
		if ( $this->decorator == '' ) {
			$this->decorator = SimpleDecorator::NAME;
		}

		$this->page = isset( $parts[1] ) ? $parts[1] : $wgRequest->getText( 'page' );

		$this->displayname = isset( $parts[1] ) ? $parts[1] : $wgRequest->getText( 'displayname' );
		if ( !$this->displayname ) {
			$this->displayname = 'fullname';
		}

		if ( $this->type == LinkFamilyTree::NAME ) {
			$this->page2 = isset( $parts[2] ) ? $parts[2] : $wgRequest->getText( 'page2' );
			$this->gen = 0;
		} else {
			$this->gen = isset( $parts[2] ) ? intval( $parts[2] ) : $wgRequest->getInt( 'gen' );
			if ( $this->gen <= 0 ) {
				$this->gen = 5;
			}
			$this->page2 = '';
		}
	}

	/**
	 * Execute the Special Page
	 *
	 * @param string $par the url part
	 */
	public function execute( $par ) {
		global $wgOut;
		$this->setHeaders();

		$this->parseParameters( $par );

		$this->showForm();

		if ( $this->page == '' ) {
			return;
		}

		$output = $this->getOutput();

		$output->addModuleStyles( 'ext.smg.specialfamilytree' );

		try {

			$familytree = FamilyTreeFactory::create( $this->type, $this->decorator );
			$familytree->setPerson( $this->page );
			$familytree->setDisplayName( $this->displayname );

			if ( $this->page2 ) {
				$familytree->setPerson2( $this->page2 );
			}

			$familytree->setOutput( $this->getOutput() );
			$familytree->setNumberOfGenerations( $this->gen );

			$familytree->render();
		} catch ( SemanticGenealogyException $e ) {
			$wgOut->addWikiText( '<span class="error">' . $e->getMessage() . '</span>' );
		} catch ( Exception $e ) {
			$wgOut->addWikiText( '<span class="error">' . $e->getMessage() . '</span>' );
		}
	}

	/**
	 * Display the search form for a genealogy tree
	 *
	 * @return void
	 */
	protected function showForm() {
		global $wgScript;

		if ( !$this->mIncluding ) {
			$output = $this->getOutput();
			$output->addModules( 'ext.smg.specialfamilytree' );

			$trees = FamilyTreeFactory::listTrees();
			$typeSelect = new XmlSelect( 'type', 'type', $this->type );
			foreach ( $trees as $tree ) {
				$typeSelect->addOption(
					$this->msg( 'semanticgenealogy-specialfamilytree-type-' . $tree::NAME )->text(), $tree::NAME );
			}
			$decorators = TreeDecoratorFactory::listDecorators();
			$decoratorSelect = new XmlSelect( 'decorator', 'decorator', $this->decorator );
			foreach ( $decorators as $decorator ) {
				$decoratorSelect->addOption(
					$this->msg(
						'semanticgenealogy-specialfamilytree-decorator-' . $decorator::NAME )->text(),
						$decorator::NAME
					   );
			}

			$displaynameSelect = new XmlSelect( 'displayname', 'displayname', $this->displayname );
			$displaynameSelect->addOption(
				$this->msg( 'semanticgenealogy-specialfamilytree-displayname-fullname' )->text(), 'fullname' );
			$displaynameSelect->addOption(
				$this->msg( 'semanticgenealogy-specialfamilytree-displayname-pagename' )->text(), 'pagename' );

			$output->addHTML(
				Xml::openElement( 'form', [ 'action' => $wgScript ] ) .
				Html::hidden( 'title', $this->getPageTitle()->getPrefixedText() ) .
				Xml::openElement( 'fieldset' ) .
				Xml::openElement( 'table', [ 'id' => 'smg-familyTree-form' ] ) .
				Xml::openElement( 'tr', [ 'id' => 'smg-form-entry-page' ] ) .
				Xml::openElement( 'th', [ 'class' => 'mw-label' ] ) .
				Xml::label( $this->msg( 'semanticgenealogy-specialfamilytree-label-page' )->text(), 'page' ) .
				Xml::closeElement( 'th' ) .
				Xml::openElement( 'td', [ 'class' => 'mw-input' ] ) .
				Html::input( 'page', $this->page, 'text', [ 'class' => 'smg-input-page', 'size' => 30 ] ) .
				Xml::closeElement( 'td' ) .
				Xml::closeElement( 'tr' ) .
				Xml::openElement( 'tr', [ 'id' => 'smg-form-entry-type' ] ) .
				Xml::openElement( 'th', [ 'class' => 'mw-label' ] ) .
				Xml::label( $this->msg( 'semanticgenealogy-specialfamilytree-label-type' )->text(), 'type' ) .
				Xml::closeElement( 'th' ) .
				Xml::openElement( 'td', [ 'class' => 'mw-input' ] ) .
				$typeSelect->getHtml() .
				Xml::closeElement( 'td' ) .
				Xml::closeElement( 'tr' ) .
				Xml::openElement( 'tr', [ 'id' => 'smg-form-entry-decorator' ] ) .
				Xml::openElement( 'th', [ 'class' => 'mw-label' ] ) .
				Xml::label(
					$this->msg( 'semanticgenealogy-specialfamilytree-label-decorator' )->text(), 'decorator'
				   ) .
				Xml::closeElement( 'th' ) .
				Xml::openElement( 'td', [ 'class' => 'mw-input' ] ) .
				$decoratorSelect->getHtml() .
				Xml::closeElement( 'td' ) .
				Xml::closeElement( 'tr' ) .
				Xml::openElement( 'tr', [ 'id' => 'smg-form-entry-displayname' ] ) .
				Xml::openElement( 'th', [ 'class' => 'mw-label' ] ) .
				Xml::label(
					$this->msg( 'semanticgenealogy-specialfamilytree-label-displayname' )->text(), 'displayname'
				   ) .
				Xml::closeElement( 'th' ) .
				Xml::openElement( 'td', [ 'class' => 'mw-input' ] ) .
				$displaynameSelect->getHtml() .
				Xml::closeElement( 'td' ) .
				Xml::closeElement( 'tr' ) .
				Xml::openElement( 'tr', [ 'id' => 'smg-form-entry-gen' ] ) .
				Xml::openElement( 'th', [ 'class' => 'mw-label' ] ) .
				Xml::label( $this->msg( 'semanticgenealogy-specialfamilytree-label-gen' )->text(), 'gen' ) .
				Xml::closeElement( 'th' ) .
				Xml::openElement( 'td', [ 'class' => 'mw-input' ] ) .
				Html::input( 'gen', $this->gen, 'text', [ 'size' => 2 ] ) .
				Xml::closeElement( 'td' ) .
				Xml::closeElement( 'tr' ) .
				Xml::openElement( 'tr', [ 'id' => 'smg-form-entry-page2' ] ) .
				Xml::openElement( 'th', [ 'class' => 'mw-label' ] ) .
				Xml::label( $this->msg( 'semanticgenealogy-specialfamilytree-label-page2' )->text(), 'page2' ) .
				Xml::closeElement( 'th' ) .
				Xml::openElement( 'td', [ 'class' => 'mw-input' ] ) .
				Html::input( 'page2', $this->page2, 'text', [ 'class' => 'smg-input-page', 'size' => 30 ] ) .
				Xml::closeElement( 'td' ) .
				Xml::closeElement( 'tr' ) .
				Xml::closeElement( 'table' ) .
				Html::submitButton( $this->msg( 'semanticgenealogy-specialfamilytree-button-submit' )->text(), [] ) .
				Xml::closeElement( 'fieldset' ) .
				Xml::closeElement( 'form' )
			);

			if ( $this->page ) {
				$output->addHTML(
					$this->msg( 'semanticgenealogy-specialfamilytree-label-insert-code' )->text()
					. "<br/>\n<code>" . $this->getWikiCode() . "</code><br/><br/>" );

			}
		}
	}

	/**
	 * Generate the wiki code to use for this tree
	 *
	 * @return string the wiki code
	 */
	private function getWikiCode() {
		$code = "{{" . preg_replace( "/Special/", "$0:", get_class( $this ) );
		foreach ( $this->params as $param ) {
			if ( !$this->$param ) {
				continue;
			}
			$code .= "|" . $param . "=" . $this->$param;
		}
		$code .= "}}";
		return $code;
	}

	/**
	 * Wether the page is cachable
	 *
	 * @return bool
	 */
	public function isCacheable() {
		return false;
	}

	/**
	 * Get the description
	 *
	 * @return string
	 */
	public function getDescription() {
		return $this->msg( 'semanticgenealogy-specialfamilytree-title' )->text();
	}

	/**
	 * Get the groupe name
	 *
	 * @return string
	 */
	protected function getGroupName() {
		return 'genealogy';
	}
}
