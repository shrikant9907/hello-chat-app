<?php
/**
 * Users
 *
 * @user Shrikant Yadav
 */
class Users {    
 
    /*
     * Function User Signin 
     */
    public function signin() { 
        
        $post = $_POST;
  
        $email = strtolower(trim($post['user_email'])); 
        $userpassword = trim($post['user_password']);
      
        // Check if all required value given
        if(($email!='') && ($userpassword!='') ) :    

    //     Encryption/Encode - MD5 - Hash key  
           $md5pass =  md5($userpassword);     
        
            // User Check       
            if(filter_var($email, FILTER_VALIDATE_EMAIL)) : 
 
                // Other User Login 
                $userdata = $this->get_user_by_email($email, $md5pass);  
//                print_r($userdata);
                if(count($userdata)>0) : 
                    
                    if($md5pass==$userdata->password) :

                        $_SESSION['user_id']    =  $userdata->id;        
                        $_SESSION['user_role']  =  $userdata->role;   
                        $_SESSION['firstname']  =  $userdata->firstname;   
                        $_SESSION['lastname']   =  $userdata->lastname;    
                        $_SESSION['full_name']  =  $userdata->firstname.' '.$userdata->lastname;  
                        
                        $this->change_status($userdata->id, '1');
                         
                        if(SYSTEMMODE=='TEST') :    
                            console_log('User Login..');
                        endif;
                        
                        return 1;  
                    else : 
                        if(SYSTEMMODE=='TEST') :    
                        console_log('User In Correct Password.');
                        endif;
                        
                        return 0; 
                    endif; 
                     
                else : 
                    
                    if(SYSTEMMODE=='TEST') :    
                        console_log('Invalid User Login..');
                    endif;
                    
                    return 0;
                
                endif;
        
                return 0;  
                
            endif;  
                
        endif; 

    } 

    /*
     * Function User Signup 
     */
    public function signup() { 
        $post = $_POST;
        $firstname        = trim($post['first_name']); 
        $lastname         = trim($post['last_name']); 
        $role             = trim($post['role']); 
        $user_email       = strtolower(trim($post['user_email'])); 
        $user_password    = trim($post['user_password']); 

        // Check if all required value given
        if(($firstname!='') && ($lastname!='') && ($user_email!='') && ($user_password!='') ) :  
        
            // User Check    
            if(filter_var($user_email, FILTER_VALIDATE_EMAIL)) :
                
                if(SYSTEMMODE=='TEST') :  
                    console_log('User Signup.');
                endif; 
                
                $userdata = $this->get_user_by_email($user_email);
    
                if(count($userdata)>0) :
                    
                    if(SYSTEMMODE=='TEST') :  
                        console_log('User already exists.');
                    endif;  
                    
                    return 0;
                else:
                    
                    if(SYSTEMMODE=='TEST') :   
                        console_log('Insert new user.');
                    endif;
                    
                    $status = $this->insert($firstname, $lastname, $role, $user_email, $user_password);
                    
                    return $status;  
                    
                endif; 
                          
            else :  
                
                if(SYSTEMMODE=='TEST') :  
                    console_log('Invalid email address.');
                endif; 
                
                return 0; 
                
            endif;  
                                
                
        endif; 

    } 

    /*
     * Function Add User 
     */
    public function add_user($post) { 

        $firstname        = trim($post['firstname']); 
        $lastname         = trim($post['lastname']); 
        $user_email       = strtolower(trim($post['email']));  
        $role             = trim($post['role']); 
        $user_password    = trim($post['user_password']);   

        $user_name          = preg_replace('/\s+/', '_', $user_name);   

        // Check if all required value given
        if(($user_name!='') && ($user_email!='') && ($user_password!='') ) :  
        
            // User Check    
            if(filter_var($user_email, FILTER_VALIDATE_EMAIL)) :
                
                if(SYSTEMMODE=='TEST') :  
                    console_log('Add User.');
                endif; 
                
                $userdata = $this->get_user_by_email($user_email);
                if(count($userdata)>0) :
                    
                    if(SYSTEMMODE=='TEST') :   
                        console_log('User already exists with given email.');
                    endif;  
                    
                    return 2;
                else:
                    
                    if(SYSTEMMODE=='TEST') :   
                        console_log('Insert new user.');
                    endif;
                    
                    $status = $this->insert($firstname, $lastname, $role, $user_email, $user_password);
                    
                    return $status;  
                    
                endif; 
                          
            else :  
                
                if(SYSTEMMODE=='TEST') :  
                    console_log('Invalid email address.');
                endif; 
                
                return 0; 
                
            endif;  
                                
                
        endif; 

    } 
     
    
    /*
    * User Roles
    */
    public function get_roles() {

        $roles['administrator'] = 'Administrator';
        $roles['user'] = 'User';
     
        return $roles; 
    } 
    
