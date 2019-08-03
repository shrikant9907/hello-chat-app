<?php
/**
 * Settings
 *
 * @author Shrikant Yadav
 */ 
class Settings {       
    
    /*
    * Get App Settings
    */
    public function get() {  
 
        $dbfilepath = SYSTEMPATH.'/db/settings.json';
        $dbfilejson = file_get_contents($dbfilepath);
        $dbfilearry = json_decode($dbfilejson);
        
        return $dbfilearry['0'];        
    }  
          
    /* 
    * Update App Settings
    */ 
    public function update($posts) {  
      
        if($posts) {
            foreach($posts as $p_key => $post) {
                if($p_key=='admin_email') { 
                    $newsetting->$p_key = strtolower(trim($post));
                } else {
                    $newsetting->$p_key = $post;
                }
            }      
            
            $newsetttings[] = $newsetting;
                
            $dbfilepath = SYSTEMPATH.'/db/settings.json'; 
            $newsetttingsjson = json_encode($newsetttings);  
            file_put_contents($dbfilepath, $newsetttingsjson);  

            if(SYSTEMMODE=='TEST') :     
                console_log('Settings updated.');
            endif;
            
            $result = 1;
            
        } else { 
            if(SYSTEMMODE=='TEST') :     
                console_log('Settings updated.');
            endif;  
        }
        
        // It return 1 or 0;     
        if($result) {   
            echo "<div class='alert alert-success'>Settings updated.</div>"; 
        } else { 
            echo "<div class='alert alert-danger'>Settings not updated. Please try again.</div>"; 
        } 

    }
     
} 
$settings = new Settings();   
 