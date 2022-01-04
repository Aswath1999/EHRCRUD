<?php 
$ROOT="../";
include "../partials/header.php";
require_once "../partials/navbar.php";

if($_SERVER['REQUEST_METHOD']=='POST'){
    $email=$_POST["emailid"];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailerror = "Please enter valid email address";
    }else{
        $statement=$conn->prepare("SELECT * FROM register WHERE Emailid=:email");
        $statement->bindParam(':email',$email,PDO::PARAM_STR);
        $statement->execute();
        $logininfo=$statement->fetch(PDO::FETCH_ASSOC);
        if($logininfo){
        $password=password_verify($_POST['password'],$logininfo['Password']);
        if($password){
            $_SESSION['Doctor_id']=$logininfo['ID'];
            $_SESSION['loggedin'] = "TRUE";
            $_SESSION['username'] = $logininfo['Username'];
            $_SESSION['Email']=$logininfo['Emailid'];
            if($logininfo["Active"]){
                if(isset($_SESSION['url'])){
                    $url = $_SESSION['url']; 
                }
                else {
                    $url = "../home.php"; 
                }
                header('Location:'.$url);  
            }else{
                $message= "The account hasn't been activated yet"; 
            }
        }else{
            $message= "Userid or password doesn't match" ;
        }
        }else{
        $message= "The username doesn't exist in the database"; 
        }
    }
  }



?>
<section class="Authorize">
    <div class="container  pt-2 ">
        <div class="row align-items-center">
            <div class="column col-sm-12 col-lg-6 offset-lg-3 mb-4">
                <div class="card ">  
                    <img class="card-image img-fluid" src="../drehr.png" alt="" >
                    <div class="card-body">
                    <h5 class="card-title">Login</h5>
                    <?php if(isset( $message) && !empty( $message)): ?>
                            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                            <?php echo $message;
                                unset($message);
                            ?>
                             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                    <?php endif; ?>    
                    <?php if(isset( $_SESSION['message']) && !empty( $_SESSION['message'])): ?>
                            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                            <?php echo $_SESSION['message'];
                                unset($_SESSION['message']);
                            ?>
                             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                    <?php endif; ?>    
                        <form  action="./login.php"method="POST">  
                            <div class="mb-3">
                                <label for="emailid">Email id:</label>
                                <input type="email" id="emailid" name="emailid" value="<?php if(isset($_POST["emailid"])) echo $_POST["emailid"]; ?>"  required autofocus>
                            </div>
                            <?php if(isset($emailerror)): ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?php echo $emailerror;
                                        unset($emailerror);
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