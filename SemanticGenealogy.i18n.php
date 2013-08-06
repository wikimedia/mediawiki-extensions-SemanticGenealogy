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
	'semanticgenealogy-specialfamilytree-error-nosecondpagename' => 'You have to provide a name of a persons page in "{{int:semanticgenealogy-specialfamilytree-label-page2}}" field.',
	'semanticgenealogy-specialfamilytree-error-nolinkfound' => 'No link found between [[$1]] and [[$2]].',
	'semanticgenealogy-specialfamilytree-error-unknowntype' => 'The $1 type is unknown.',
);

/** Message documentation (Message documentation)
 * @author Shirayuki
 * @author Thomas Pellissier Tanon
 */
$messages['qqq'] = array(
	'semanticgenealogy-desc' => '{{desc|name=Semantic Genealogy|url=http://www.mediawiki.org/wiki/Extension:Semantic_Genealogy}}',
	'semanticgenealogy-gedcomexport-desc' => 'Description of the GEDCOM result printer.',
	'semanticgenealogy-gedcomexport-link' => '{{Optional}}
Default link label to a GEDCOM file.',
	'semanticgenealogy-specialfamilytree-title' => 'Title of the [[Special:FamilyTree]] page.',
	'semanticgenealogy-specialfamilytree-button-submit' => 'Submit button of the [[Special:FamilyTree]] form.
{{Identical|Create}}',
	'semanticgenealogy-specialfamilytree-type-ancestors' => 'Label of an ancestors tree.',
	'semanticgenealogy-specialfamilytree-type-descendant' => 'Label of a descendants tree.',
	'semanticgenealogy-specialfamilytree-type-link' => 'Label of the search of the closest family link between two people.
{{Identical|Link}}',
	'semanticgenealogy-specialfamilytree-label-page' => 'Label of the "base person page name" input.',
	'semanticgenealogy-specialfamilytree-label-page2' => 'Label of the "second base person page name" input (only for "link" type).',
	'semanticgenealogy-specialfamilytree-label-type' => 'Label of the "type of family tree" select.
{{Identical|Type}}',
	'semanticgenealogy-specialfamilytree-label-gen' => 'Label of the form field in order to input the number of generation in the tree.',
	'semanticgenealogy-specialfamilytree-error-nosecondpagename' => 'Error message when the "page2" field is not set (only for "link" type).',
	'semanticgenealogy-specialfamilytree-error-nolinkfound' => 'Error message where no link is found between $1 and $2.',
	'semanticgenealogy-specialfamilytree-error-unknowntype' => 'Error massage when the type of the family tree is unknown.',
);

/** Breton (brezhoneg)
 * @author Fohanno
 * @author Y-M D
 */
$messages['br'] = array(
	'semanticgenealogy-gedcomexport-desc' => 'Ezporzhiañ GEDCOM',
	'semanticgenealogy-specialfamilytree-title' => 'Krouiñ ur wezenn a gerentiezh',
	'semanticgenealogy-specialfamilytree-button-submit' => 'Krouiñ',
	'semanticgenealogy-specialfamilytree-type-ancestors' => 'Hendadoù',
	'semanticgenealogy-specialfamilytree-type-descendant' => 'Diskennidi',
	'semanticgenealogy-specialfamilytree-type-link' => 'Liamm',
	'semanticgenealogy-specialfamilytree-label-page' => "Den loc'hañ",
	'semanticgenealogy-specialfamilytree-label-page2' => 'Den all',
	'semanticgenealogy-specialfamilytree-label-type' => 'Seurt',
	'semanticgenealogy-specialfamilytree-label-gen' => 'Niver a remziadoù',
	'semanticgenealogy-specialfamilytree-error-nosecondpagename' => 'Rankout a rit lakaat anv ur bajenn er maezienn "{{int:semanticgenealogy-specialfamilytree-label-page2}}".',
	'semanticgenealogy-specialfamilytree-error-nolinkfound' => "N'eus bet kavet liamm ebet etre [[$1]] ha [[$2]].",
	'semanticgenealogy-specialfamilytree-error-unknowntype' => 'Dianv eo ar seurt $1.',
);

/** Catalan (català)
 * @author Pitort
 */
$messages['ca'] = array(
	'semanticgenealogy-specialfamilytree-label-type' => 'Tipus',
);

/** German (Deutsch)
 * @author Kghbln
 * @author Metalhead64
 */
