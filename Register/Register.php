<?php 
$ROOT="../";
include "../partials/header.php";
require_once "../partials/navbar.php";
?>
<section class="Authorize">
    <div class="container  pt-2">
        <div class="row align-items-center">
            <div class="column col-sm-12 col-lg-6 offset-lg-3 mb-4">
                <div class="card ">  
                    <img class="card-image img-fluid" src="../drehr.png" alt="" >
                    <div class="card-body">
                    <h5 class="card-title">Register</h5>
                        <form  action="./Registervalidation.php"method="POST">
                            <div class="mb-3">
                                <label for="username">Username: <br></label>
                                <input type="text" name="username" value="<?php if(isset($_POST["username"])) echo $_POST["username"]; ?>" id="username" autofocus required>
                            </div>
                            <?php if(isset($_SESSION['Username-error'])): ?>
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <?php echo $_SESSION['Username-error'];
                                        unset($_SESSION['Username-error'])
                                    ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>
                            
                            <div class="mb-3">
                                <label for="emailid">Email id:</label>
                                <input type="email" id="emailid" name="emailid" required>
                            </div>
                            <?php if(isset($_SESSION['email-error'])): ?>
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <?php echo $_SESSION['email-error'];
                                        unset($_SESSION['email-error']);
                                    ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <div class="mb-3">
                                <label for="password">Password: </label>
                                <input type="password" name="password" id="password" value="<?php if(isset($_POST["password"])) echo $_POST["password"]; ?>"required>
                            </div>
                            <?php if(isset($_SESSION['password-error'])): ?>
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <?php echo $_SESSION['password-error'];
                                        unset($_SESSION['password-error'])
                                    ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>
                            <div class="mb-3">
                                <label for="date">Date-of-Birth: </label>
                                <input type="date" name="date" id="date" value="<?php if(isset($_POST["date"])) echo $_POST["date"]; ?>"required>
                            </div>
                            <button class="btn btn-primary" type="Submit">Register</button>
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