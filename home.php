<?php 
    $ROOT="./";
    require_once __DIR__."/partials/header.php";
    require_once "./partials/navbar.php";
    $_SESSION['url'] = $_SERVER['REQUEST_URI']; 
?>

<section class="home">
    <div class="container-fluid ">
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
        <div class="row header">
            <div class="col py-2 mt-3 col-sm-12">
                <h1>Why do we need an EHR?</h1>
            </div>
        </div>
        <div class="row improved-collab">
            <div class="col col-sm-12 order-sm-2 col-md-6 order-md-1 ">
                <p><h3><strong>Improved collaboration</strong></h3><br>
                 EHR allows easy sharing of medical records and documents. Diagnosis is faster and adds to patient satisfaction. Ordering lab tests and obtaining the results are easy and saves a lot of time. EHR adds to the improved efficiency and collaboration of the medical professionals.
                </p>
            </div>
            <div class="col order-sm-1 col-sm-12 col-md-4 order-md-2">
                <img src="./together.jpg" alt="Teamwork">
            </div>
        </div>
        <div class="row paper mb-2">
            <div class="col col-sm-12 order-sm-1 col-md-6 order-md-2 ">
                <p><h3><strong>Portability and less paperwork</strong></h3><br>
                 Avoid the hassle of keeping the important paper work safe. Get all your patient details from any location and whenever you want. Get rid of all the paper documents as Dr.EHR stores the details for you in a safe and secured manner.
                </p>
            </div>
            <div class="col order-sm-2 col-sm-12  col-md-4 order-md-1">
                <img src="./digital.jpg" alt="Teamwork">
            </div>
        </div>
        <div class="mt-5"></div>
        <div class="row improved-collab">
            <div class="col col-sm-12 order-sm-2 col-md-6 order-md-1 ">
                <p><h3><strong>Financial benefits and Security</strong></h3><br>
                Avoid loss of medical incentives and payment cuts by using a certified EHR. A certified EHR meets all requirements including security and interoperability. EHR helps patients in case of emergencies. It allows doctors to access the much needed information to save the patient's life
                </p>
            </div>
            <div class="col order-sm-1 col-sm-12 col-md-4 order-md-2">
                <img src="./security.jpg" alt="Teamwork">
            </div>
        </div>
        
    </div>
</section>


    <!-- <script src="./Js/index.js"></script> -->
<?php 

    require_once  __DIR__."/partials/footer.php";
?>