<?php

require_once ('includes/main/WebUI.php');

require_once('vtlib/Vtiger/Package.php');

require_once('vtlib/Vtiger/Module.php');

$package = new Vtiger_Package();

$package->export(
    
    Vtiger_Module::getInstance('Expenses'),
    
    'test/vtlib',
    
    'Expenses.zip',
    
    true
    
    );
?>