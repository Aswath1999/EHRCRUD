<?php 
$ROOT="../";
include "../partials/header.php";
require_once "../partials/navbar.php";

include "./validatepassword.php";


try{  
    if($_SERVER['REQUEST_METHOD']=='POST'){
      $email=$_POST['emailid'];
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailerror = "Please enter valid email address";
        header('Location: EHR/Register/Register.php');
      }
    //   add hash for sending it in email and verifying
      $hash = md5(rand(0,1000));
      $uname=$_POST['username'];
      $DOB=$_POST['date'];
      if(valid_password($_POST['password'])){
        $pass=password_hash($_POST['password'],PASSWORD_DEFAULT);
        // check whether password is good
      }else{
        $passworderror= "Invalid password.The password should have atleast special characters";
      }
    //   Check whetther username is unique in the database 
      $sql="SELECT * FROM register WHERE Username=:uname";
      $statement= $conn->prepare($sql);
      $statement->bindParam(':uname',$uname,PDO::PARAM_STR);
      $statement->execute();
      $row1=$statement->fetch(PDO::FETCH_ASSOC);
      if($row1){
        $Usernameerror= 'Username already exits.Please enter a different username';
      }
      $sql="SELECT * FROM register WHERE Emailid=:email";
      $statement= $conn->prepare($sql);
      $statement->bindParam(':email',$email,PDO::PARAM_STR);
      $statement->execute();
      $row=$statement->fetch(PDO::FETCH_ASSOC);
      if($row){
        $emailerror= 'Email already exits.Please enter a different email id.';
      }
      if(!$row1 && !$row){
        $sql="INSERT INTO register (Username,Emailid,Password,hash,DOB) VALUES(:uname,:email,:pass,:hash,:DOB)";
        $statement= $conn->prepare($sql);
        $statement->bindParam(':pass',$pass,PDO::PARAM_STR);
        $statement->bindParam(':uname',$uname,PDO::PARAM_STR);
        $statement->bindParam(':email',$email,PDO::PARAM_STR);
        $statement->bindParam(':DOB',$DOB,PDO::PARAM_STR);
        $statement->bindParam(':hash',$hash,PDO::PARAM_STR);
        if($statement->execute()){
          $to      = $email;
          $from    ='noreply@drehr.com';
          $subject = 'Account Verification (www.DREHR.com)'; 
          $message = '
          Hello '.$uname.',
          Thank you for signing up!
          Kindly click this link to activate your account:
          http://localhost/EHR/Register/verifyemail.php?email='.$email.'&hash='.$hash;  
          if(sendmail( $to,$from, $subject, $message)){
            header('Location: ../success.php');  
          }else{
            header('Location: ../error.php'); 
          }
        }else{
          $_SESSION['message'] = 'Oops, Something went wrong, Try again later';
          header('Location: ../error.php'); 
        } 
      }
    }
}catch(Exception $e){
    echo "Oops, Something went wrong!!!";
}

?>

<section class="Authorize">
    <div class="container  pt-2">
        <div class="row align-items-center">
            <div class="column col-sm-12 col-lg-6 offset-lg-3 mb-4">
                <div class="card ">  
                    <img class="card-image img-fluid" src="../drehr.png" alt="" >
                    <div class="card-body">
                    <h5 class="card-title">Register</h5>
                        <form  action="./Register.php"method="POST">
                            <div class="mb-3">
                                <label for="username">Username: <br></label>
                                <input type="text" name="username" value="<?php if(isset($uname)) echo $uname; ?>" id="username" autofocus required>
                            </div>
                            <?php if(isset($Usernameerror)): ?>
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <?php echo $Usernameerror;
                                        unset($Usernameerror)
                                    ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>
                            
                            <div class="mb-3">
                                <label for="emailid">Email id:</label>
                                <input type="email" id="emailid" name="emailid" value="<?php if(isset($_POST['emailid'])) echo $_POST['emailid']; ?>"required>
                            </div>
                            <?php if(isset($emailerror)): ?>
                                <div class="alert alert-warning alert-dismissible fade show">
                                    <?php echo $emailerror;
                                    unset($emailerror);
                                    ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <div class="mb-3">
                                <label for="password">Password: </label>
                                <input type="password" name="password" id="password" value="<?php if(isset($_POST["password"])) echo $_POST["password"]; ?>"required>
                            </div>
                            <?php if(isset($passworderror)): ?>
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <?php echo $passworderror;
                                        unset($passworderror);
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