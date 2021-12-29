<?php 
$ROOT="../";
require_once "../partials/header.php";
// require_once "../partials/navbar.php";
require_once "../Register/validatepassword.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    $password=$_POST['password'];
    $confirmpassword=$_POST['confirmpassword'];
    $email=$_POST['email'];
    $hash=$_POST['hash'];
    if(valid_password($password)){
        $pass=password_hash($password,PASSWORD_DEFAULT);
        if($password==$confirmpassword){
            $new_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE register SET Password='$pass', hash='$hash' WHERE Emailid='$email'";
            $statement=$conn->prepare($sql);
            if($statement->execute()){
                $_SESSION['message'] = "Your password has been reset successfully!";
                header('Location: ../success.php');  
            }else{
                $_SESSION['message'] = "Something wen't wrong, Try again later!";
                header('Location: ../error.php'); 
            }
        }else{
            $_SESSION['message'] = "Passwords don't match.";
            header('Location: ./newpassword.php?email='.$email.'&hash='.$hash);
        }
     
    }else{
        $_SESSION['message']= "Password is too weak!!";
        header('Location: ./newpassword.php?email='.$email.'&hash='.$hash);
    }
   
}

?>