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
	'semanticgenealogy-desc' => 'Provides the ability to view genealogy trees and import/export GEDCOM files',
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
	'semanticgenealogy-specialfamilytree-error-nosecondpagename' => 'You have to set a name of page person page in "{{int:semanticgenealogy-specialfamilytree-label-page2}}" field.',
	'semanticgenealogy-specialfamilytree-error-nolinkfound' => 'No link found between [[$1]] and [[$2]].',
	'semanticgenealogy-specialfamilytree-error-unknowntype' => 'The $1 type is unknown.',
);

/** Message documentation
 * @author Thomas Pellissier Tanon
 */
$messages['qqq'] = array(
	'semanticgenealogy-desc' => '{{desc}}',
	'semanticgenealogy-gedcomexport-desc' => 'Description of the GEDCOM result printer.',
	'semanticgenealogy-gedcomexport-link' => 'Default link label to a GEDCOM file.',
	'semanticgenealogy-specialfamilytree-title' => 'Title of the [[Special:FamilyTree]] page.',
	'semanticgenealogy-specialfamilytree-button-submit' => 'Submit button of the [[Special:FamilyTree]] form.',
	'semanticgenealogy-specialfamilytree-type-ancestors' => 'Label of an ancestors tree.',
	'semanticgenealogy-specialfamilytree-type-descendant' => 'Label of a descendants tree.',
	'semanticgenealogy-specialfamilytree-type-link' => 'Label of the search of the closest family link between two people.',
	'semanticgenealogy-specialfamilytree-label-page' => 'Label of the "base person page name" input.',
	'semanticgenealogy-specialfamilytree-label-page2' => 'Label of the "second base person page name" input (only for "link" type).',
	'semanticgenealogy-specialfamilytree-label-type' => 'Label of the "type of family tree" select.',
	'semanticgenealogy-specialfamilytree-label-gen' => 'Label of the form field in order to input the number of generation in the tree.',
	'semanticgenealogy-specialfamilytree-error-nosecondpagename' => 'Error message when the "page2" field is not set (only for "link" type).',
	'semanticgenealogy-specialfamilytree-error-nolinkfound' => 'Error message where no link is found between $1 and $2.',
	'semanticgenealogy-specialfamilytree-error-unknowntype' => 'Error massage when the type of the family tree is unknown.',
);

/** French (Français)
 * @author Thomas Pellissier Tanon
 */
$messages['fr'] = array(
	'semanticmaps-desc' =>  "Permet d'afficher des arbres généalogiques ainsi que d'importer et d'exporter les fichiers GEDCOMs",
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
	'semanticgenealogy-specialfamilytree-error-nosecondpagename' => 'Vous devez mettre le nomd d\'une page dans le champ "{{int:semanticgenealogy-specialfamilytree-label-page2}}".',
	'semanticgenealogy-specialfamilytree-error-nolinkfound' => 'Aucun lien trouvé entre [[$1]] et [[$2]].',
	'semanticgenealogy-specialfamilytree-error-unknowntype' => 'Le type $1 est inconnu.',
);