$messages['de'] = array(
	'semanticgenealogy-desc' => 'Ermöglicht das Betrachten von Stammbäumen sowie das Importieren und Exportieren von GEDCOM-Dateien',
	'semanticgenealogy-gedcomexport-desc' => 'GEDCOM-Export',
	'semanticgenealogy-specialfamilytree-title' => 'Einen Familienstammbaum erstellen',
	'semanticgenealogy-specialfamilytree-button-submit' => 'Erstellen',
	'semanticgenealogy-specialfamilytree-type-ancestors' => 'Vorfahren',
	'semanticgenealogy-specialfamilytree-type-descendant' => 'Nachfahre',
	'semanticgenealogy-specialfamilytree-type-link' => 'Verbindung',
	'semanticgenealogy-specialfamilytree-label-page' => 'Ausgangsperson',
	'semanticgenealogy-specialfamilytree-label-page2' => 'Andere Person',
	'semanticgenealogy-specialfamilytree-label-type' => 'Typ',
	'semanticgenealogy-specialfamilytree-label-gen' => 'Anzahl der Generationen',
	'semanticgenealogy-specialfamilytree-error-nosecondpagename' => 'Du musst den Namen der Seite zu einer Person im Feld „{{int:semanticgenealogy-specialfamilytree-label-page2}}“ angeben.',
	'semanticgenealogy-specialfamilytree-error-nolinkfound' => 'Es wurde keine Verbindung zwischen [[$1]] und [[$2]] gefunden.',
	'semanticgenealogy-specialfamilytree-error-unknowntype' => 'Der Typ $1 ist unbekannt.',
);

/** German (formal address) (Deutsch (Sie-Form)‎)
 * @author Kghbln
 */
$messages['de-formal'] = array(
	'semanticgenealogy-specialfamilytree-error-nosecondpagename' => 'Sie müssen den Namen der Seite zu einer Person im Feld „{{int:semanticgenealogy-specialfamilytree-label-page2}}“ angeben.',
);

/** Lower Sorbian (dolnoserbski)
 * @author Michawiki
 */
$messages['dsb'] = array(
	'semanticgenealogy-desc' => 'Zmóžnja wobglědowanje rodopisow a import/eksport GEDCOM-datajow',
	'semanticgenealogy-gedcomexport-desc' => 'GEDCOM-eksport',
	'semanticgenealogy-specialfamilytree-title' => 'Rodopis familije napóraś',
	'semanticgenealogy-specialfamilytree-button-submit' => 'Napóraś',
	'semanticgenealogy-specialfamilytree-type-ancestors' => 'Prjedowniki',
	'semanticgenealogy-specialfamilytree-type-descendant' => 'Pótomnik',
	'semanticgenealogy-specialfamilytree-type-link' => 'Wótkaz',
	'semanticgenealogy-specialfamilytree-label-page' => 'Wuchadna wósoba',
	'semanticgenealogy-specialfamilytree-label-page2' => 'Druga wósoba',
	'semanticgenealogy-specialfamilytree-label-type' => 'Typ',
	'semanticgenealogy-specialfamilytree-label-gen' => 'Licba generacijow',
	'semanticgenealogy-specialfamilytree-error-nosecondpagename' => 'Musyš mě boka k wósobje  w pólu "{{int:semanticgenealogy-specialfamilytree-label-page2}}"  pódaś.',
	'semanticgenealogy-specialfamilytree-error-nolinkfound' => 'Žeden zwisk mjazy [[$1]] a [[$2]] namakany.',
	'semanticgenealogy-specialfamilytree-error-unknowntype' => 'Typ $1 jo njeznaty.',
);

/** Greek (Ελληνικά)
 * @author Protnet
 */
$messages['el'] = array(
	'semanticgenealogy-specialfamilytree-button-submit' => 'Δημιουργία',
	'semanticgenealogy-specialfamilytree-type-ancestors' => 'Πρόγονοι',
	'semanticgenealogy-specialfamilytree-type-link' => 'Σύνδεσμος',
	'semanticgenealogy-specialfamilytree-label-type' => 'Τύπος',
);

/** Spanish (español)
 * @author Armando-Martin
 */
$messages['es'] = array(
	'semanticgenealogy-desc' => 'Proporciona la capacidad de ver árboles genealógicos e importar/exportar archivos GEDCOM',
	'semanticgenealogy-gedcomexport-desc' => 'Exportación en GEDCOM',
	'semanticgenealogy-specialfamilytree-title' => 'Crear un árbol genealógico',
	'semanticgenealogy-specialfamilytree-button-submit' => 'Crear',
	'semanticgenealogy-specialfamilytree-type-ancestors' => 'Antepasados',
	'semanticgenealogy-specialfamilytree-type-descendant' => 'Descendientes',
	'semanticgenealogy-specialfamilytree-type-link' => 'Enlace',
	'semanticgenealogy-specialfamilytree-label-page' => 'Persona base',
	'semanticgenealogy-specialfamilytree-label-page2' => 'Otra persona',
	'semanticgenealogy-specialfamilytree-label-type' => 'Tipo',
	'semanticgenealogy-specialfamilytree-label-gen' => 'Número de generación',
	'semanticgenealogy-specialfamilytree-error-nosecondpagename' => 'Tienes que definir el nombre de página de una página de persona en el campo "{{int:semanticgenealogy-specialfamilytree-label-page2}}".',
	'semanticgenealogy-specialfamilytree-error-nolinkfound' => 'No encontró ningún vínculo entre [[$1]] y [[$2]].',
	'semanticgenealogy-specialfamilytree-error-unknowntype' => 'El tipo $1 es desconocido.',
);

