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
    var modal = document.getElementById("Modal");
    var img = document.getElementsByClassName('img');
    var modalImg = document.getElementById("img-big");
    var descriptionText = document.getElementById("description");


    var showModal = function(){
        modal.style.display = "block";
        modalImg.src = this.src;
        descriptionText.innerHTML = this.alt;
    }
    for (var i = 0; i < img.length; i++) {
        img[i].addEventListener('click', showModal);
    }
    var span = document.getElementsByClassName("close")[0];
    modal.addEventListener("click",(e)=>{
        if (e.target.classList.contains("modalbox")){
            modal.style.display="none";
        }
    })
    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
    modal.style.display = "none";
    }

   

    


    
});