    /*
    * Change Password
    */
    public function change_password($user_id, $old_password, $new_password, $confirm_password) {

       global $connection; 

       $sql = "SELECT password FROM users WHERE id='$user_id'";
       $result = mysqli_query($connection, $sql);
       if($result) {
           $num_rows = mysqli_num_rows($result);
           if($num_rows>0) {
              $row = mysqli_fetch_assoc($result);
              $db_password = $row['password'];
           }
       }

       // Check Password
       if($db_password===$old_password) {
           // Update Password
           $sql = "UPDATE users
                   SET password='$confirm_password'
                   WHERE id='$user_id'"; 
           $result = mysqli_query($connection, $sql);
           // It return 1 or 0;  
           if($result) { 
               echo "Password updated successfully."; 
           } else {
               echo "Password not updated. Please try again."; 
           } 

       } else { 
           echo "Old Password incorrect.";  
       }

    } 
    
    /*
    * Admin Change Password
    */
    public function admin_change_password($user_id, $new_password, $confirm_password) { 

        if(($new_password!='') && ($confirm_password!='')) {
        
            if($new_password==$confirm_password) {

                $user_password  = trim($new_password);      

                // Encryption/Encode - MD5 - Hash key  
                $md5pass =  md5($user_password); 

                $users = $this->get_users();
                if($users) {
                    foreach($users as $userdata) {    
                        if($user_id == $userdata->id) {    
                            $userdata->password     =  $md5pass;
                        }  
                    }

                    $dbfilepath = SYSTEMPATH.'/db/users.json'; 
                    $usersjson = json_encode($users);  
                    file_put_contents($dbfilepath, $usersjson);  

                    if(SYSTEMMODE=='TEST') :     
                        console_log('Password updated.');
                    endif;

                    $result = 1;

                } else { 
                    if(SYSTEMMODE=='TEST') :     
                        console_log('Password not updated.');
                    endif;  
                }

                // It return 1 or 0;     
                if($result) {   
                    echo "<div class='alert alert-success'>Password updated successfully.</div>"; 
                } else {
                    echo "<div class='alert alert-danger'>Password not updated. Please try again.</div>"; 
                } 
            } else {
                echo "<div class='alert alert-danger'>New password not matched with confirm password.</div>"; 
            }
        } else {  
            echo "<div class='alert alert-danger'>Password field empty.</div>"; 
        }

    }

    /*
    * Function For Retrive All Authors
    */
    public function get_users() {

        $rows = array();    
 
        $dbfilepath = SYSTEMPATH.'/db/users.json';
        $dbfilejson = file_get_contents($dbfilepath);
        $dbfilearry = json_decode($dbfilejson);

        // Reverse Sort
        if($dbfilearry) {
            krsort($dbfilearry);
        }
        
        return $dbfilearry;       
    } 

    /*
    * Get Author By ID
    */
    public function get_user_by_id($user_id){ 

        $user = array(); 
             
        $users = $this->get_users();
        if($users) {
            foreach($users as $userdata) {    
                if($user_id == $userdata->id) {
                    $user = $userdata;
                    break;
                }  
                
            }
        }    
        
        return $user; 

    }

    /*
    * Get Author By Email  
    */
    public function get_user_by_email($user_email){   

        $user = array(); 
        
        $users = $this->get_users();
        if($users) {
            foreach($users as $userdata) {    
                if($user_email == $userdata->email) {
                    $user = $userdata; 
                    break;
                }  
            }
        }    
         
        return $user;  

    }
 
    /*   
     * Function Register Insert New User
     */ 
    public function insert($firstname, $lastname, $role, $user_email, $user_password, $image_url='', $status='') {
        
        // Encryption/Encode - MD5 - Hash key   
        $md5pass =  md5($user_password); 
        
        $dbfilepath = SYSTEMPATH.'/db/users.json'; 
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

        //Upload Profile Image    
        $file      = $_FILES['profile_pic'];
        $filedata  = upload_file($file); 
      
        if($filedata) {    
            $file_loc = $filedata['file_upload_loc'];
            if($file_loc!='') {
                $image_url = $file_loc;
            }
        }   
         
        if(SYSTEMMODE=='TEST') :    
            console_log('Uploaded file url: '.$image_url);
        endif;      
        
        //Today Date and Time
        $today = date("F j, Y, g:i a");
        
        $newuser->id            =  $lastdataid+1;         
        $newuser->firstname     =  $firstname;
        $newuser->lastname      =  $lastname; 
        $newuser->email         =  $user_email;
        $newuser->password      =  $md5pass;
        $newuser->user_img      =  $image_url;
        $newuser->status        =  $status;
        $newuser->role          =  $role;
        $newuser->online        =  '0';  
        $newuser->registered    =  $today; 

        $dbfilearry[] = $newuser;
        
        $finaldatacount = count($dbfilearry);
        
        if($finaldatacount>$inildatacount) {
            
            $dbfilearryjson = json_encode($dbfilearry); 
             
            file_put_contents($dbfilepath, $dbfilearryjson);  
            
            if(SYSTEMMODE=='TEST') :    
                console_log('New user inserted.');
            endif;
            
            return 1;
            
        } else { 
            
            if(SYSTEMMODE=='TEST') :     
                console_log('New user not inserted.');
            endif;  
        }   
    }     
   
