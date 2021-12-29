<?php 
  $ROOT="../";
  require_once "../partials/header.php";
  require_once "../partials/navbar.php";
  $_SESSION['url'] = $_SERVER['REQUEST_URI']; 
  require_once "../Login/authorize.php";

  $id=$_GET['id'];

  $sql="SELECT * FROM patient WHERE Doctor_Id='{$_SESSION['Doctor_id']}' AND id='$id'";
  $statement=$conn->prepare($sql);
  $statement->execute();
  $patient=$statement->fetch();
if ($patient){
    if($patient['Profile_image']=="profile.jpg"){
        echo '<img src="./profile.jpg" alt="" style="max-height:200px;width:200px;">';
    }else{
        echo '<img src="./image/'.$patient['id'].'/Profile/'.$patient['Profile_image'].'" alt=""style="max-height:200px;width:200px;" >';
    }
    echo '<a href="./editpatient.php?id='.$patient['id'].'">Edit</a> <br>';
    echo 'Firstname: '.$patient['Firstname'].'<br>';
    echo 'Lastname: '.$patient['Lastname'].'<br>';
    echo 'Date of Birth:' .$patient['DOB'].'<br>';
    echo 'Age: '.$patient['Age'].'<br>';
    echo 'Sex: '.$patient['Sex'].'<br>';
}
?>
<div class="accordion" id="image">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
       Images
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse " aria-labelledby="headingOne" data-bs-parent="image">
      <div class="accordion-body">
        <div class="conntainer-fluid">
            <div class="row">
                <div class="column">
                    <a class="ms-auto" href="../ImageCRUD/insert.php?id=<?php echo $patient['id']?>">Insert</a>
                    <?php 
                        $sql1="SELECT * FROM images WHERE Patient_Id='$id'";
                        $statement=$conn->prepare($sql1);
                        $statement->execute();
                        $images=$statement->fetchAll(PDO::FETCH_ASSOC);
                        if($images){
                          foreach($images as $image){
                              echo $image['Location'];
                            echo '<img src="image/'.$id.'/'.$image['Image'].'"height="100";width="100"" alt=""> <br>';
                            echo '<a href="../ImageCRUD/deleteimage.php?id='.$image['id'].'&image='.$image['Image'].'&pid='.$id.'"> Delete Image</a>';

                          }
                        }
                       
                    ?>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>

  
<?php 

    require_once  __DIR__."/../partials/footer.php";
?>