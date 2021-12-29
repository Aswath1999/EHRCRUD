<?php 
    $ROOT="../";
    require_once "../partials/header.php";
    require_once "../partials/navbar.php";
    $_SESSION['url'] = $_SERVER['REQUEST_URI']; 
    require_once "../Login/authorize.php";
?>
<form class="d-flex me-2" action="./search.php">
      <input class="form-control ms-auto me-2 my-2" style="width:250px" type="search" placeholder="Search" name="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2" type="submit">Search</button>
</form>
<Form action="./CRUD/createpatient.php">
        <button class="btn btn-warning">Create patient</button>
</Form>
<?php 
    if($_SERVER['REQUEST_METHOD']=='GET'){
        $Search=$_GET['Search'];
        $sql="SELECT * FROM patient WHERE Doctor_ID='{$_SESSION['Doctor_id']}' AND  Firstname LIKE '%".$Search."%'";
        $statement=$conn->prepare($sql);
        $statement->execute();
        $patientinfo=$statement->fetchAll(PDO::FETCH_ASSOC);
        $length=count($patientinfo);    
    }
?>
<section class="dashboard">
    <div class="container">
        <?php if($patientinfo): ?>
            <?php for($i=0;$i<$length;$i++): ?>
                <?php  foreach($patientinfo as $patient):?>
                    <?php  $i+=1;?>
                    <div class="row">
                        <div class="col-3">
                            <p><?php echo $i ?></p>
                        </div>
                        <div class="col-3">
                            <div class="name">
                                <p><?php echo $patient['Firstname'] ?></p>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="name">
                                <p><?php echo $patient['Lastname'] ?></p>
                            </div>
                        </div>
                        <div class="col-3">
                            <div>
                                <a href="<?php echo './Patient.php?id='.$patient['id'].''?>">View</a>
                                <a href="<?php echo './deletepatient.php?id='.$patient['id'].''?>">Delete</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endfor; ?>
        <?php endif; ?>

    </div>
</section>








  
<?php 

    require_once  __DIR__."/../partials/footer.php";
?>