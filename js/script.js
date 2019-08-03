
jQuery('document').ready(function($) {

    jQuery('.nav_left_trigger').on('click',function(){
        jQuery('body').toggleClass('shownav');  
        jQuery('.nav_left').toggle();
    });
   
    jQuery('.loader_wr').hide();  
     
});


   