/** Estonian (eesti)
 * @author Avjoska
 */
$messages['et'] = array(
	'semanticgenealogy-specialfamilytree-title' => 'Loo sugupuu',
	'semanticgenealogy-specialfamilytree-button-submit' => 'Loo',
	'semanticgenealogy-specialfamilytree-type-ancestors' => 'Esivanemad',
	'semanticgenealogy-specialfamilytree-type-descendant' => 'Järeltulijad',
);

/** Persian (فارسی)
 * @author Mjbmr
 */
$messages['fa'] = array(
	'semanticgenealogy-specialfamilytree-button-submit' => 'ایجاد',
	'semanticgenealogy-specialfamilytree-type-link' => 'پیوند',
);

/** Finnish (suomi)
 * @author Beluga
 * @author Nedergard
 */
$messages['fi'] = array(
	'semanticgenealogy-desc' => 'Mahdollistaa sukupuiden näyttämisen ja GEDCOM-tiedostojen tuonnin/viennin.',
	'semanticgenealogy-gedcomexport-desc' => 'GEDCOM-vienti',
	'semanticgenealogy-specialfamilytree-title' => 'Luo sukupuu',
	'semanticgenealogy-specialfamilytree-button-submit' => 'Luo',
	'semanticgenealogy-specialfamilytree-type-ancestors' => 'Esipolvet',
	'semanticgenealogy-specialfamilytree-type-descendant' => 'Jälkipolvet',
	'semanticgenealogy-specialfamilytree-type-link' => 'Suhde',
	'semanticgenealogy-specialfamilytree-label-page' => 'Kantahenkilö',
	'semanticgenealogy-specialfamilytree-label-page2' => 'Muu henkilö',
	'semanticgenealogy-specialfamilytree-label-type' => 'Tyyppi',
	'semanticgenealogy-specialfamilytree-label-gen' => 'Sukupolvien lukumäärä',
	'semanticgenealogy-specialfamilytree-error-nosecondpagename' => 'Henkilön sivun nimi on kirjoitettava kenttään "{{int:semanticgenealogy-specialfamilytree-label-page2}}".',
	'semanticgenealogy-specialfamilytree-error-nolinkfound' => '[[$1]] ja [[$2]]: yhteyttä ei löytynyt.',
	'semanticgenealogy-specialfamilytree-error-unknowntype' => 'Tyyppi $1 on tuntematon.',
);

/** French (français)
 * @author Grondin
 * @author Thomas Pellissier Tanon
 * @author Tititou36
 */
$messages['fr'] = array(
	'semanticgenealogy-desc' => "Offre la possibilité de voir des arbres généalogiques et d'importer/exporter des fichiers GEDCOM",
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
	'semanticgenealogy-specialfamilytree-error-nosecondpagename' => "Vous devez mettre le nom d'une page dans le champ « {{int:semanticgenealogy-specialfamilytree-étiquette-page2}}. »",
	'semanticgenealogy-specialfamilytree-error-nolinkfound' => 'Aucun lien trouvé entre [[$1]] et [[$2]].',
	'semanticgenealogy-specialfamilytree-error-unknowntype' => 'Le type $1 est inconnu.',
);

/** Franco-Provençal (arpetan)
 * @author ChrisPtDe
 */
$messages['frp'] = array(
	'semanticgenealogy-specialfamilytree-button-submit' => 'Fâre',
	'semanticgenealogy-specialfamilytree-type-ancestors' => 'Vielys',
	'semanticgenealogy-specialfamilytree-type-descendant' => 'Dèscendents',
	'semanticgenealogy-specialfamilytree-type-link' => 'Lim',
	'semanticgenealogy-specialfamilytree-label-page' => 'Pèrsona de dèpârt',
	'semanticgenealogy-specialfamilytree-label-page2' => 'Seconda pèrsona',
	'semanticgenealogy-specialfamilytree-label-type' => 'Tipo',
	'semanticgenealogy-specialfamilytree-label-gen' => 'Nombro de g·ènèracions',
	'semanticgenealogy-specialfamilytree-error-nolinkfound' => 'Gins de lim trovâ entre-mié [[$1]] et [[$2]].',
	'semanticgenealogy-specialfamilytree-error-unknowntype' => 'Lo tipo $1 est encognu.',
);

/** Irish (Gaeilge)
 * @author පසිඳු කාවින්ද
 */
$messages['ga'] = array(
	'semanticgenealogy-specialfamilytree-button-submit' => 'Cruthaigh',
	'semanticgenealogy-specialfamilytree-label-type' => 'Cineál',
);

/** Galician (galego)
 * @author Toliño
 */
