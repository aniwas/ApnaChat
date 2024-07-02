<?php
include('config.php');
session_start();
if(isset($_SESSION['unique_id'])) {
  header("signup.php");
} else {
  echo "<script> location.href='login.php' </script>";
}

define('TITLE', 'User Profile');
include('asset/header.php');

$sql = "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}";
$result = $conn->query($sql);
if($result->num_rows == 1) {
  $row = $result->fetch_assoc();
  $uName = $row['fname'];
  $uLname=$row['lname'];
  $uPassword = $row['password'];
  $uContact = $row['img'];
  $uEmail = $row['email'];
 }

if(isset($_REQUEST['updatebutton'])) {
  if(($_REQUEST['uPassword'] == "" )) {
    $msg = '<div class="col-sm-6 ml-5 mt-2 alert alert-warning mt-2 mb-2" role="alert">Please fill all Required Field</div>';
  } else {
    $uPassword = md5($_REQUEST['uPassword']);
    $sql = "UPDATE user SET password = '$uPassword' WHERE unique_id = {$_SESSION['unique_id']}";
    if($conn->query($sql) == TRUE) {
      $msg = '<div class="col-sm-6 ml-5 mt-2 alert alert-success mt-2 mb-2" role="alert">Updated Succesfully</div>';
    } else {
      $msg = '<div class="col-sm-6 ml-5 mt-2 alert alert-success mt-2 mb-2" role="alert">Unable to update</div>';
    }
  }
}

?>

  <?php if(isset($msg)) {echo $msg;} ?>
<div class="col-md-12 col-sm-10" style="background-image: url('../images/xyz.jpg'); opacity: 1;">
  <form action="#" class="row shadow-lg p-4 g-3 mx-2 mt-5" method="POST">
    <h2 class="text-center mb-3 col-md-12" style="font-size:25px;">Profile Details</h2>
      <div class="form-group col-md-6">
        <label for="inputName">Full Name</label>
        <input type="text" class="form-control" value="<?php echo $uName ?>" readonly>
      </div>
      <div class="form-group col-md-6">
        <label for="inputName">Last Name</label>
        <input type="text" class="form-control" value="<?php echo $uLname ?>" readonly>
      </div>
      <div class="form-group col-md-6">
        <label for="inputemail">Email ID</label>
        <input type="email" class="form-control" value="<?php echo $uEmail ?>" readonly>
      </div>

      <div class="form-group col-md-6">
        <label class="form-label" for="uPassword">Password</label>
        <input type="text" class="form-control" placeholder="Enter Password" name="uPassword" id="uPassword" value="<?php echo $uPassword ?>"pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
			title="Password must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
      </div>

       <div class="form-group col-md-6">
          <label>Select Image</label>
          <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
      </div>
      <div class="d-grid mt-2 text-center col-md-12">
        <button class="btn btn-danger" type="submit" name="updatebutton">Update</button>
      </div>
    
  </form>
</div>

<?php
include('asset/footer.php');
?>