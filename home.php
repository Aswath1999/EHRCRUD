<?php 
    $ROOT="./";
    require_once __DIR__."/partials/header.php";
    require_once "./partials/navbar.php";
    $_SESSION['url'] = $_SERVER['REQUEST_URI']; 
?>
 


    <!-- <script src="./Js/index.js"></script> -->
<?php 

    require_once  __DIR__."/partials/footer.php";
?>