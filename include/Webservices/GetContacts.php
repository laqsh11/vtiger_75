<?php

function vtws_get_contacts($element) {
    global $log,$adb;
    
    $query = "SELECT * FROM vtiger_contactdetails
                        INNER JOIN vtiger_contactscf ON vtiger_contactscf.contactid = vtiger_contactdetails.contactid
                        INNER JOIN vtiger_contactaddress ON vtiger_contactaddress.contactaddressid = vtiger_contactdetails.contactid
                        INNER JOIN vtiger_contactsubdetails ON vtiger_contactsubdetails.contactsubscriptionid = vtiger_contactdetails.contactid
                        INNER JOIN vtiger_crmentity ON vtiger_crmentity.crmid = vtiger_contactdetails.contactid";
    
    if(!empty($element['time_interval'])){
        $time_interval = $element['time_interval'];
        $query .= " WHERE vtiger_crmentity.createdtime BETWEEN DATE_SUB(now(), INTERVAL $time_interval) AND now() ";
        
    }elseif (!empty($element['contact_id'])){
        $contact_id = $element['contact_id'];
        $query .= " WHERE vtiger_contactdetails.contactid = $contact_id ";
        
    }else {
        return array("success" => 'false', 'message' => 'Sufficient Data Is Not Passed For Results');
    }
    
    $query .= "AND vtiger_crmentity.deleted = 0";
    
    $sql = $adb->pquery($query);
    
    if($adb->num_rows($sql)){
        $data = $adb->query_result_rowdata($sql,0);
        
        $data_array = array(
            'Name' => $data['salutation'] . $data['label'],
            'Mobile' => $data['mobile'],
            'Address' => array(
                $data['mailingstate'], $data['mailingcountry']
            ),
            'E-mail' => $data['email'],
            'Secondary Mail' => $data['secondaryemail'],
            'D.O.B.' => $data['birthday'],
            
            'Created Time' => $data['createdtime'],
        );
        
    }
    return array('data' => $data_array, 'Total Records Fetched' => $adb->num_rows($sql));
}