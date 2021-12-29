<?php 
 $ROOT="../";
 require_once "../partials/header.php";
 require_once "../partials/navbar.php";
 $_SESSION['url'] = $_SERVER['REQUEST_URI']; 
 require_once "../Login/authorize.php";

    $id=$_GET['id'];
    $patient_id=$_GET['pid'];
    $image=$_GET['image'];
    echo $id;
    $sql="DELETE FROM images WHERE id=$id";
    $statement=$conn->prepare($sql);
    if($statement->execute()){
        unlink('../CRUD/image/'.$patient_id.'/'.$image);
        header('Location: ../CRUD/Patient.php?id='.$patient_id.'');
    }else{
        header('Location: ../CRUD/Patient.php?id='.$patient_id.'');
    }
?>