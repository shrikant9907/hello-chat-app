<?php
/**
 * Users
 *
 * @user Shrikant Yadav
 */
class Threads {    
 
    /* 
     * Function Add User 
     */
    public function add_thread($thread_name, $thread_group) { 
        
        $dbfilepath = SYSTEMPATH.'/db/groups.json'; 
        $dbfilejson = file_get_contents($dbfilepath);
        $dbfileobj = json_decode($dbfilejson);       
       
        // First Object To Array
        if($dbfileobj) {
            foreach($dbfileobj as $dbfobj_key => $dbobj) {
                $dbfilearry[$dbfobj_key] = $dbobj;  
            }
        }    
        
        $inildatacount = count($dbfilearry);
        ksort($dbfilearry);   // Fix Reverse Storage.
        $lastdata = end($dbfilearry);    
        $lastdataid = $lastdata->id;   

        //Today Date and Time
        $today = date("F j, Y, g:i a");
        
        $newthread->thread_id     =  $lastdataid+1;         
        $newthread->thread_name   =  $thread_name;
        $newthread->thread_group  =  $thread_group; 
        $newthread->registered    =  $today; 

        $dbfilearry[] = $newthread;
        
        $finaldatacount = count($dbfilearry);
        
        if($finaldatacount>$inildatacount) {
            
            $dbfilearryjson = json_encode($dbfilearry); 
             
            file_put_contents($dbfilepath, $dbfilearryjson);  
            
            return 1;
            
        }
    } 

    /*
    * Function For Retrive All Threads
    */
    public function get() {

        $rows = array();    
 
        $dbfilepath = SYSTEMPATH.'/db/groups.json';
        $dbfilejson = file_get_contents($dbfilepath);
        $dbfilearry = json_decode($dbfilejson);

        // Reverse Sort
        if($dbfilearry) {
            krsort($dbfilearry);
        }
        
        return $dbfilearry;       
    } 

    /*
    * Get Thread By ID
    */
    public function get_thread_by_id($thread_id){ 

        $thread = array(); 
             
        $threads = $this->get();
        if($threads) {
            foreach($threads as $threaddata) {    
                if($thread_id == $threaddata->id) {
                    $thread = $threaddata;
                    break;
                }  
                
            }
        }    
        
        return $thread; 

    }
   
    /*
     * Delete User 
     */
    public function delete($thread_id) {
        
        $newthreads = array(); 
        $threads = $this->get();
        
        if($threads) {
            
            // Delete User
            foreach($threads as $threadkey => $threaddata) {    
                if($thread_id != $threaddata->id) {
                    $newthreads[$threadkey] = $threaddata;  
                }  
            } 
        
            $dbfilepath = SYSTEMPATH.'/db/groups.json'; 
            $dbfilearryjson = json_encode($newthreads); 
            file_put_contents($dbfilepath, $dbfilearryjson);  
        
            return 1;   
            
        } else {
            return 0;   
        }    
    }       
    
     
    /*
     * Delete All User 
     */
    public function delete_all() { 
        
        $newthreads = '[{}]';     
        $dbfilepath = SYSTEMPATH.'/db/groups.json'; 
        file_put_contents($dbfilepath, $newthreads);   
        
        return 1; 

    }
 
    /*
     * Update User/Thread  
     */
    public function update($post) { 
        
        $thread_id    = $post['user_id'];   
        $firstname  = ucwords(trim($post['firstname']));  
        $lastname   = ucwords(trim($post['lastname'])); 
        $thread_email = strtolower(trim($post['email']));   
        $thread_role = trim($post['role']);  
        $image_url = ''; 
        
        //Upload Profile Image    
        $file      = $_FILES['profile_pic'];
        $filedata  = upload_file($file);  
        if($filedata) {     
            $file_loc = $filedata['file_upload_loc'];
            if($file_loc!='') {
                $image_url = $file_loc;
            }
        }   
         
        $threads = $this->get();
        if($threads) {
            foreach($threads as $threaddata) {    
                if($thread_id == $threaddata->id) {
                    
                    if(SYSTEMMODE=='TEST') :    
                        console_log('Uploaded profile image url: '.$image_url);
                    endif; 
                    
                    $threaddata->firstname     =  $firstname;
                    $threaddata->lastname      =  $lastname;
                    $threaddata->email         =  $thread_email; 
                    $threaddata->role         =  $thread_role;
                    if($image_url!='') {
                        $threaddata->user_img    =  $image_url;
                    }
                }  
            }
    
            $dbfilepath = SYSTEMPATH.'/db/groups.json'; 
            $threadsjson = json_encode($threads);  
            file_put_contents($dbfilepath, $threadsjson);  

            if(SYSTEMMODE=='TEST') :     
                console_log('User/Thread updated.');
            endif;
            
            $result = 1;
            
        } else { 
            if(SYSTEMMODE=='TEST') :     
                console_log('New user/user not updated.');
            endif;  
        }
        
        // It return 1 or 0;     
        if($result) {   
            echo "<div class='alert alert-success'>Profile has been updated.</div>"; 
        } else { 
            echo "<div class='alert alert-danger'>Profile not updated. Please try again.</div>"; 
        } 

    }

    /*
    * Change Status
    */
    public function change_status($thread_id, $new_status) { 

        if(($thread_id!='') && ($new_status!='')) {
        
                $threads = $this->get();
                if($threads) {
                    foreach($threads as $threaddata) {    
                        if($thread_id == $threaddata->id) {    
                            $threaddata->online     =  $new_status;
                        }  
                    }

                    $dbfilepath = SYSTEMPATH.'/db/groups.json'; 
                    $threadsjson = json_encode($threads);  
                    file_put_contents($dbfilepath, $threadsjson);  

                    if(SYSTEMMODE=='TEST') :     
                        console_log('Status updated.');
                    endif;

                    $result = 1;

                } else { 
                    if(SYSTEMMODE=='TEST') :     
                        console_log('Status not updated.');
                    endif;  
                }
        } 

    }
 
}  
 
$thread = new Threads();  