$messages['gl'] = array(
	'semanticgenealogy-desc' => 'Proporciona a posibilidade de ver árbores xenealóxicas e importar e exportar ficheiros GEDCOM',
	'semanticgenealogy-gedcomexport-desc' => 'Exportación en GEDCOM',
	'semanticgenealogy-specialfamilytree-title' => 'Crear unha árbore xenealóxica',
	'semanticgenealogy-specialfamilytree-button-submit' => 'Crear',
	'semanticgenealogy-specialfamilytree-type-ancestors' => 'Devanceiros',
	'semanticgenealogy-specialfamilytree-type-descendant' => 'Descendentes',
	'semanticgenealogy-specialfamilytree-type-link' => 'Ligazón',
	'semanticgenealogy-specialfamilytree-label-page' => 'Persoa situada na base',
	'semanticgenealogy-specialfamilytree-label-page2' => 'Outra persoa',
	'semanticgenealogy-specialfamilytree-label-type' => 'Tipo',
	'semanticgenealogy-specialfamilytree-label-gen' => 'Número de xeración',
	'semanticgenealogy-specialfamilytree-error-nosecondpagename' => 'Cómpre definir o nome dunha páxina no campo "{{int:semanticgenealogy-specialfamilytree-label-page2}}".',
	'semanticgenealogy-specialfamilytree-error-nolinkfound' => 'Non se atopou ligazón ningunha entre [[$1]] e [[$2]].',
	'semanticgenealogy-specialfamilytree-error-unknowntype' => 'Descoñécese o tipo "$1".',
);

/** Upper Sorbian (hornjoserbsce)
 * @author Michawiki
 */
$messages['hsb'] = array(
	'semanticgenealogy-desc' => 'Zmóžnja wobhladowanje rodopisow a import/eksport GEDCOM-datajow',
	'semanticgenealogy-gedcomexport-desc' => 'GEDCOM-eksport',
	'semanticgenealogy-specialfamilytree-title' => 'Rodopis swójby wutworić',
	'semanticgenealogy-specialfamilytree-button-submit' => 'Wutworić',
	'semanticgenealogy-specialfamilytree-type-ancestors' => 'Prjedownicy',
	'semanticgenealogy-specialfamilytree-type-descendant' => 'Potomnik',
	'semanticgenealogy-specialfamilytree-type-link' => 'Wotkaz',
	'semanticgenealogy-specialfamilytree-label-page' => 'Wuchadna wosoba',
	'semanticgenealogy-specialfamilytree-label-page2' => 'Druha wosoba',
	'semanticgenealogy-specialfamilytree-label-type' => 'Typ',
	'semanticgenealogy-specialfamilytree-label-gen' => 'Ličba generacijow',
	'semanticgenealogy-specialfamilytree-error-nosecondpagename' => 'Dyrbiš mjeno strony k wosobje  w polu "{{int:semanticgenealogy-specialfamilytree-label-page2}}"  podać.',
	'semanticgenealogy-specialfamilytree-error-nolinkfound' => 'Žadyn zwisk mjez [[$1]] a [[$2]] namakany.',
	'semanticgenealogy-specialfamilytree-error-unknowntype' => 'Typ $1 je njeznaty.',
);

/** Indonesian (Bahasa Indonesia)
 * @author පසිඳු කාවින්ද
 */
$messages['id'] = array(
	'semanticgenealogy-specialfamilytree-type-link' => 'Pranala',
	'semanticgenealogy-specialfamilytree-label-type' => 'Tipe',
);

/** Italian (italiano)
 * @author Darth Kule
 */
$messages['it'] = array(
	'semanticgenealogy-desc' => 'Permette di visualizzare alberi genealogici e importare/esportare file GEDCOM',
	'semanticgenealogy-gedcomexport-desc' => 'Esporta GEDCOM',
	'semanticgenealogy-specialfamilytree-title' => 'Crea un albero genealogico',
	'semanticgenealogy-specialfamilytree-button-submit' => 'Crea',
	'semanticgenealogy-specialfamilytree-type-ancestors' => 'Antenati',
	'semanticgenealogy-specialfamilytree-type-descendant' => 'Discendenti',
	'semanticgenealogy-specialfamilytree-type-link' => 'Collegamento',
	'semanticgenealogy-specialfamilytree-label-page' => 'Persona di partenza',
	'semanticgenealogy-specialfamilytree-label-page2' => 'Altra persona:',
	'semanticgenealogy-specialfamilytree-label-type' => 'Tipo',
	'semanticgenealogy-specialfamilytree-label-gen' => 'Numero della generazione',
	'semanticgenealogy-specialfamilytree-error-nosecondpagename' => 'È necessario specificare il nome della pagina di una persona nel campo "{{int:semanticgenealogy-specialfamilytree-label-page2}}".',
	'semanticgenealogy-specialfamilytree-error-nolinkfound' => 'Nessun collegamento trovato fra [[$1]] e [[$2]].',
	'semanticgenealogy-specialfamilytree-error-unknowntype' => 'Il tipo $1 è sconosciuto.',
);

/** Japanese (日本語)
 * @author Fryed-peach
 * @author Shirayuki
 */
