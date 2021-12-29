<?php 
$ROOT="../";
include "../partials/header.php";
require_once "../partials/navbar.php";

if($_SERVER['REQUEST_METHOD']=='POST'){
    $email=$_POST["emailid"];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['email-error'] = "Please enter valid email address";
        header('Location: ./Login.php');
    }
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
            $_SESSION['message']= "The account hasn't been activated yet";
            header('Location: ./login.php'); 
        }
      }else{
        $_SESSION['message']= "Userid or password doesn't match" ;
        header('Location: ./login.php'); 
      }
    }else{
      $_SESSION['message']= "The username doesn't exist in the database";
      header('Location: ./login.php'); 
    }
  }





  require_once "../partials/footer.php";

?>