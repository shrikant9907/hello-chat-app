<?php include('functions.php'); ?>
<h2>Chat Groups</h2> 
<?php 
if(isset($_SESSION['user_id'])) {
    $user_data = $thread->get(); 
    if($user_data){
        foreach($user_data as $udata) { ?>
            <div class="list_item">
                <?php echo $udata->thread_name; ?>
            </div>
    <?php  }
    }
}      