$messages['ja'] = array(
	'semanticgenealogy-desc' => '家系図を表示したり GEDCOM ファイルを取り込み/書き出ししたりする機能を提供する',
	'semanticgenealogy-gedcomexport-desc' => 'GEDCOM に書き出し',
	'semanticgenealogy-specialfamilytree-title' => '家系図を作成',
	'semanticgenealogy-specialfamilytree-button-submit' => '作成',
	'semanticgenealogy-specialfamilytree-type-ancestors' => '祖先',
	'semanticgenealogy-specialfamilytree-type-descendant' => '子孫',
	'semanticgenealogy-specialfamilytree-type-link' => 'リンク',
	'semanticgenealogy-specialfamilytree-label-page' => '基準の人',
	'semanticgenealogy-specialfamilytree-label-page2' => 'その他の人',
	'semanticgenealogy-specialfamilytree-label-type' => '種類',
	'semanticgenealogy-specialfamilytree-label-gen' => '世代数',
	'semanticgenealogy-specialfamilytree-error-nosecondpagename' => '「{{int:semanticgenealogy-specialfamilytree-label-page2}}」欄に人物のページの名前を指定する必要があります。',
	'semanticgenealogy-specialfamilytree-error-nolinkfound' => '[[$1]]と[[$2]]の間にリンクが見つかりません。',
	'semanticgenealogy-specialfamilytree-error-unknowntype' => '$1 という種類は不明です。',
);

/** Georgian (ქართული)
 * @author David1010
 */
$messages['ka'] = array(
	'semanticgenealogy-specialfamilytree-title' => 'საგვარეულო ხის შექმნა',
	'semanticgenealogy-specialfamilytree-button-submit' => 'შექმნა',
	'semanticgenealogy-specialfamilytree-type-link' => 'ბმული',
	'semanticgenealogy-specialfamilytree-label-page' => 'საბაზო პირი',
	'semanticgenealogy-specialfamilytree-label-page2' => 'სხვა პირი',
	'semanticgenealogy-specialfamilytree-label-type' => 'ტიპი',
);

/** Luxembourgish (Lëtzebuergesch)
 * @author Robby
 */
$messages['lb'] = array(
	'semanticgenealogy-gedcomexport-desc' => 'GEDCOM-Export',
	'semanticgenealogy-specialfamilytree-title' => 'E Familljestammbam uleeën',
	'semanticgenealogy-specialfamilytree-button-submit' => 'Uleeën',
	'semanticgenealogy-specialfamilytree-type-ancestors' => 'Virfahren',
	'semanticgenealogy-specialfamilytree-type-descendant' => 'Nokommen',
	'semanticgenealogy-specialfamilytree-type-link' => 'Verbindung',
	'semanticgenealogy-specialfamilytree-label-page' => 'Ausgangspersoun',
	'semanticgenealogy-specialfamilytree-label-page2' => 'Aner Persoun',
	'semanticgenealogy-specialfamilytree-label-type' => 'Typ',
	'semanticgenealogy-specialfamilytree-label-gen' => 'Zuel vu Generatiounen',
	'semanticgenealogy-specialfamilytree-error-nolinkfound' => 'Zwësche(n) [[$1]] an [[$2]] gouf keng Verbindung fonnt.',
	'semanticgenealogy-specialfamilytree-error-unknowntype' => 'Den Typ $1 ass onbekannt.',
);

/** Macedonian (македонски)
 * @author Bjankuloski06
 */
$messages['mk'] = array(
	'semanticgenealogy-desc' => 'Овозможува преглед на родословни лози и увоз/извоз како GEDCOM-податотеки',
	'semanticgenealogy-gedcomexport-desc' => 'GEDCOM-извоз',
	'semanticgenealogy-specialfamilytree-title' => 'Создај лоза',
	'semanticgenealogy-specialfamilytree-button-submit' => 'Создај',
	'semanticgenealogy-specialfamilytree-type-ancestors' => 'Предци',
	'semanticgenealogy-specialfamilytree-type-descendant' => 'Потомци',
	'semanticgenealogy-specialfamilytree-type-link' => 'Врска',
	'semanticgenealogy-specialfamilytree-label-page' => 'Појдовно лице',
	'semanticgenealogy-specialfamilytree-label-page2' => 'Друго лице',
	'semanticgenealogy-specialfamilytree-label-type' => 'Тип',
	'semanticgenealogy-specialfamilytree-label-gen' => 'Бр. на поколенија',
	'semanticgenealogy-specialfamilytree-error-nosecondpagename' => 'Ќе мора да зададете име на страницата за лицето во полето „{{int:semanticgenealogy-specialfamilytree-label-page2}}“.',
	'semanticgenealogy-specialfamilytree-error-nolinkfound' => 'Не пронајдов врска помеѓу [[$1]] и [[$2]].',
	'semanticgenealogy-specialfamilytree-error-unknowntype' => 'Типот $1 е непознат.',
);

/** Low German (Plattdüütsch)
 * @author Joachim Mos
 */
