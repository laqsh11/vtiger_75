<?php

include_once 'vtlib/Vtiger/Module.php';

$Vtiger_Utils_Log = true;

$module_name = "Expenses";

$module_instance = Vtiger_Module::getInstance($module_name);

$block1 = new Vtiger_Block();
$block1->label = 'Male_info';
$block1 = $block1->getInstance($block1->label,$module_instance);

$field_1 = new Vtiger_Field();
$field_1->name = 'name';
$field_1->table = $module_instance->basetable;
$field_1->column = 'name';
$field_1->label = 'Name';
$field_1->columntype = 'VARCHAR(100)';
$field_1->uitype = 1;
$field_1->typeofdata = 'V~O';
$block1->addField($field_1);