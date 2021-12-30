<?php  
  $ROOT="../";
  require_once "../partials/header.php";
  require_once "../partials/navbar.php";
  $_SESSION['url'] = $_SERVER['REQUEST_URI']; 
  require_once "../Login/authorize.php";

if (isset($_POST['upload'])) {
        $id=$_POST['PatientId'];
        $Location=$_POST['Location'];
        $file_path="../CRUD/image/".$id;
        if(!file_exists($file_path))
            {
                mkdir($file_path, 0777, true);
                echo "success";
            }
        
        $total= count($_FILES['uploadfile']['name']);
        for($i=0;$i<$total;$i++){
            // echo $_FILES['uploadfile']['name'][$i];
            $filename = $_FILES["uploadfile"]["name"][$i];
            $info = new SplFileInfo($filename);
            $extensions=["jpg","png"];
            if (in_array($info->getExtension(),$extensions)){
                $tempname = $_FILES["uploadfile"]["tmp_name"][$i];  
                $folder = "../CRUD/image/".$id."/".$filename;
                if(isset($_POST['Description'])){
                    $description=$_POST['Description'];
                }else{
                    $description="";
                }
                $date=$_POST['Date'];
                $sql = "INSERT INTO images (Patient_id,Image,Location,Date,Description) VALUES ('$id','$filename','$Location','$date','$description')";
                $statement=$conn->prepare($sql);
                $statement->execute();
                if (move_uploaded_file($tempname, $folder))  {
                    // $_SESSION['message'] = "Image uploaded successfully";
                    header('Location: ../CRUD/Patient.php?id='.$id.'');
                }else{
                    $_Session['message'] = "Failed to upload image";
                    header('Location: ../error.php');
                    // header('Location: ../CRUD/Patient.php?id='.$id.'');
                }
                }else{
                    echo "failure";
                }
    
            
        }
    }
       
        
?>

<section class="image-upload">
    <div class="container">
        <div class="row justify-content-center align-items-center ">
            <div class="col col-lg-7 offset-lg-4 align-self-center mt-5">
                <form action="./insert.php?id=<?php echo $_GET['id']?>" method="POST" enctype="multipart/form-data" >
                    <h3 class="mb-4 px-5">Upload Image</h3>
                    <div class="mb-2">
                        <input type="file"  name="uploadfile[]" accept=".jpg,.jpeg,.png" multiple required>
                    </div>
                    <input type="hidden" id="PatientId" name="PatientId" value="<?php echo $_GET['id']?>">
                    <div class="mb-2">
                        <label class="mb-1"for="Location">Location:</label>
                        <input type="text" id="Location" name="Location" placeholder="Image position">
                    </div>
                    <div class="mb-2">
                        <label class="mb-1"for="Date">Date:</label>
                        <input type="date" id="Date" name="Date" placeholder="Date of Image"required>
                    </div>
                    <div class="mb-2">
                        <label for="Description" class="mb-1">Description: </label>
                        <textarea name="Description" id="Description" cols="46" rows="3"></textarea>
                    </div>
                    <div class="mb-2">
                        <button type="submit" class="btn btn-success mb-3" 
                                name="upload">
                            UPLOAD
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


