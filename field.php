<?php 

include_once 'includes/main/WebUI.php';

include_once('vtlib/Vtiger/Module.php');

include_once 'modules/Vtiger/models/Field.php';

$moduleName='Expenses';

$moduleInstance = Vtiger_Module::getInstance($moduleName);

$maleblock = new Vtiger_Block();
$maleblock->label = 'Male Info';
$moduleInstance->addBlock($maleblock);

$femaleblock = new Vtiger_Block();
$femaleblock->label = 'Female Info';
$moduleInstance->addBlock($femaleblock);


$fieldmodel = Vtiger_Field_Model::getInstance("name",$moduleInstance);

if(!$fieldmodel){
    
    $fieldInstance = new Vtiger_Field();
    
    $fieldInstance->name = 'name';
    
    $fieldInstance->column = 'name';
    
    $fieldInstance->label= 'Name';
    
    $fieldInstance->uitype = 1;
    
    $fieldInstance->typeofdata = 'V~O';
    
    $femaleblock->addField($fieldInstance);

} else {
    echo "Field Already Created";
}

$fieldmodel = Vtiger_Field_Model::getInstance("age",$moduleInstance);

if(!$fieldmodel){
    
    $fieldInstance = new Vtiger_Field();
    
    $fieldInstance->name = 'age';
    
    $fieldInstance->column = 'age';
    
    $fieldInstance->label= 'Age';
    
    $fieldInstance->uitype = 1;
    
    $fieldInstance->typeofdata = 'V~O';
    
    $femaleblock->addField($fieldInstance);
    
} else {
    echo "Field Already Created";
}


$fieldmodel = Vtiger_Field_Model::getInstance("mage",$moduleInstance);

if(!$fieldmodel){
    
    $fieldInstance = new Vtiger_Field();
    
    $fieldInstance->name = 'mage';
    
    $fieldInstance->column = 'mage';
    
    $fieldInstance->label= 'Age';
    
    $fieldInstance->uitype = 1;
    
    $fieldInstance->typeofdata = 'V~O';
    
    $maleblock->addField($fieldInstance);
    
} else {
    echo "Field Already Created";
}


$fieldmodel = Vtiger_Field_Model::getInstance("mname",$moduleInstance);

if(!$fieldmodel){
    
    $fieldInstance = new Vtiger_Field();
    
    $fieldInstance->name = 'mname';
    
    $fieldInstance->column = 'mname';
    
    $fieldInstance->label= 'Name';
    
    $fieldInstance->uitype = 1;
    
    $fieldInstance->typeofdata = 'V~O';
    
    $maleblock->addField($fieldInstance);
    
} else {
    echo "Field Already Created";
}



?>