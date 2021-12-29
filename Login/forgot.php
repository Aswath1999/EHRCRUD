<?php 
$ROOT="../";
include "../partials/header.php";
require_once "../partials/navbar.php";

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ){
    $email=$_POST['emailid'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_Session['email-error'] = "Invalid email format";
    }
    $sql="SELECT * FROM register WHERE Emailid=:email";
    $statement= $conn->prepare($sql);
    $statement->bindParam(':email',$email,PDO::PARAM_STR);
    $statement->execute();
    $user=$statement->fetch(PDO::FETCH_ASSOC);
    if(!$user){
        $_Session['email-error']="Emailid doesn't exist";
        header('Location: ./forgot.php');
    }else{
            $email = $user['Emailid'];
            $hash = $user['Hash'];
            $username=$user['Username'];
            $_SESSION['message'] = "<p>Please check your email <span>$email</span>"
            . " for a confirmation link to complete your password reset!</p>";
            $to      = $email;
            $subject = 'Password Reset Link ( www.DREHR.com )';
            $message_body = '
                Hallo ' .$username. ',
                You have requested password reset!
                Please click this link to reset your password:
                http://localhost/EHR/Login/newpassword.php?email='.$email.'&hash='.$hash;
            
            if(mail($to,$subject,$message_body)){
                $_SESSION['message']="Please check your email and verify.Please check the spam folder";
                header('Location: ../success.php');  
            }else{
                $_SESSION['message']="Something went wrong.Try again later";
                header('Location: ../error.php'); 
            }
           
         
         }
}

?>
<section class="Authorize">
    <div class="container  pt-2">
        <div class="row align-items-center">
            <div class="column col-sm-12 col-lg-6 offset-lg-3">
                <div class="card ">  
                    <img class="card-image img-fluid" src="../drehr.png" alt="" >
                    <div class="card-body">
                    <h5 class="card-title">Forgot Password </h5>
                    <form  action="./forgot.php"method="POST">  
                        <div class="mb-3">
                            <label for="emailid">Email id:</label>
                            <input type="email" id="emailid" name="emailid" required autofocus>
                        </div>
                        <?php if(isset($_SESSION['email-error'])): ?>
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <?php echo $_SESSION['email-error'];
                                        unset($_SESSION['email-error']);
                                    ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                        <?php endif; ?>
                        <button type="submit" class="btn btn-danger">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>




<?php 
require_once "../partials/footer.php";
?>