<?php 
    $ROOT="./";
    require_once __DIR__."/partials/header.php";
    require_once "./partials/navbar.php";
?>
 
<section class="Result">
    <div class="container">
        <div class=" align-items-center">
            <?php if(isset($_SESSION['message'])){
                echo '<h3>'.$_SESSION['message'].'</h3>';
                unset($_SESSION['message']);
            } ?>
        </div>
    </div>

</section>

<?php 

    require_once  __DIR__."/partials/footer.php";
?>