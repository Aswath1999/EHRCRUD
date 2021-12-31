<?php 
    $ROOT="./";
    require_once __DIR__."/partials/header.php";
    require_once "./partials/navbar.php";
    $_SESSION['url'] = $_SERVER['REQUEST_URI']; 
?>

<section class="home">
    <div class="container-fluid">
        <div class="row">
            <div class="col col-lg-6 col-sm-12 ps-0">
                <div>
                    <img src="ehr.png" alt="">
                </div>
            </div>
            <div class="col-lg-6 text">
                <strong>Welcome to DR.EHR</strong><br>
                Get your patient's healthrecord with a single click. <br>
                <a class="btn btn-warning py-2 px-3 mt-3" href="./login/Login.php">Login</a> <span>or</span>
                <a class="btn btn-primary py-2 mt-3" href="./Register/Register.php">Signup</a>
            </div>
        </div>
        
    </div>
</section>


    <!-- <script src="./Js/index.js"></script> -->
<?php 

    require_once  __DIR__."/partials/footer.php";
?>