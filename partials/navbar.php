<!-- ======================================= Stat of Header ======================================-->
<!--Will add later if search function is implemented -->
<!-- <nav class="navbar navbar-light">
      <div class="container-fluid">
        <a class="navbar-brand"href="#"><img src="drehr.png" width="100" alt="logo"></a>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </nav>
    -->
   
    <header class="header_area">
      <div class="main-menu">
            <nav class="navbar navbar-expand-lg navbar-light bg-color pb-0 pt-0">
                <div class="container-fluid">
                    <a class="navbar-brand px-3" href="#"><img src="<?php echo $ROOT?>drehr.png" width="75" height="75" alt="logo"></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav pt-3 ms-2">
                            <li class="nav-item ">
                              <a class="nav-link" href="/EHR/home.php">Home</a>
                            </li>
                            <li class="nav-item ">
                              <a class="nav-link" href="/EHR/Ehr.php">Ehr</a>
                            </li>
                            <li class="nav-item ">
                              <a class="nav-link" href="/EHR/aboutus.php" > About us</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="/EHR/help.php" > Help</a>
                            </li>
                        </ul>
                        <?php if(!isset($_SESSION["loggedin"])): ?>
                          <ul class="navbar-nav ms-sm-2 pt-lg-3 ms-lg-auto">
                              <li class="nav-item me-2">
                                <a class="nav-link" href="/EHR/Register/Register.php" > Register</a>
                              </li>
                              <li class="nav-item me-2">
                                <a class="nav-link" href="/EHR/Login/Login.php"> Login</a>
                              </li>
                          </ul>
                        <?php endif;?>
                        <?php if(isset($_SESSION["loggedin"])): ?>
                          <ul class="navbar-nav ms-sm-2 pt-lg-3 ms-lg-auto">
                              <li class="nav-item me-2">
                                <a class="nav-link" href="/EHR/logout.php" > Logout</a>
                              </li>
                          </ul>
                        <?php endif;?>


                    </div>
                </div>
            </nav>
        </div>
    </header> 
    <!-- ====================================End of Header================================================-->
