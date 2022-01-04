<?php 
    $ROOT="../";
    require_once "../partials/header.php";
    require_once "../partials/navbar.php";
    $_SESSION['url'] = $_SERVER['REQUEST_URI']; 
    require_once "../Login/authorize.php";

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
        $nextId = $conn->query("SHOW TABLE STATUS LIKE 'patient'")->fetch(PDO::FETCH_ASSOC)['Auto_increment'];
        if(is_uploaded_file($_FILES['Profile']["tmp_name"])){
            $file_path="./image/".$nextId."/Profile/";
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
                $folder = "image/".$nextId."/Profile/".$profileimg;
                move_uploaded_file($tempname, $folder);
            }else{
                $_SESSION['imageerror']="Please enter a valid file";
                header('Location: ./createpatient.php');
                exit;
            }
        }else{
            $profileimg="profile.jpg";
        }
        $sql="INSERT INTO patient(Firstname,Lastname,DOB,Age,Sex,Doctor_ID,Profile_image,Consent,Notes) VALUES(:fname,:lname,:dob,:age,:sex,:DID,:Profileimg,:Consent,:notes)";
        $statement=$conn->prepare($sql);
        $statement->bindParam(':fname',$Firstname,PDO::PARAM_STR);
        $statement->bindParam(':lname',$Lastname,PDO::PARAM_STR);
        $statement->bindParam(':age',$Age,PDO::PARAM_INT);
        $statement->bindParam(':dob',$DOB);
        $statement->bindParam(':sex',$sex,PDO::PARAM_STR);
        $statement->bindParam(':DID',$doctorid,PDO::PARAM_STR);
        $statement->bindParam(':Profileimg',$profileimg,PDO::PARAM_STR);
        $statement->bindParam(':Consent',$consent,PDO::PARAM_STR);
        $statement->bindParam(':notes',$Notes,PDO::PARAM_STR);
        $patient=$statement->execute();
        if(!$patient){
            $_SESSION['message']="Cannot create patient.Something went wrong";
            header('Location: ../error.php');
        }else{
        header('Location: ./Patient.php?id='.$nextId.'');
        }
    }


?>

<!-==============================Create Patient============================================== -->
 <section class="Patient">
    <div class="container">
        <div class="row justify-content-center align-items-center mt-5 ">
            <div class="column col-sm-12 col-md-7 col-lg-6">
                <form action="createpatient.php" enctype="multipart/form-data" method="POST">
                    <h3 class="mb-4 px-5">Create Patient</h3>
                    <?php if(isset( $_SESSION["message"]) && !empty( $_SESSION["message"])): ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <?php echo $_SESSION['message'];
                                unset($_SESSION["message"]);
                            ?>
                            </div>
                    <?php endif; ?>    
                    <div class="mb-3">
                        <label class="mb-2" for="Firstname">Firstname: </label>
                        <input type="text" name="Firstname" value="<?php if(isset($_POST["Firstname"])) echo $_POST["Firstname"]; ?>" id="Firstname" required>
                    </div>
                    <div class="mb-3">
                        <label class="mb-2" for="Lastname">Lastname: </label>
                        <input type="text" name="Lastname" value="<?php if(isset($_POST["Lastname"])) echo $_POST["Lastname"]; ?>" id="Lastname" required>
                    </div>
                    <div class="mb-3">
                        <input type="hidden" name="DID" value="<?= $_SESSION['Doctor_id'] ?>">    
                    </div>
                    <div class="mb-3" >
                        <label class="mb-2" for="Age">Age</label>
                        <input type="text" name="Age" value="<?php if(isset($_POST["Age"])) echo $_POST["Age"]; ?>" id="Age"required >
                    </div>
                    <div  class="mb-3">
                        <label class="mb-2" for="datepicker">Date-of-Birth</label>
                        <input type="text" name="DOB" value="<?php if(isset($_POST["DOB"])) echo $_POST["DOB"]; ?>" id="datepicker"required>
                    </div>
                    <div class="mb-3">
                        <label class="pe-2 inline" for="">Gender:</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" style="width: 15px;" type="radio" name="Sex" value="Male" id="Sex"required>
                            <label class="form-check-label inline" for="Sex">
                               &nbsp; Male
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" style="width: 15px;" value="Female" name="Sex" id="Sex"required >
                            <label class="form-check-label inline" for="Sex">
                               &nbsp; Female
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" style="width: 15px;" name="Sex" value="N/A" id="Sex" >
                            <label class="form-check-label inline" for="Sex">
                               &nbsp; N/A
                            </label>
                        </div>
                    </div>
                    <div class="">
                        <label for="file-input"><i class="fas fa-upload"></i> &nbsp; Choose Image</label>
                        <input type="file" id="file-input" name="Profile" style="display:none;" accept="image/png, image/jpeg" multiple>
                        <p id="num-of-files">No Image Chosen</p>
                        <div id="images"></div> 
                    </div>
                    <div class="mb-3">
                        <label  class="mb-2"  for="Notes">Notes:</label>
                        <textarea name="Notes" id="notes" cols="50" rows="3" ></textarea> 
                    </div>
                    <div class="form-check form-check-inline mb-3 check">
                        <input class="form-check-input" style="width: 15px;" type="checkbox" id="consent" name="consent"value="Yes">
                        <label class="mb-2"  class="form-check-label" for="consent">&nbsp; Do you consent to share your data?</label>
                    </div>
                    <div class="mb-3">
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