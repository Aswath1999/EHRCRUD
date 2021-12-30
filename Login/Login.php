<?php 
$ROOT="../";
include "../partials/header.php";
require_once "../partials/navbar.php";

?>
<section class="Authorize">
    <div class="container  pt-2 ">
        <div class="row align-items-center">
            <div class="column col-sm-12 col-lg-6 offset-lg-3 mb-4">
                <div class="card ">  
                    <img class="card-image img-fluid" src="../drehr.png" alt="" >
                    <div class="card-body">
                    <h5 class="card-title">Login</h5>
                    <?php if(isset( $_SESSION["message"]) && !empty( $_SESSION["message"])): ?>
                            <div class="alert alert-warning alert-dismissible fade show " role="alert">
                            <?php echo $_SESSION['message'];
                                unset($_SESSION["message"]);
                            ?>
                             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                    <?php endif; ?>    
                        <form  action="./logincheck.php"method="POST">  
                            <div class="mb-3">
                                <label for="emailid">Email id:</label>
                                <input type="email" id="emailid" name="emailid" value="<?php if(isset($_POST["emailid"])) echo $_POST["emailid"]; ?>"  required autofocus>
                            </div>
                            <?php if(isset($_SESSION['email-error'])): ?>
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <?php echo $_SESSION['email-error'];
                                        unset($_SESSION['email-error']);
                                    ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif;?>

                            <div class="mb-3">
                                <label for="password">Password: </label>
                                <input type="password" name="password" id="password" 
                                value="<?php if(isset($_POST["password"])) echo $_POST["password"];?>"required>
                            </div>
                            <div class="mb-3">
                            <a href="forgot.php">Forgot your password?</a>
                            </div>
                            <button class="btn btn-primary" type="Submit">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php 

require_once "../partials/footer.php";
?>