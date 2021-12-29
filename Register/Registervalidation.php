<?php 
include "../partials/header.php";
// Function to check password.Should contain atleast one uppercase,one lowercase, one digit and one special character.
// Should atleast be of length 8
include "./validatepassword.php";


try{  
    if($_SERVER['REQUEST_METHOD']=='POST'){
      $email=$_POST['emailid'];
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['email-error'] = "Please enter valid email address";
        header('Location: EHR/Register/register.php');
      }
    //   add hash for sending it in email and verifying
      $hash = md5(rand(0,1000));
      $uname=$_POST['username'];
      $DOB=$_POST['date'];
      if(valid_password($_POST['password'])){
        $pass=password_hash($_POST['password'],PASSWORD_DEFAULT);
        // check whether password is good
      }else{
        $_SESSION['password-error']= "Invalid password.The password should have atleast special characters";
        header('Location: ./register.php');
      }
    //   Check whetther username is unique in the database 
      $sql="SELECT * FROM register WHERE Username=:uname";
      $statement= $conn->prepare($sql);
      $statement->bindParam(':uname',$uname,PDO::PARAM_STR);
      $statement->execute();
      $row=$statement->fetch(PDO::FETCH_ASSOC);
      if($row){
        $_SESSION['Username-error']= 'Username already exits.Please enter a different username';
        header('Location: ./Register.php'); 
      }
      $sql="SELECT * FROM register WHERE Emailid=:email";
      $statement= $conn->prepare($sql);
      $statement->bindParam(':email',$email,PDO::PARAM_STR);
      $statement->execute();
      $row=$statement->fetch(PDO::FETCH_ASSOC);
      if($row){
        $_SESSION['email-error']= 'Email already exits.Please enter a different email id.';
        header('Location: ./Register.php'); 
      }else{
        $sql="INSERT INTO register (Username,Emailid,Password,hash,DOB) VALUES(:uname,:email,:pass,:hash,:DOB)";
        $statement= $conn->prepare($sql);
        $statement->bindParam(':pass',$pass,PDO::PARAM_STR);
        $statement->bindParam(':uname',$uname,PDO::PARAM_STR);
        $statement->bindParam(':email',$email,PDO::PARAM_STR);
        $statement->bindParam(':DOB',$DOB,PDO::PARAM_STR);
        $statement->bindParam(':hash',$hash,PDO::PARAM_STR);
        if($statement->execute()){
          $to      = $email;
          $header=array('From'=>'noreply@ehr.com','Reply-To'=>'noreply@ehr.com','X-Mailer'=>'PHP/'.phpversion());
          $subject = 'Account Verification (www.DREHR.com)'; 
          $message_body = '
          Hello '.$uname.',
          Thank you for signing up!
          Kindly click this link to activate your account:
          http://localhost/EHR/Register/verifyemail.php?email='.$email.'&hash='.$hash;  
          if(mail( $to, $subject, $message_body,$header)){
            $_SESSION['message']="Please check your email and verify.Please check the spam folder";
            header('Location: ../success.php');  
          }else{
            $_SESSION['message']="Error with sending email";
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