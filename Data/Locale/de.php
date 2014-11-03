<?php

if ('á' != "\xc3\xa1") {
    // the language files must be saved as UTF-8 (without BOM)
    throw new \Exception('The language file ' . __FILE__ . ' is damaged, it must be saved UTF-8 encoded!');
}

return array(
    'Create new extension' => 'Neue Erweiterung',
    'Extname' => 'Erweiterung Name',
    'Foldername' => 'Verzeichnisname',
    'Longdesc' => 'Beschreibung (mind. 15 Zeichen)',
    "Makes bootstrapping a new extension easy by populating the folder with some basic files" => "Erleichtert das Erstellen neuer Erweiterungen, indem die grundlegende Verzeichnisstruktur und einige Dateien angelegt werden",
    'Shortdesc' => 'Kurzbeschreibung (mind. 15 Zeichen)',
    'Tabs' => 'Toolbar Reiter',
    'The eMail address is not valid' => 'Die Mailadresse ist ungültig',
    'The extension was created.' => 'Die Erweiterung wurde erstellt',
    'The name should have at least 5 letters' => 'Der Name sollte mindestens 5 Buchstaben haben',
    'The description should have at least 15 letters' => 'Die Beschreibung sollte mindestens 15 Zeichen lang sein',
    'The short description should have at least 10 letters' => 'Die Kurzbeschreibung sollte mindestens 10 Zeichen lang sein',
    'This is the name of the new extension. Use CamelCase here. Examples: miniShop, kitCommands' => 'Name der Erweiterung. CamelCase Schreibweise verwenden. Beispiele: miniShop, kitCommands',
    'To create a new extension, please fill the form below. The new extension will be created in the "thirdparty/thirdParty" namespace.' => 'Um eine neue Erweiterung zu erzeugen, füllen Sie bitte folgendes Formular aus. Die neue Erweiterung wird im Namensraum "thirdparty/thirdParty" erstellt.',
    'Vendoremail' => 'Urheber eMail',
    'Vendorname' => 'Urheber Name',
    'Vendorurl' => 'Urheber URL',
);
