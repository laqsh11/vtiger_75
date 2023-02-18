<?php

include_once 'vtlib/Vtiger/Module.php';

$Vtiger_Utils_Log = true;

$module_name = "Expenses";

$module_instance = Vtiger_Module::getInstance($module_name);

$block1 = new Vtiger_Block();
$block1->label = 'LBL_EXPENSES_INFORMATION';
$block1 = $block1->getInstance($block1->label,$module_instance);


$fieldInstance = new Vtiger_Field();
$fieldInstance->name = 'is_active';
$fieldInstance->table = $moduleInstance->basetable;
$fieldInstance->column = 'is_active';
$fieldInstance->label='Is Active';
$fieldInstance->uitype = 56;
$fieldInstance->typeofdata = 'C~O';
$block1->addField($fieldInstance);

$field_1 = new Vtiger_Field();
$field_1->name = 'expense_type';
$field_1->table = $module_instance->basetable;
$field_1->column = 'expense_type';
$field_1->label = 'Expense Type';
$field_1->columntype = 'VARCHAR(100)';
$field_1->uitype = 15;
$field_1->setPicklistValues( Array ('Active','Inactive'));
$field_1->typeofdata = 'V~O';
$block1->addField($field_1);

$field_2 = new Vtiger_Field();
$field_2->name = 'releated_to';
$field_2->table = $module_instance->basetable;
$field_2->column = 'releated_to';
$field_2->label = 'Related To';
$field_2->columntype = 'VARCHAR(100)';
$field_2->uitype = 10;
$field_2->typeofdata = 'I~O';
$block1->addField($field_2);
$field_2->setrelatedmodules(array('Contacts'));

$field_3 = new Vtiger_Field();
$field_3->name = 'mailingcity';
$field_3->table = $module_instance->basetable;
$field_3->column = 'mailingcity';
$field_3->label = 'Mailing City';
$field_3->columntype = 'VARCHAR(100)';
$field_3->uitype = 1;
$field_3->typeofdata = 'V~O';
$block1->addField($field_3);

$field_4 = new Vtiger_Field();
$field_4->name = 'mailingstate';
$field_4->table = $module_instance->basetable;
$field_4->column = 'mailingstate';
$field_4->label = 'Mailing State';
$field_4->columntype = 'VARCHAR(100)';
$field_4->uitype = 1;
$field_4->typeofdata = 'V~O';
$block1->addField($field_4);

$field_5 = new Vtiger_Field();
$field_5->name = 'mailingcountry';
$field_5->table = $module_instance->basetable;
$field_5->column = 'mailingcountry';
$field_5->label = 'Mailing Country';
$field_5->columntype = 'VARCHAR(100)';
$field_5->uitype = 1;
$field_5->typeofdata = 'V~O';
$block1->addField($field_5);

