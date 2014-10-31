<?php

if ('á' != "\xc3\xa1") {
    // the language files must be saved as UTF-8 (without BOM)
    throw new \Exception('The language file ' . __FILE__ . ' is damaged, it must be saved UTF-8 encoded!');
}

return array(
    'Extname' => 'Extension fullname',
    'Foldername' => 'Folder name',
    'Longdesc' => 'Long description (at least 15 chars)',
    'Shortdesc' => 'Short description (at least 15 chars)',
    'Vendoremail' => 'Vendor eMail',
    'Vendorname' => 'Vendor Name',
    'Vendorurl' => 'Vendor URL',
);
