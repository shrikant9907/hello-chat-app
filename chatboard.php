<?php include('functions.php'); ?>

<?php

//$thread->add_thread('My Chat', '1,9');

if(isset($_GET['logout'])) {
    $user->signout();
} 

if(isset($_GET['clear'])) { 
    $dbfilepath = 'db/chats.json'; 
    file_put_contents($dbfilepath, '[]');
} 
    
if(isset($_SESSION['user_id'])) {

$_SESSION['chat_by'] =    $_SESSION['user_id']; 

?>

<!DOCTYPE html>  
<html>
<head> 

    <!-- Required meta tags -->
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
    <title>Chat App</title> 

    <!--Fonts-->   
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
 
    <!-- CSS Files -->
    <link type="text/css" href="css/fontawesome-all.min.css" rel="stylesheet" />
    <link type="text/css" href="css/emojionearea.min.css" rel="stylesheet" />
    <link type="text/css" href="css/chat.css" rel="stylesheet" />
    <link type="text/css" href="css/responsive.css" rel="stylesheet" />

</head>  
 
<!-- Body Start -->
<body class="">
    <div class="sk_chat_application_wr">
        
        <div class="status">
            <?php $user_data = $user->get_user_by_id($_SESSION['user_id']); 
                if($user_data->online==1) { ?>
                    <span class="bg_green" title="Available"></span>
                <?php } else { ?>
                    <span class="bg_red" title="Not Available"></span>
                <?php    
                }
            ?>
        </div>

        <div class="profilepic"><img src="images/boy_pic.png" alt="" /></div>
            
        <div class="sk_chat_application" >      
                <div class="chat_actions">
                    <a class="clear" href="?clear=1">Clear All</a>
                    <a class="logout" href="?logout=1">Logout</a>
                </div>
                <h2>Live Chat - <span><?php echo $_SESSION['full_name']; ?></span></h2>      
                <div class="chat_box">         
                    <div class="chat_out">
                        <div class="chat_by"><span>13 Feb 2019, 02:40 AM</span></div> 
                        <div class="chat_message">Say hi..</div>
                    </div>
                    <div class="chat_in">
                        <div class="chat_by"><span>13 Feb 2019, 02:40 AM</span></div> 
                        <div class="chat_message">Hello</div>
                    </div>
                </div> 
                <div class="chat_field">
                    <form class="chat_box_form" action="" method="post" autocomplete="off">   
                        <input type="text" value="" class="chat_input_field" placeholder="Type your message here" name="chat_input_field" style="display: none;">
                        <button type="button" name="submit_message" class="submit_message" title="Submit"><i class="fas fa-arrow-right"></i></button>
                    </form>
                </div>
        </div>
    </div> 
    
    <div class="chat_users_list"><h2>Users</h2></div>  
    <div class="chat_groups_list"><h2>Chat Groups</h2></div>
     
    <script type="text/javascript" src="js/jquery.min.js"></script>  
    <script type="text/javascript" src="js/emojionearea.min.js"></script>  
    <script type="text/javascript" src="js/chat.js"></script>  
    
</body>
<!-- Body End -->

</html>  
<?php } else {
    ?>
<form class="chat_box_form" method="get" autocomplete="off">   
    <input type="text" placeholder="Enter your key." name="hi"><br /><br />
    <button type="submit">Login</button>
</form>
    <?php
} 
