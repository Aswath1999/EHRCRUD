$(document).ready(function () {
    jQuery(document).ready(function($){
        var path = window.location.href; 
        console.log(path)
        
        $('ul li a').each(function() {
          
            if (this.href === path) {
              console.log(this.href)
              $(this).addClass('active');
              
            }  
        });
    }); 

    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

    $( function() {
        $( "#datepicker" ).datepicker({
          changeMonth: true,
          changeYear: true,
          changeYear:true,
          yearRange: "-100:+0",   
          dateFormat: 'yy-mm-dd'
        });
    } );

    


    
});