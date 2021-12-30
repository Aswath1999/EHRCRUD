<?php 
    $ROOT="../";
    require_once "../partials/header.php";
    require_once "../partials/navbar.php";
    $_SESSION['url'] = $_SERVER['REQUEST_URI']; 
    require_once "../Login/authorize.php";
    if($_SERVER['REQUEST_METHOD']=='GET'){
        $Search=$_GET['Search'];
        $sql="SELECT * FROM patient WHERE Doctor_ID='{$_SESSION['Doctor_id']}' AND 
         Firstname LIKE '%".$Search."%' OR Lastname LIKE '%".$Search."%' OR id LIKE '%".$Search."%'" ;
        $statement=$conn->prepare($sql);
        if($statement->execute()){
            $patientinfo=$statement->fetchAll(PDO::FETCH_ASSOC);
            $length=count($patientinfo);
        }
    }
?>
<section class="dashboard">
    <div class="container ">
        <div class="row mt-3">
            <div class="col col-sm-12 col-lg-6 pt-2">
                <Form action="./createpatient.php">
                    <button class="btn btn-warning">Create patient</button>
                </Form>
            </div>
            <div class="col col-sm-12 col-lg-6">
                <form class="d-flex me-2" action="./search.php">
                    <input class="form-control ms-auto me-2 my-2" style="width:250px" type="search" placeholder="Search" name="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2" type="submit">Search</button>
                </form>
            </div>
        </div>
        <table class="table table-striped  table-bordered  table-hover">
            <thead class="header" >
                <tr>
                <th scope="col">Index</th>
                <th scope="col">Firstname</th>
                <th scope="col">Lastname</th>
                <th scope="col">Patient_ID</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php if($patientinfo): ?>
                <?php for($i=0;$i<$length;$i++): ?>
                <?php  foreach($patientinfo as $patient):?>
                <?php  $i+=1;?>
                <tr >
                    <div class="row">
                        <th scope="col">
                            <div class="col-3">
                                <p><?php echo $i ?></p>
                            </div>
                        </th>
                        <td>
                            <div class="col-3">
                                <div class="name">
                                    <p><?php echo $patient['Firstname'] ?></p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="col-3">
                                <div class="name">
                                    <p><?php echo $patient['Lastname'] ?></p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="col-3">
                                <div class="name">
                                    <p><?php echo $patient['id'] ?></p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="col-3 ">
                                    <a class="btn btn-primary mb-2" href="<?php echo './Patient.php?id='.$patient['id'].''?>">View</a>
                                    <a class="btn btn-danger"href="<?php echo './deletepatient.php?id='.$patient['id'].''?>">Delete</a>
                            
                            </div>
                        </td>
                    </div>
                </tr>
                <?php endforeach; ?>
                <?php endfor; ?>
                 <?php endif; ?>


            </tbody>
        </table>
    </div>
</section>
               




  
<?php 

    require_once  __DIR__."/../partials/footer.php";
?>