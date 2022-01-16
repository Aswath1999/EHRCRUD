
<?php 
// Check whether user is logged in or not.
if(!(isset($_SESSION["loggedin"])  && $_SESSION["loggedin"] == "TRUE")) {
    $_SESSION["message"]="You must be logged in";
    header('Location: /EHR/Login/Login.php');
    exit;
}
?>