$messages['nds'] = array(
	'semanticgenealogy-specialfamilytree-type-link' => 'Lenk',
);

/** Dutch (Nederlands)
 * @author Siebrand
 */
$messages['nl'] = array(
	'semanticgenealogy-desc' => 'Maakt het mogelijk om stambomen te bekijken deze GEDCOM-bestanden te importeren en exporteren',
	'semanticgenealogy-gedcomexport-desc' => 'Exporteren naar GEDCOM',
	'semanticgenealogy-specialfamilytree-title' => 'Stamboom aanmaken',
	'semanticgenealogy-specialfamilytree-button-submit' => 'Aanmaken',
	'semanticgenealogy-specialfamilytree-type-ancestors' => 'Voorouders',
	'semanticgenealogy-specialfamilytree-type-descendant' => 'Nakomeling',
	'semanticgenealogy-specialfamilytree-type-link' => 'Relatie',
	'semanticgenealogy-specialfamilytree-label-page' => 'Basispersoon',
	'semanticgenealogy-specialfamilytree-label-page2' => 'Andere persoon',
	'semanticgenealogy-specialfamilytree-label-type' => 'Type',
	'semanticgenealogy-specialfamilytree-label-gen' => 'Nummer voor generatie',
	'semanticgenealogy-specialfamilytree-error-nosecondpagename' => 'U  moet de naam van een persoonspagina invullen in het veld "{{int:semanticgenealogy-specialfamilytree-label-page2}}".',
	'semanticgenealogy-specialfamilytree-error-nolinkfound' => 'Er is geen relatie gevonden tussen [[$1]] en [[$2]].',
	'semanticgenealogy-specialfamilytree-error-unknowntype' => 'Het type "$1" is onbekend.',
);

/** Piedmontese (Piemontèis)
 * @author Borichèt
 * @author Dragonòt
 */
$messages['pms'] = array(
	'semanticgenealogy-desc' => "A dà la possibilità ëd vëdde dj'erbo genealògich e d'amporté/esporté dj'archivi GEDCOM",
	'semanticgenealogy-gedcomexport-desc' => 'esportassion GEDCOM',
	'semanticgenealogy-specialfamilytree-title' => "Crea n'Erbo Familiar",
	'semanticgenealogy-specialfamilytree-button-submit' => 'Crea',
	'semanticgenealogy-specialfamilytree-type-ancestors' => 'Cé',
	'semanticgenealogy-specialfamilytree-type-descendant' => 'Dissendensa',
	'semanticgenealogy-specialfamilytree-type-link' => 'Liura',
	'semanticgenealogy-specialfamilytree-label-page' => 'Përson-a inissial',
	'semanticgenealogy-specialfamilytree-label-page2' => 'Àutra përson-a',
	'semanticgenealogy-specialfamilytree-label-type' => 'Sòrt',
	'semanticgenealogy-specialfamilytree-label-gen' => 'Nùmer ëd generassion',
	'semanticgenealogy-specialfamilytree-error-nosecondpagename' => 'A dev buté un nòm ëd na pàgina ëd na përson-a ant ël camp «{{int:semanticgenealogy-specialfamilytree-label-page2}}».',
	'semanticgenealogy-specialfamilytree-error-nolinkfound' => 'Pa gnun colegament trovà tra [[$1]] e [[$2]].',
	'semanticgenealogy-specialfamilytree-error-unknowntype' => "La sòrt $1 a l'é pa conossùa.",
);

/** Pashto (پښتو)
 * @author Ahmed-Najib-Biabani-Ibrahimkhel
 */
$messages['ps'] = array(
	'semanticgenealogy-specialfamilytree-button-submit' => 'جوړول',
	'semanticgenealogy-specialfamilytree-type-link' => 'تړنه',
);

/** Brazilian Portuguese (português do Brasil)
 * @author Luckas
 * @author Luckas Blade
 */
$messages['pt-br'] = array(
	'semanticgenealogy-specialfamilytree-button-submit' => 'Criar',
	'semanticgenealogy-specialfamilytree-type-ancestors' => 'Antepassados',
	'semanticgenealogy-specialfamilytree-type-descendant' => 'Descendente',
	'semanticgenealogy-specialfamilytree-type-link' => 'Ligação',
	'semanticgenealogy-specialfamilytree-label-page' => 'Pessoa base',
	'semanticgenealogy-specialfamilytree-label-page2' => 'Outra pessoa',
	'semanticgenealogy-specialfamilytree-label-type' => 'Tipo',
	'semanticgenealogy-specialfamilytree-label-gen' => 'Número de geração',
);

/** Romanian (română)
 * @author Stelistcristi
 */
$messages['ro'] = array(
	'semanticgenealogy-specialfamilytree-type-ancestors' => 'Strămoși',
	'semanticgenealogy-specialfamilytree-type-link' => 'Legătură',
	'semanticgenealogy-specialfamilytree-label-page2' => 'Altă persoană',
	'semanticgenealogy-specialfamilytree-label-type' => 'Tip',
);

