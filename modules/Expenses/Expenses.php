<?php
include_once 'modules/Vtiger/CRMEntity.php';

class Expenses extends Vtiger_CRMEntity {
    
    var $table_name = 'vtiger_expenses';
    var $table_index= 'expensesid';
    
    var $customFieldTable = Array('vtiger_expensescf', 'expensesid');
    
    var $tab_name = Array('vtiger_crmentity', 'vtiger_expenses', 'vtiger_expensescf');
    
    var $tab_name_index = Array(
        'vtiger_crmentity' => 'crmid',
        'vtiger_expenses' => 'expensesid',
        'vtiger_expensescf'=>'expensesid');
    
    var $list_fields = Array (
        'Summary' => Array('expenses', 'summary'),
        'Assigned To' => Array('crmentity','smownerid')
    );
    var $list_fields_name = Array (
        'Summary' => 'summary',
        'Assigned To' => 'assigned_user_id',
    );
    
    var $list_link_field = 'summary';
    
    var $search_fields = Array(
        'Summary' => Array('expenses', 'summary'),
        'Assigned To' => Array('vtiger_crmentity','assigned_user_id'),
    );
    var $search_fields_name = Array (
        'Summary' => 'summary',
        'Assigned To' => 'assigned_user_id',
    );
    
    var $popup_fields = Array ('summary');
    
    var $def_basicsearch_col = 'summary';
    
    var $def_detailview_recname = 'summary';
    
    var $mandatory_fields = Array('summary','assigned_user_id');
    
    var $default_order_by = 'summary';
    var $default_sort_order='ASC';
}