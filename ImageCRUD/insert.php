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
                $sql = "INSERT INTO images (Patient_id,Image,Location) VALUES ('$id','$filename','$Location')";
                $statement=$conn->prepare($sql);
                $statement->execute();
                if (move_uploaded_file($tempname, $folder))  {
                    $_SESSION['message'] = "Image uploaded successfully";
                    header('Location: ../CRUD/Patient.php?id='.$id.'');
                }else{
                    $_Session['message'] = "Failed to upload image";
                    header('Location: ../CRUD/Patient.php?id='.$id.'');
                }
                }else{
                    echo "failure";
                }
    
            
        }
    }
       
        
?>



<div id="content">
  
  <form method="POST" 
        action="./insert.php?id=<?php echo $_GET['id']?>" 
        enctype="multipart/form-data">
      
      <input type="file" 
             name="uploadfile[]" 
             value="" accept=".jpg,.png" multiple />
       <input type="hidden" id="PatientId" name="PatientId" value="<?php echo $_GET['id']?>">
       <div>
           <label for="Location">Location</label>
           <input type="text" id="Location" name="Location">
       </div>

      <div>
          <button type="submit"
                  name="upload">
            UPLOAD
          </button>
      </div>
  </form>
</div>