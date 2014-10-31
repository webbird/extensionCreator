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
    'Shortdesc' => 'Kurzbeschreibung (mind. 15 Zeichen)',
    'The eMail address is not valid' => 'Die Mailadresse ist ungültig',
    'The extension was created.' => 'Die Erweiterung wurde erstellt',
    'The name should have at least 5 letters' => 'Der Name sollte mindestens 5 Buchstaben haben',
    'The description should have at least 15 letters' => 'Die Beschreibung sollte mindestens 15 Zeichen lang sein',
    'The short description should have at least 10 letters' => 'Die Kurzbeschreibung sollte mindestens 10 Zeichen lang sein',
    'This is the name of the new extension. Use CamelCase here. Examples: miniShop, kitCommands' => 'Name der Erweiterung. CamelCase Schreibweise verwenden. Beispiele: miniShop, kitCommands',
    'Vendoremail' => 'Urheber eMail',
    'Vendorname' => 'Urheber Name',
    'Vendorurl' => 'Urheber URL',
);
