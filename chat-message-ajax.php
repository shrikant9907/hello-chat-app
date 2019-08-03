<?php
//if (!is_defined('ABSPATH') ) {
//  exit('Direct access not permitted.');
//}

session_start();

if(isset($_SESSION['chat_by'])) {

//$chat_msg    = strip_tags(trim($_POST['field_data'])); 
$chat_msg    = trim($_POST['field_data']); 
if($chat_msg!='') {
$chat_user    = $_SESSION['chat_by'];  
$chat_time   = date("F j, Y, g:i a"); 

$dbfilepath = 'db/chats.json'; 
$dbfilejson = file_get_contents($dbfilepath); 
$dbfileobj = json_decode($dbfilejson);      

//      First Object To Array    
if($dbfileobj) {
    foreach($dbfileobj as $dbfobj_key => $dbobj) {
            $dbfilearry[$dbfobj_key] = $dbobj;
    }
}    

$inildatacount = count($dbfilearry);
ksort($dbfilearry);    // Fix reverse Storage
$lastdata = end($dbfilearry);              
$lastdataid = $lastdata->id;   

$newblog->id          =  $lastdataid+1;         
$newblog->chat_msg    =  $chat_msg; 
$newblog->chat_by     =  $chat_user;  
$newblog->chat_time   =  $chat_time;  

$dbfilearry[] = $newblog;      
$finaldatacount = count($dbfilearry);

$dbfilearry = array_slice($dbfilearry, -6);

if($finaldatacount>$inildatacount) {
    $dbfilearryjson = json_encode($dbfilearry); 
    
    if($chat_msg=='/clear') {
        $dbfilearryjson = '[]'; 
    }
 
    if($chat_msg=='/logout') {
        unset($_SESSION['chat_by']); 
    }
    
    file_put_contents($dbfilepath, $dbfilearryjson);  
}    

echo 1;

} else {
    echo 0;
}
}