/** tarandíne (tarandíne)
 * @author Joetaras
 */
$messages['roa-tara'] = array(
	'semanticgenealogy-desc' => "Dèje l'abbilità pe 'ndrucà le arvule de genealoggije e 'mbortà/esportà le file GEDCOM",
	'semanticgenealogy-gedcomexport-desc' => 'Esporte GEDCOM',
	'semanticgenealogy-specialfamilytree-title' => "Ccreje 'n'arvule de famigghie",
	'semanticgenealogy-specialfamilytree-button-submit' => 'Ccreje',
	'semanticgenealogy-specialfamilytree-type-ancestors' => 'Andenate',
	'semanticgenealogy-specialfamilytree-type-descendant' => 'Discendende',
	'semanticgenealogy-specialfamilytree-type-link' => 'Collegamende',
	'semanticgenealogy-specialfamilytree-label-page' => 'Crestiane de base',
	'semanticgenealogy-specialfamilytree-label-page2' => 'Otre crestiane',
	'semanticgenealogy-specialfamilytree-label-type' => 'Tipe',
	'semanticgenealogy-specialfamilytree-label-gen' => 'Numere de generazione',
	'semanticgenealogy-specialfamilytree-error-nosecondpagename' => "Tu a dà 'nu nome de 'na pàgene de crestiane jndr'à 'u cambe \"{{int:semanticgenealogy-specialfamilytree-label-page2}}\".",
	'semanticgenealogy-specialfamilytree-error-nolinkfound' => "Nisicune collegamende acchiate 'mbrà [[$1]] e [[$2]].",
	'semanticgenealogy-specialfamilytree-error-unknowntype' => "'U tipe $1 jè scanusciute.",
);

/** Sinhala (සිංහල)
 * @author පසිඳු කාවින්ද
 */
$messages['si'] = array(
	'semanticgenealogy-gedcomexport-desc' => 'GEDCOM නිර්යාත කිරීම',
	'semanticgenealogy-specialfamilytree-title' => 'පෙළපත දක්වන සටහනක් තනන්න',
	'semanticgenealogy-specialfamilytree-button-submit' => 'තනන්න',
	'semanticgenealogy-specialfamilytree-type-ancestors' => 'මුතුන් මිත්තෝ',
	'semanticgenealogy-specialfamilytree-type-descendant' => 'අවරෝහණයා',
	'semanticgenealogy-specialfamilytree-type-link' => 'සබැඳිය',
	'semanticgenealogy-specialfamilytree-label-page' => 'පාදක පුද්ගලයෙක්',
	'semanticgenealogy-specialfamilytree-label-page2' => 'වෙනත් පුද්ගලයෙක්',
	'semanticgenealogy-specialfamilytree-label-type' => 'වර්ගය',
	'semanticgenealogy-specialfamilytree-label-gen' => 'පරම්පරා ගණන',
	'semanticgenealogy-specialfamilytree-error-nolinkfound' => '[[$1]] සහ [[$2]] අතර සබැඳියක් හමු නොවුනි.',
	'semanticgenealogy-specialfamilytree-error-unknowntype' => '$1 වර්ගය අඥාතය.',
);

/** Swedish (svenska)
 * @author Martinwiss
 */
$messages['sv'] = array(
	'semanticgenealogy-desc' => 'Gör så att man kan se släktträd och importera/exportera GEDCOM-filer',
	'semanticgenealogy-gedcomexport-desc' => 'GEDCOM-export',
	'semanticgenealogy-specialfamilytree-title' => 'Skapa släktträd',
	'semanticgenealogy-specialfamilytree-button-submit' => 'Skapa',
	'semanticgenealogy-specialfamilytree-type-ancestors' => 'Släktingar',
	'semanticgenealogy-specialfamilytree-type-descendant' => 'Ättlingar',
	'semanticgenealogy-specialfamilytree-type-link' => 'Länk',
	'semanticgenealogy-specialfamilytree-label-page' => 'Upphovs-person',
	'semanticgenealogy-specialfamilytree-label-page2' => 'Annan person',
	'semanticgenealogy-specialfamilytree-label-type' => 'Typ',
	'semanticgenealogy-specialfamilytree-label-gen' => 'Släktledsnummer',
	'semanticgenealogy-specialfamilytree-error-nosecondpagename' => 'Du måste ange ett namn på personsidan i fältet: "{{int:semanticgenealogy-specialfamilytree-label-page2}}".',
	'semanticgenealogy-specialfamilytree-error-nolinkfound' => 'Ingen koppling fanns mellan [[$1]] och [[$2]].',
	'semanticgenealogy-specialfamilytree-error-unknowntype' => 'Känner inte till typen: $1.',
);

/** Tamil (தமிழ்)
 * @author Shanmugamp7
 */
