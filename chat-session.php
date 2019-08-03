
<?php  

include('functions.php');

//if (!is_defined('ABSPATH') ) {
//  exit('Direct access not permitted.');
//}

session_start();
if(isset($_SESSION['chat_by'])) {
    
// Get Chats
$dbfilepath = 'db/chats.json';
$dbfilejson = file_get_contents($dbfilepath);
$dbfilearry = json_decode($dbfilejson);
//print_r($dbfilearry); 
?>

<?php if($dbfilearry) { 
    foreach($dbfilearry as $msg) {
        $userdata = $user->get_user_by_id($msg->chat_by);
        if($msg->chat_by == $_SESSION['chat_by']){ 
            ?>
            <div class="chat_out">
                <div class="chat_by"><span>By <b><?php echo $userdata->firstname; ?></b> at <b><?php echo $msg->chat_time; ?></b></span></div> 
                <div class="chat_message"><?php echo $msg->chat_msg; ?></div>
            </div> 
            <?php
        } else {
            ?>
            <div class="chat_in">
                <div class="chat_by"><span>By <b><?php echo $userdata->firstname; ?></b> at <b><?php echo $msg->chat_time; ?></b></span></div> 
                <div class="chat_message"><?php echo $msg->chat_msg; ?></div>
            </div>
            <?php
        }
    }
}

}
 