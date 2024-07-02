<?php
session_start();
if(isset($_SESSION['unique_id'])) {
  $unique = $_SESSION['unique_id'];
} else {
  echo "<script> location.href='' </script>";
}
define('TITLE', 'User Panel');
include('config.php');
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?php echo TITLE ?></title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="css/all.min.css">

<body>

    <div class="wrapper">

        <!-- Page Content  -->
        <div id="content" >
            <?php 
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
            }
          ?>

            <nav class="navbar navbar-expand navbar-light bg-light" >
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        
                    </button>
                    <span><?php echo $row['fname']. " " . $row['lname'] ?></span>
                    <div id="navbarSupportedContent" >
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="userprofile.php">
								<i class="fas fa-user icon"></i></a></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../users.php">
								<i class="fas fa-sign-out-alt icon"></i></a>
                            </li>
                           
                        </ul>
                    </div>
                </div>
            </nav>
                <!-- Content -->
                <div class="dashboard-content shadow-lg p-4"  >
               <div class="row text-center shadow-lg">
               <img src="images/<?php echo $row['img']; ?>" alt="not found"> 		   
               </div> 
			</div> 
            <!-- Content -->
		</div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
	<script src="js/jquery.min.js"></script>
    <!-- Popper.JS -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="js/bootstrap.min.js"></script>
	
	<!-- Font Awesome JS -->
	<script src="js/all.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
        $(document).ready(function () {
            $('[data-toggle="popover"]').popover();
        });
    </script>
</body>

</html>