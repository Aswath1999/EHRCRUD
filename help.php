<?php 
    $ROOT="./";
    require_once __DIR__."/partials/header.php";
    require_once "./partials/navbar.php";
?>
<section class="help">
    <div class="container">
        <div class="row">
            <div class="col col-sm-12">
                <h1>FAQs:</h1>
                <button class="accordion">1.&nbsp;Is SNOMED integrated with the Dr.EHR system?</button>
                <div class="panel">
                    <p>SNOMED hasn't been integrated to the system yet but will be implemented in the future. Our team is currently working on it. </p>
                </div>
                <button class="accordion">2.&nbsp;Is Dr.EHR system free to use?</button>
                <div class="panel">
                    <p>Dr.EHR is completely free to use and can be personalized according to the user on request. </p>
                </div>
                <button class="accordion">3.&nbsp;Can physicians and lab personals access Dr.EHR system?</button>
                <div class="panel">
                    <p>Dr.EHR is currently available for only doctors but the team is working on extending the system for all medical professionals to work </p>
                </div>
                <button class="accordion">4.&nbsp;How do I register for Dr.EHR system</button>
                <div class="panel">
                    <p>Go to the Register page and fill out your username and doctor email address given from your hospital. After registration, Have fun with our system.</p>
                </div>
                <button class="accordion">5.&nbsp;How to add new patients?</button>
                <div class="panel">
                    <p>In the Ehr page, there is a create patient button where you can fill out the patient information.</p>
                </div>
                <button class="accordion">6.&nbsp;Can I share patient records?</button>
                <div class="panel">
                    <p>Dr.EHR is in the initial phase of development and sharing hasn't been implemented yet.</p>
                </div>
                <button class="accordion">7.&nbsp;How to contact us?</button>
                <div class="panel">
                    <p>Send us an email at drehradmin@drehr.com</p>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- <script src="./Js/index.js"></script> -->
<?php 

    require_once  __DIR__."/partials/footer.php";
?>