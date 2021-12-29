<?php 
include "../partials/header.php";
if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
    $email=$_GET['email'];
    $hash=$_GET['hash'];
    $sql="SELECT * FROM register WHERE Emailid=:email AND Hash=:hashdb AND Active IS NULL";
    $statement=$conn->prepare($sql);
    $statement->bindParam(':email',$email,PDO::PARAM_STR);
    $statement->bindParam(':hashdb',$hash,PDO::PARAM_STR);
    $statement->execute();
    $result=$statement->fetch(PDO::FETCH_ASSOC);
    if(!$result){
        $_SESSION['message'] = "Account has already been activated or the URL is invalid!";
        header('Location: ../error.php');
    }else{
        $_SESSION['message'] = "Your account has been activated!";
        $sql="UPDATE register SET Active='1' WHERE Emailid='$email'";
        $statement=$conn->prepare($sql);
        $logininfo=$statement->execute();
        $_SESSION['Doctor_id']=$logininfo['ID'];
        $_SESSION['loggein']=1;
        $_SESSION['loggedin'] = "TRUE"; 
        header('Location: ../success.php');
    }
    
}else{
    echo "Oops,something went wrong.";
}

?>