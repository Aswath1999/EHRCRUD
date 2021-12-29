<?php 
$ROOT="../";
require_once "../partials/header.php";
require_once "../partials/navbar.php";
require_once "../Register/validatepassword.php";

if( isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']) )
{
    $email=$_GET['email'];
    $hash=$_GET['hash'];
    $sql="SELECT * FROM register WHERE Emailid=:email AND Hash=:hashdb";
    $statement=$conn->prepare($sql);
    $statement->bindParam(':email',$email,PDO::PARAM_STR);
    $statement->bindParam(':hashdb',$hash,PDO::PARAM_STR);
    $statement->execute();
    $result=$statement->fetch(PDO::FETCH_ASSOC);
    if(!$result){
        $_SESSION['message']="Sorry, verification failed, try again!";
        header('Location: ../error.php');

    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    $password=$_POST['password'];
    $confirmpassword=$_POST['confirmpassword'];
    $email=$_POST['email'];
    $hash=$_POST['hash'];
    if(valid_password($password)){
        $pass=password_hash($password,PASSWORD_DEFAULT);
        if($password==$confirmpassword){
            $new_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE register SET Password='$password', hash='$hash' WHERE Emailid='$email'";
            $statement=$conn->prepare($sql);
            if($statement->execute()){
                $_SESSION['message'] = "Your password has been reset successfully!";
                header('Location: ../home.php');  
            }else{
                $_SESSION['message'] = "Something wen't wrong, Try again later!";
                header('Location: ../Ehr.php'); 
            }
        }else{
            $_SESSION['message'] = "Passwords don't match.";
            header('Location: ./newpassword.php?email='.$email.'&hash='.$hash);
        }
     
    }else{
        $_SESSION['message']= "Password is too weak!!";
        // echo "no";
        header('Location: ./newpassword.php?email='.$email.'&hash='.$hash);
    }
   
}
?>
<section class="Authorize">
    <div class="container  pt-2">
        <div class="row align-items-center">
            <div class="column col-lg-6 offset-lg-3">
                <div class="card ">  
                    <img class="card-image img-fluid" src="../drehr.png" alt="" >
                    <div class="card-body">
                    <h5 class="card-title">Change Password </h5>
                    <?php if(isset($_SESSION['message'])): ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <?php echo $_SESSION['message'];
                                      unset($_SESSION['message']);
                                ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                    <?php endif; ?>
                    <form  action="./checknewpassword.php"method="POST">  
                        <div class="mb-3">
                            <label for="password">New password:</label>
                            <input type="password" id="password" name="password" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="password">Confirm password:</label>
                            <input type="password" id="password" name="confirmpassword"  required autofocus>
                        </div>
                        <input type="hidden" name="email" value="<?= $_GET['email']?>">
        
                        <input type="hidden" name="hash" value="<?= $_GET['hash'] ?>">      
                       
                        <button type="submit" class="btn btn-danger">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>