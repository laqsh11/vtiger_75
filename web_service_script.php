<?php
    include_once 'includes/main/WebUI';
    
    $url = "http://localhost/vtigercrm/webservice.php?operation=getchallenge&username=admin";
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);
    curl_close($ch);
    if (preg_match('/"token":"(\w+)"/', $data, $matches)) {
        $token = $matches[1];
    }
    //print_r($token);
    
    $acess_key = "@Laksh1234";
    
    $element_data = array(
        'operation' => 'login',
        'username' => 'admin',
        'password' => $acess_key,
    );
    
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, "http://localhost/vtigercrm/webservice.php");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $element_data);
    $response = curl_exec($ch);
    $response = json_decode($response);
    
    $session_id = $response->result->sessionName;
    
    $ch_get = curl_init();
    
    $get_contact_data = array(
        'operation' => 'get_contacts',
        'sessionName'=> $session_id,
        'element' => json_encode(array('time_interval' => '3 MONTH')),
    );
    
    curl_setopt($ch_get, CURLOPT_URL, "http://localhost/vtigercrm/webservice.php");
    curl_setopt($ch_get, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch_get, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch_get, CURLOPT_POST, true);
    curl_setopt($ch_get, CURLOPT_POSTFIELDS, $get_contact_data);
    $response = curl_exec($ch_get);
    print_r($response);
    