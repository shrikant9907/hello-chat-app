jQuery('document').ready(function(){ 
    chat_load();
    chat_syncro();
});
    
 
//    Asyncronization
function chat_syncro() {
    setInterval(reloadChat, 2000);    
    setInterval(reloadUsers, 2000);    
    setInterval(reloadGroups, 2000);     
}

function reloadChat() {   
    var d = jQuery('.sk_chat_application');  
    d.each(function(){  
        var chatbox         = jQuery(this).children('.chat_box');
        chatbox.scrollTop(chatbox.prop("scrollHeight"));   
        chatbox.load("chat-session.php");    
         
    });  
}   

function reloadUsers() {   
    jQuery('.chat_users_list').load("chat-users-list.php");        
}   
  
function reloadGroups() {      
    jQuery('.chat_groups_list').load("chat-groups-list.php");        
}   
 
function chat_load() {
    
//    chat box
    var cbox = jQuery('.chat_box');
    cbox.scrollTop(cbox.prop("scrollHeight"));    
    
    var el = jQuery(".chat_input_field").emojioneArea({ 
  	pickerPosition: "top",
  	filtersPosition: "bottom",
        tones: true, 
        autocomplete: true,
        inline: false,
        hidePickerOnBlur: false,
        search: true,
        events: {
            keypress: function (editor, event) {
               if(event.which == 13) {
                   
                    var field_data = jQuery.trim(editor.html());
                    if(field_data!='') {
                    var d = editor.closest('.sk_chat_application').children('.chat_box');    
                  
                    jQuery.ajax({    
                        url: "chat-message-ajax.php",     
                        type: "post",
                        data: { field_data: field_data },  
                        success: function (response) { 
                            if(response==='1') {       
                                jQuery('.emojionearea-editor').html('');
                                d.load("chat-session.php");   
                            }
                            jQuery('.emojionearea-editor').html('');
//                            jQuery('.emojionearea-button-close').click();
                        }    
                    }); 
                    d.scrollTop(d.prop("scrollHeight"));      
                    event.preventDefault();  
                    } else {
                       return false;
                    }  
                } 
            }
        }
    });
    
    
//    on submit
    jQuery('.submit_message').on('click',function(){
        
        var editor = jQuery('.emojionearea-editor');
        var field_data = jQuery.trim(editor.html());
        if(field_data!='') {
        var d = editor.closest('.sk_chat_application').children('.chat_box');    

        jQuery.ajax({    
            url: "chat-message-ajax.php",     
            type: "post",
            data: { field_data: field_data },  
            success: function (response) { 
                if(response==='1') {       
                    jQuery('.emojionearea-editor').html('');
                    d.load("chat-session.php");   
                }
                jQuery('.emojionearea-editor').html('');
//                            jQuery('.emojionearea-button-close').click();
            }    
        }); 
        d.scrollTop(d.prop("scrollHeight"));      
        event.preventDefault();  
        } else {
           return false;
        }  
        
    });
}