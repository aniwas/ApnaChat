<?php 
include('config.php');
session_start();
if(!isset($_SESSION['unique_id'])){
    if(isset($_REQUEST['email'])) {
        $sql = "SELECT email, password FROM users WHERE email = '".$_REQUEST['email']."' AND password  = '".md5($_REQUEST['password'])."' limit 1 ";
        $result = $conn->query($sql);
        if($result->num_rows == 1) {
            $_SESSION['unique_id'] = true;
            $_SESSION['email'] = $_REQUEST['email'];
            echo "<script> location.href = 'login.php';</script>";
            exit;
        } else {
            $msg = '<div class="alert alert-warning mt-2">Enter valid Email and Password</div>';
        }
    }
} else {
    echo "<script> location.href = 'login.php';</script>";
}

if(isset($_REQUEST['log_update'])) {
  if(($_REQUEST['log_email'] == "") || ($_REQUEST['log_password'] == "")) {
    // Display message if required field missing
    $errmsg = '<div class="alert alert-warning col-sm-12 ml-5 mt-2" role="alert">Please fill all Fields</div>';
  } else {
    $log_email = $_REQUEST['log_email'];
    $log_password = md5($_REQUEST['log_password']);

    $sql = "UPDATE users SET password = '$log_password' WHERE email = '$log_email' ";
    if($conn->query($sql) == TRUE) {
        $errmsg = '<div class="col-sm-6 ml-5 mt-2 alert alert-success mt-2 mb-2" role="alert">Updated Succesfully</div>';
      } else {
        $errmsg = '<div class="col-sm-6 ml-5 mt-2 alert alert-success mt-2 mb-2" role="alert">Unable to update</div>';
      }
  }
}

?>

<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="form signup">
      <header>Realtime Webchat By Aniwas</header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="name-details">
          <div class="field input">
            <label>First Name</label>
            <input type="text" name="fname" placeholder="First name" required>
          </div>
          <div class="field input">
            <label>Last Name</label>
            <input type="text" name="lname" placeholder="Last name" required>
          </div>
        </div>
        <div class="field input">
          <label>Email Address</label>
          <input type="text" name="email" placeholder="Enter your email" required>
        </div>
        <div class="field input">
          <label>Password</label>
          <input type="password" name="password" placeholder="Enter new password" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="field image">
          <label>Select Image</label>
          <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Continue to Chat">
        </div>
      </form>
      <div class="link">Already signed up? <a href="login.php" style="color: yellow">Login now</a></div>
    </section>
  </div>

  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/signup.js"></script>

</body>
</html>