$messages['ta'] = array(
	'semanticgenealogy-specialfamilytree-button-submit' => 'உருவாக்கு',
	'semanticgenealogy-specialfamilytree-type-ancestors' => 'மூதாதையினர்',
	'semanticgenealogy-specialfamilytree-type-descendant' => 'சந்ததி',
	'semanticgenealogy-specialfamilytree-type-link' => 'இணைப்பு',
	'semanticgenealogy-specialfamilytree-label-page' => 'அடிப்படை நபர்',
	'semanticgenealogy-specialfamilytree-label-page2' => 'மற்ற நபர்',
	'semanticgenealogy-specialfamilytree-label-type' => 'வகை',
);

/** Tagalog (Tagalog)
 * @author AnakngAraw
 */
$messages['tl'] = array(
	'semanticgenealogy-desc' => 'Nagbibigay ng kakayahan upang makita ang mga puno ng talaangkanan at mga talaksan ng pag-angkat/pagluluwas ng GEDCOM',
	'semanticgenealogy-gedcomexport-desc' => 'Pagluluwas ng GEDCOM',
	'semanticgenealogy-gedcomexport-link' => 'GEDCOM',
	'semanticgenealogy-specialfamilytree-title' => 'Lumikha ng isang Puno ng Mag-anak',
	'semanticgenealogy-specialfamilytree-button-submit' => 'Likhain',
	'semanticgenealogy-specialfamilytree-type-ancestors' => 'Mga ninuno',
	'semanticgenealogy-specialfamilytree-type-descendant' => 'Inapo',
	'semanticgenealogy-specialfamilytree-type-link' => 'Kawing',
	'semanticgenealogy-specialfamilytree-label-page' => 'Saligang tao',
	'semanticgenealogy-specialfamilytree-label-page2' => 'Iba pang tao',
	'semanticgenealogy-specialfamilytree-label-type' => 'Uri',
	'semanticgenealogy-specialfamilytree-label-gen' => 'Bilang ng salinlahi',
	'semanticgenealogy-specialfamilytree-error-nosecondpagename' => 'Dapat kang magtakda ng isang pangalan ng pahina ng tao ng pahina sa loob ng hanay ng "{{int:semanticgenealogy-specialfamilytree-label-page2}}".',
	'semanticgenealogy-specialfamilytree-error-nolinkfound' => 'Walang kawing na natagpuan sa pagitan ng [[$1]] at [[$2]].',
	'semanticgenealogy-specialfamilytree-error-unknowntype' => 'Hindi nalalaman ang uring $1.',
);

/** Ukrainian (українська)
 * @author Steve.rusyn
 */
$messages['uk'] = array(
	'semanticgenealogy-specialfamilytree-button-submit' => 'Створити',
	'semanticgenealogy-specialfamilytree-type-ancestors' => 'Предки',
	'semanticgenealogy-specialfamilytree-type-link' => 'Посилання',
	'semanticgenealogy-specialfamilytree-label-type' => 'Тип',
);

/** Urdu (اردو)
 * @author පසිඳු කාවින්ද
 */
$messages['ur'] = array(
	'semanticgenealogy-specialfamilytree-button-submit' => 'تخلیق کریں',
	'semanticgenealogy-specialfamilytree-type-link' => 'لنک',
	'semanticgenealogy-specialfamilytree-label-type' => 'قسم',
);

/** Vietnamese (Tiếng Việt)
 * @author පසිඳු කාවින්ද
 */
$messages['vi'] = array(
	'semanticgenealogy-specialfamilytree-button-submit' => 'Tạo',
	'semanticgenealogy-specialfamilytree-label-type' => 'Kiểu',
);

/** Yiddish (ייִדיש)
 * @author පසිඳු කාවින්ද
 */
$messages['yi'] = array(
	'semanticgenealogy-specialfamilytree-button-submit' => 'שאַפֿן',
);

/** Simplified Chinese (中文（简体）‎)
 * @author Li3939108
 * @author Shirayuki
 * @author Yfdyh000
 */
$messages['zh-hans'] = array(
	'semanticgenealogy-desc' => '提供查看家谱树和导入/导出GEDCOM文件的能力',
	'semanticgenealogy-gedcomexport-desc' => 'GEDCOM导出',
	'semanticgenealogy-specialfamilytree-title' => '创建家谱树',
	'semanticgenealogy-specialfamilytree-button-submit' => '创建',
	'semanticgenealogy-specialfamilytree-type-ancestors' => '祖先',
	'semanticgenealogy-specialfamilytree-type-descendant' => '后裔',
	'semanticgenealogy-specialfamilytree-type-link' => '链接',
	'semanticgenealogy-specialfamilytree-label-type' => '类型',
	'semanticgenealogy-specialfamilytree-error-unknowntype' => '未知类型$1',
);

/** Traditional Chinese (中文（繁體）‎)
 * @author Shirayuki
 */
$messages['zh-hant'] = array(
	'semanticgenealogy-specialfamilytree-button-submit' => '建立',
	'semanticgenealogy-specialfamilytree-type-link' => '連結',
	'semanticgenealogy-specialfamilytree-label-type' => '類型',
);
