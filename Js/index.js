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
    if(modal){
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
    }

    
    // Image display before submisson
    var preview=function(){
        let fileInput = document.getElementById("file-input");
        let imageContainer = document.getElementById("images");
        let numOfFiles = document.getElementById("num-of-files");
        imageContainer.innerHTML = "";
        numOfFiles.textContent = `${fileInput.files.length} Files Selected`;
        for(i of fileInput.files){
            let reader = new FileReader();
            let figure = document.createElement("figure");
            let figCap = document.createElement("figcaption");
            figCap.innerText = i.name;
            figure.appendChild(figCap);
            reader.onload=()=>{
                let img = document.createElement("img");
                img.setAttribute("src",reader.result);
                figure.insertBefore(img,figCap);
            }
            imageContainer.appendChild(figure);
            reader.readAsDataURL(i);
        }
    } 
    $('#file-input').on("change",preview);

    // Accordion w3 schools
    var acc = document.getElementsByClassName("accordion");
    var i;
    console.log('hi');

    for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.maxHeight) {
        panel.style.maxHeight = null;
        } else {
        panel.style.maxHeight = panel.scrollHeight + "px";
        } 
    });
    }
    
});

