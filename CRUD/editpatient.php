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
  if($_SERVER['REQUEST_METHOD']=='POST'){
    $Firstname=$_POST["Firstname"];
    $Lastname=$_POST["Lastname"];
    $doctorid=$_POST["DID"];
    $Age=$_POST["Age"];
    $DOB=$_POST["DOB"];
    $sex=$_POST["Sex"];
    if(!isset($_POST['consent'])){
        $consent="No";
    }else{
    $consent=$_POST['consent'];
    }
    if(!isset($_POST['Notes'])){
        $Notes="";
    }else{
    $Notes=$_POST['Notes'];
    }
    if(is_uploaded_file($_FILES['Profile']["tmp_name"])){
        unlink("./image/".$id."/Profile/".$patient['Profile_image']."");
        $file_path="./image/".$id."/Profile/";
        if(!file_exists($file_path))
        {
            mkdir($file_path, 0777, true);
            echo "success";
        }
        $profileimg = $_FILES["Profile"]["name"];
        $info = new SplFileInfo($profileimg);
        $extensions=["jpg","png","jpeg"];
        if (in_array($info->getExtension(),$extensions)){
            $tempname = $_FILES["Profile"]["tmp_name"];
            $folder = "image/".$id."/Profile/".$profileimg;
            move_uploaded_file($tempname, $folder);
        }else{
            $_SESSION['imageerror']="Please enter a valid file";
            header('Location: ./editpatient.php');
            exit;
        }
    }else{
        $profileimg=$patient['Profile_image'];
    }
    $sql="UPDATE patient SET Firstname=:fname,Lastname=:lname,DOB=:dob,Age=:age,Sex=:sex,Doctor_ID=:DID,
    Profile_image=:Profileimg,Consent=:Consent,Notes=:notes WHERE id=$id";
    $statement=$conn->prepare($sql);
    $statement->bindParam(':fname',$Firstname,PDO::PARAM_STR);
    $statement->bindParam(':lname',$Lastname,PDO::PARAM_STR);
    $statement->bindParam(':dob',$DOB);
    $statement->bindParam(':age',$Age,PDO::PARAM_INT);
    $statement->bindParam(':sex',$sex,PDO::PARAM_STR);
    $statement->bindParam(':DID',$doctorid,PDO::PARAM_STR);
    $statement->bindParam(':Profileimg',$profileimg,PDO::PARAM_STR);
    $statement->bindParam(':Consent',$consent,PDO::PARAM_STR);
    $statement->bindParam(':notes',$Notes,PDO::PARAM_STR);
    $editpatient=$statement->execute();
    // echo "success";
  }

?>







<section class="Patient">
    <div class="container">
        <div class="row justify-content-center align-items-center mt-2 ">
            <div class="column col-sm-12 col-md-7 col-lg-6">
                <form action='editpatient.php?id=<?php echo $patient['id']?>' enctype="multipart/form-data" method="POST">
                <h3 class="mb-4 px-5">Edit Patient</h3>
                    <?php if(isset( $_SESSION["message"]) && !empty( $_SESSION["message"])): ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <?php echo $_SESSION['message'];
                                unset($_SESSION["message"]);
                            ?>
                            </div>
                    <?php endif; ?>    
                    <div class="mb-3">
                        <label class="mb-2" for="Firstname">Firstname: </label>
                        <input type="text" name="Firstname" value="<?php if($patient["Firstname"]) echo $patient["Firstname"]; ?>" id="Firstname" required>
                    </div>
                    <div class="mb-3">
                        <label class="mb-2" for="Lastname">Lastname: </label>
                        <input type="text" name="Lastname" value="<?php if($patient["Lastname"]) echo $patient["Lastname"]; ?>" id="Lastname" required>
                    </div>
                    <div class="mb-3">
                        <input type="hidden" name="DID" value="<?= $_SESSION['Doctor_id'] ?>">    
                    </div>
                    <div class="mb-3" >
                        <label class="mb-2" for="Age">Age</label>
                        <input type="text" name="Age" value="<?php if($patient["Age"]) echo $patient["Age"]; ?>" id="Age"required >
                    </div>
                    <div  class="mb-3">
                        <label class="mb-2" for="datepicker">Date-of-Birth</label>
                        <input type="text" name="DOB" value="<?php if($patient["DOB"]) echo $patient["DOB"]; ?>" id="datepicker"required>
                    </div>
                    <div class="mb-3">
                        <label class="pe-2 inline" for="">Gender:</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="Sex" style="width: 20px;" value="Male" id="Sex"required>
                            <label class="form-check-label" for="Sex">
                                Male
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" value="Female" style="width: 20px;" name="Sex" id="Sex"required >
                            <label class="form-check-label" for="Sex">
                                Female
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="Sex" style="width: 20px;" value="N/A" id="Sex" >
                            <label class="form-check-label" for="Sex">
                                N/A
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="mb-2" for="Profile_pic">Insert Profile image: </label>
                        <input type="file" 
                            name="Profile" 
                            accept=".jpg,.png,.jpeg" id="Profile_pic">
                        <!-- <img src="<?php if(file_exists('./image/'.$patient['id'].'/Profile/'.$patient['Profile_image'])) echo './image/'.$patient['id'].'/Profile/'.$patient['Profile_image'] ?>" alt="" width="160" height="160"> -->
                    </div>
                    <div class="mb-3">
                        <label class="mb-2"    for="Notes">Notes</label>
                        <textarea name="Notes" id="notes" cols="50" rows="3" style=" vertical-align: middle"></textarea> 
                    </div>
                    <div class="form-check form-check-inline mb-3">
                        <input  class="form-check-input" type="checkbox" style="width: 20px;" id="consent" name="consent"value="Yes">
                        <label class="form-check-label mb-2" for="consent">Do you consent to share your data?</label>
                    </div>
                    <div>
                        <button class="btn btn-success" type="Submit">Submit</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

 </section>


<?php 

require_once  __DIR__."/../partials/footer.php";
?>