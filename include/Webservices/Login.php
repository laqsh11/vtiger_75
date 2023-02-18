<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

function vtws_login($username,$pwd){
    
    $user = new Users();
    $userId = $user->retrieve_user_id($username);
    
    // 		$token = vtws_getActiveToken($userId);
    // 		if($token == null){
    // 			throw new WebServiceException(WebServiceErrorCode::$INVALIDTOKEN,"Specified token is invalid or expired");
    // 		}
        
    // 		$accessKey = vtws_getUserAccessKey($userId);
    // 		if($accessKey == null){
    // 			throw new WebServiceException(WebServiceErrorCode::$ACCESSKEYUNDEFINED,"Access key for the user is undefined");
    // 		}
    // 		$accessCrypt = md5($token.$accessKey);
    
    $userInfo = vtws_getUserInfo($userId);
    
    if(empty($userInfo)){
        throw new WebServiceException(WebServiceErrorCode::$ACCESSKEYUNDEFINED,"Access key for the user is undefined");
    }
    
    $ok = true;
    
    if($userInfo['crypt_type'] == 'PHASH') {
        $ok = password_verify($pwd, $userInfo['user_password']);
    } else {
        $encrypted_password = $user->encrypt_password($pwd, $userInfo['crypt_type']);
        $ok = ($userInfo['user_password'] == $encrypted_password);
    }
    
    
    
    if($ok == false){
        throw new WebServiceException(WebServiceErrorCode::$INVALIDUSERPWD,"Invalid username or password");
    }
    $user = $user->retrieveCurrentUserInfoFromFile($userId);
    if($user->status != 'Inactive'){
        return $user;
    }
    // Finer exception message could be handy to enumeration attacks - so normalize it.
    //throw new WebServiceException(WebServiceErrorCode::$AUTHREQUIRED,'Given user is inactive');
    throw new WebServiceException(WebServiceErrorCode::$INVALIDUSERPWD,"Invalid username or password");
}

/*function vtws_getActiveToken($userId){
 global $adb;
 
 $sql = "select token from vtiger_ws_userauthtoken where userid=? and expiretime >= ?";
 $result = $adb->pquery($sql,array($userId,time()));
 if($result != null && isset($result)){
 if($adb->num_rows($result)>0){
 return $adb->query_result($result,0,"token");
 }
 }
 return null;
 }
 
 function vtws_getUserAccessKey($userId){
 global $adb;
 
 $sql = "select accesskey from vtiger_users where id=?";
 $result = $adb->pquery($sql,array($userId));
 if($result != null && isset($result)){
 if($adb->num_rows($result)>0){
 return $adb->query_result($result,0,"accesskey");
 }
 }
 return null;
 }*/


function vtws_getUserInfo($userId){
    global $adb;
    
    $sql = "select user_password,crypt_type from vtiger_users where id=?";
    $result = $adb->pquery($sql,array($userId));
    if($result != null && isset($result)){
        if($adb->num_rows($result)>0){
            $userInfo = array('user_password' => $adb->query_result($result,0,"user_password"), 'crypt_type' => $adb->query_result($result,0,"crypt_type"));
            return $userInfo;
        }
    }
    return null;
}
?>