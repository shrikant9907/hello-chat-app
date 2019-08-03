<?php include('functions.php'); ?>
<h2>Users</h2> 
<?php 
if(isset($_SESSION['user_id'])) {
    $user_data = $user->get_users(); 
    if($user_data){
        foreach($user_data as $udata) { ?>
            <div class="list_item">
                <?php echo $udata->firstname; ?> <?php echo $udata->lastname; ?>
                <div class="status">
                    <?php if($udata->online==1) { ?>
                        <span class="bg_green" title="Available"></span>
                    <?php } else { ?>
                        <span class="bg_red" title="Not Available"></span>
                    <?php } ?>
                </div>
                
                <a href="#" class="chat_with_me" title="Chat with me"><i class="fas fa-comments"></i></a>
            </div>
    <?php  }
    }
}   