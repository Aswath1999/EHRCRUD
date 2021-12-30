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
  $sql1="SELECT * FROM images WHERE Patient_Id='$id'";
  $statement=$conn->prepare($sql1);
  $statement->execute();
  $images=$statement->fetchAll(PDO::FETCH_ASSOC);
if ($patient): ?>
  <section class="Patient mt-3">
    <div class="container-fluid">
      <div class="row mt-3  ">
        <div class="col col-sm-12 col-md-6 ms-auto mb-3 ">
          <div class="text-center">
            <?php  if($patient['Profile_image']=="profile.jpg"){ ?>
              <img class="img-fluid img-thumbnail" src="./profile.jpg" alt="">
            <?php }else{ ?>
              <img class="img-fluid img-thumbnail"src="<?php echo './image/'.$patient['id'].'/Profile/'.$patient['Profile_image'].''?>"  alt="">
            <?php } ?>
          </div>
        </div>
            
        <div class="col col-sm-12 col-lg-6 align-self-start">
          <h1 class="mb-3"><?php echo $patient['Firstname'].'<span>'.$patient['Lastname'].'</span>'?></h1>
          <div class="info align-self-center mb-3">
            <p><strong >Firstname: </strong><?php echo $patient['Firstname']?></p>
            <p> <strong>Lastname: </strong><?php echo $patient['Lastname']?> </p>
            <p><strong>Date of Birth: </strong><?php echo $patient['DOB'].'<br>'?></p>
            </p><strong>Age: </strong><?php echo $patient['Age'].'<br>'?></p>
            <p><strong>Sex: </strong><?php echo $patient['Sex'].'<br>'?></p>      
            <p><strong>Patient_ID: </strong><?php echo $patient['id'].'<br>'?></p>      
            <a class="btn btn-primary me-2" href="./editpatient.php?id=<?php echo $patient['id']?>">Edit</a>
            <a class="btn btn-danger" href="./deletepatient.php?id=<?php echo $patient['id']?>">Delete</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="accordion">
    <div class="container-fluid">
    <div class="accordion" id="image">
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Image
          </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#image">
          <div class="accordion-body">
            <div class="text-center button mb-3  ms-auto">
              <a class="btn btn-outline-success ms-auto img" href="../ImageCRUD/insert.php?id=<?php echo $patient['id']?>">Insert new Image</a>
            </div>
            <?php if($images){ ?>
              <?php foreach($images as $image){ ?>
                <div class="row mb-3">
                  <div class="col col-lg-6 col-sm-12">
                    <div class="text-center">
                      <img class="img-fluid"  src="<?php echo "image/".$id."/".$image['Image']."" ?>" alt="">
                    </div>
                  </div>
                  <div class="col col-sm-12  col-lg-5 col-md-12 align-self-center ">
                    <p><strong>Location: </strong><?php echo $image['Location'] ?></p>
                    <p><strong>Date of Image: </strong><?php echo $image['Date'] ?></p>
                    <p><strong>Description: </strong><?php echo $image['Description'] ?></p>
                    <a class="btn btn-danger" href="<?php echo "../ImageCRUD/deleteimage.php?id=".$image['id']."&image=".$image['Image']."&pid=".$id."" ?>">Delete Image</a>
                  </div>
                </div>
              <?php } ?>
            <?php } ?>
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header" id="Notes">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            Doctor Notes
          </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="Notes" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <?php if(!empty($patient['Notes'])){ ?>
            <?php echo $patient['Notes'] ?>
            <?php }else{ ?>
            No Notes recorded.
            <?php } ?>
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header" id="Consent">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseTwo">
            Consent
          </button>
        </h2>
        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="Consent" data-bs-parent="#accordionExample">
          <div class="accordion-body">
          <?php if($patient['Consent']=="Yes"){ ?>
            The patient has agreed to share his/her data for research purposes.
          <?php }else{ ?>
            The patient has not agreed to share his/her data for research purposes.
          <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </section>






<?php endif;?>
  
<?php 

    require_once  __DIR__."/../partials/footer.php";
?>