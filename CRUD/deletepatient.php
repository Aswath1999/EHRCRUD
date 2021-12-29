<?php 
  $ROOT="../";
  require_once "../partials/header.php";
  require_once "../partials/navbar.php";
  $_SESSION['url'] = $_SERVER['REQUEST_URI']; 
  require_once "../Login/authorize.php";


$id=$_GET['id'];
$sql="SELECT Profile_Image FROM patient WHERE id=$id";
$statement=$conn->prepare($sql);
$statement->execute();
$image=$statement->fetch(PDO::FETCH_ASSOC);
if (file_exists("./image/".$id."/Profile/".$image['Profile_Image']."")){
    unlink("./image/".$id."/Profile/".$image['Profile_Image']."");
    echo "success";
}
$sql="SELECT Image FROM images WHERE Patient_Id=$id";
$statement=$conn->prepare($sql);
$statement->execute();
$images=$statement->fetchAll(PDO::FETCH_ASSOC);
if ($images){
  foreach($images as $image){
    if (file_exists("./image/".$id."/".$image['Image']."")){
      unlink("./image/".$id."/".$image['Image']."");
   }
  }
}


$sql="DELETE FROM patient,images USING patient 
INNER JOIN images on patient.id=images.Patient_Id WHERE patient.id='$id'";
$statement=$conn->prepare($sql);
if($statement->execute()){
    $_SESSION['message']="The patient has been successfully deleted";
    header('Location: ../Ehr.php');
}

?>