<?php
/**
 * Internationalization file for the Semantic Genealogy extension
 *
 * @file SemanticGenealogy.i18n.php
 * @ingroup SemanticGenealogy
 *
 * @licence GNU GPL v2+
 * @author Thomas Pellissier Tanon < thomaspt@hotmail.fr >
 */

$messages = array();

/** English
 * @author Thomas Pellissier Tanon
 */
$messages['en'] = array(
	'semanticgenealogy-desc' => 'Provides the ability to view genealogy trees and import/export GEDCOM files.',
	'semanticgenealogy-gedcomexport-desc' => 'GEDCOM export',
	'semanticgenealogy-gedcomexport-link' => 'GEDCOM',
	'semanticgenealogy-specialfamilytree-title' => 'Create a Family Tree',
	'semanticgenealogy-specialfamilytree-button-submit' => 'Create',
	'semanticgenealogy-specialfamilytree-type-ancestors' => 'Ancestors',
	'semanticgenealogy-specialfamilytree-type-descendant' => 'Descendant',
	'semanticgenealogy-specialfamilytree-type-link' => 'Link',
	'semanticgenealogy-specialfamilytree-label-page' => 'Base person',
	'semanticgenealogy-specialfamilytree-label-page2' => 'Other person',
	'semanticgenealogy-specialfamilytree-label-type' => 'Type',
	'semanticgenealogy-specialfamilytree-label-gen' => 'Number of generation',
	'semanticgenealogy-specialfamilytree-error-nosecondpagename' => 'You have to set a name of page person page in "Other person" field.',
	'semanticgenealogy-specialfamilytree-error-nolinkfound' => 'No link found between [[$1]] and [[$2]].',
	'semanticgenealogy-specialfamilytree-error-unknowntype' => 'The $1 type is unknown.',
);

/** Message documentation
 * @author Thomas Pellissier Tanon
 */
$messages['qqq'] = array(
	'semanticgenealogy-desc' => '{{desc}}',
);


/** French (Français)
 * @author Thomas Pellissier Tanon
 */
$messages['fr'] = array(
	'semanticmaps-desc' =>  "Permet d'afficher des arbres généalogiques ainsi que d'importer et d'exporter les fichiers GEDCOMs.",
	'semanticgenealogy-gedcomexport-desc' => 'Export GEDCOM',
	'semanticgenealogy-gedcomexport-link' => 'GEDCOM',
	'semanticgenealogy-specialfamilytree-title' => 'Créer un arbre généalogique',
	'semanticgenealogy-specialfamilytree-button-submit' => 'Créer',
	'semanticgenealogy-specialfamilytree-type-ancestors' => 'Ascendance',
	'semanticgenealogy-specialfamilytree-type-descendant' => 'Descendance',
	'semanticgenealogy-specialfamilytree-type-link' => 'Lien de parenté',
	'semanticgenealogy-specialfamilytree-label-page' => 'Personne de départ',
	'semanticgenealogy-specialfamilytree-label-page2' => 'Seconde personne',
	'semanticgenealogy-specialfamilytree-label-type' => 'Type',
	'semanticgenealogy-specialfamilytree-label-gen' => 'Nombre de générations',
	'semanticgenealogy-specialfamilytree-error-nosecondpagename' => 'Vous devez mettre le nomd d\'une page dans le champ "autre personne".',
	'semanticgenealogy-specialfamilytree-error-nolinkfound' => 'Aucun lien trouvé entre [[$1]] et [[$2]].',
	'semanticgenealogy-specialfamilytree-error-unknowntype' => 'Le type $1 est inconnu.',
);