    /*
     * Delete User 
     */
    public function delete($user_id) {
        
        $newusers = array(); 
        $users = $this->get_users();
        
        if($users) {
            
            // Delete User
            foreach($users as $userkey => $userdata) {    
                if($user_id != $userdata->id) {
                    $newusers[$userkey] = $userdata;  
                }  
            } 
        
            $dbfilepath = SYSTEMPATH.'/db/users.json'; 
            $dbfilearryjson = json_encode($newusers); 
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
        
        $newusers = '[{}]';     
        $dbfilepath = SYSTEMPATH.'/db/users.json'; 
        file_put_contents($dbfilepath, $newusers);   
        
        return 1; 

    }
    
    /*
     * Delete Blog From List
     */ 
    public function delete_from_list($user_array) {
        
        $newuser = array(); 
        $users = $this->get_users();

        if($users) {
                   
            // Delete Blog From List 
            foreach($users as $user_key => $user_data) {      
                if(!in_array($user_data->id, $user_array)) {
                    $newuser[$user_key] = $user_data;  
                }  
            }         
        
            $dbfilepath = SYSTEMPATH.'/db/users.json'; 
            $dbfilearryjson = json_encode($newuser);      
            file_put_contents($dbfilepath, $dbfilearryjson);  
        
            return 1;   
            
        } else {
            return 0;   
        }    
    } 

    /*
     * Update User/Author  
     */
    public function update($post) { 
        
        $user_id    = $post['user_id'];   
        $firstname  = ucwords(trim($post['firstname']));  
        $lastname   = ucwords(trim($post['lastname'])); 
        $user_email = strtolower(trim($post['email']));   
        $user_role = trim($post['role']);  
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
         
        $users = $this->get_users();
        if($users) {
            foreach($users as $userdata) {    
                if($user_id == $userdata->id) {
                    
                    if(SYSTEMMODE=='TEST') :    
                        console_log('Uploaded profile image url: '.$image_url);
                    endif; 
                    
                    $userdata->firstname     =  $firstname;
                    $userdata->lastname      =  $lastname;
                    $userdata->email         =  $user_email; 
                    $userdata->role         =  $user_role;
                    if($image_url!='') {
                        $userdata->user_img    =  $image_url;
                    }
                }  
            }
    
            $dbfilepath = SYSTEMPATH.'/db/users.json'; 
            $usersjson = json_encode($users);  
            file_put_contents($dbfilepath, $usersjson);  

            if(SYSTEMMODE=='TEST') :     
                console_log('User/Author updated.');
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
    * Check User and Access
    */ 
    public function check_access() {   
        $access = 0;
       
        $login = $this->check_login(); 
        if($login) {   
            if(array_key_exists($_SESSION['user_role'], $this->get_roles())) {    
               $access = 1;   
            }
        }  
        return $access;  
    } 


    /*
     * Check User Login
     */ 
    public function check_login() {   
        $access = 0;
        
        if(isset($_SESSION['user_id']) && isset($_SESSION['user_role'])) { 
            $access = 1;
        }
        return $access;  
    }
 
    
    /*
     * Sign Out 
     */
    public function signout() {

        // Delete Session Variables 
        $this->change_status($_SESSION['user_id'], '0');
        unset($_SESSION['user_id']);
        unset($_SESSION['user_role']); 
        unset($_SESSION['chat_by']); 
  
        // Session Destroy
        session_destroy();    

        // Redirect to Login Page
        $loginurl = site_url();    
        redirect_script($loginurl);  
                    
    } 
    
    /*
    * Admin Change Password
    */
    public function change_status($user_id, $new_status) { 

        if(($user_id!='') && ($new_status!='')) {
        
                $users = $this->get_users();
                if($users) {
                    foreach($users as $userdata) {    
                        if($user_id == $userdata->id) {    
                            $userdata->online     =  $new_status;
                        }  
                    }

                    $dbfilepath = SYSTEMPATH.'/db/users.json'; 
                    $usersjson = json_encode($users);  
                    file_put_contents($dbfilepath, $usersjson);  

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
$user = new Users();  
