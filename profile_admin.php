<?php

    include 'nav_bar_admin.php';

?>

<?php startblock('content') ?>

<?php

if(isset($_POST['passchange']))
{
  $curpass = $_POST['cur-pass'];
  $newpass = $_POST['new-pass'];
  $newpassconf = $_POST['new-pass-conf'];
  $newpasshash = md5($newpass);
  if ($newpass != $newpassconf){
    $message = "Passwords do not match";
    echo "<script type='text/javascript'>alert('$message');</script>";
  }
  else{
    $user = $_SESSION['Username'];
    $sql = "SELECT Password FROM Users WHERE Username='$user' AND Designation='admin'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        // if(.$row["Password"].==$upassword){
        if($row["Password"]!=md5($curpass) ){
          // $_SESSION['Username'] = $uname;
          // header("Location: profile.php");
          $message = 'Invalid Password';
          echo "<script type='text/javascript'>alert('$message');</script>";
        }

        else {
          $sql2 = "UPDATE Users SET Password='$newpasshash' WHERE Username='$user'";
          $result2 = $conn->query($sql2);
          $message = 'Password Updated Successfully';
          echo "<script type='text/javascript'>alert('$message');</script>";

        }
      }
    }
  }
}

?>

<br>
<br>
<br>


<div class="container-fluid">
  <div class="row">
    <div class="col-lg-2"></div>
    <div class="col">
      <form action="profile_admin.php" method="post">
        <div class="card">
          <div class="card-header">
            Update Password
          </div>
          <div class="card-body">
            <p><input class="form-control" placeholder="Current Password" name="cur-pass" type="password" required/></p>
            <p><input class="form-control" placeholder="New Password" name="new-pass" type="password" required/></p>
            <p><input class="form-control" placeholder="Confirm New Password" name="new-pass-conf" type="password" required/></p>
            <input class="btn btn-primary" name="passchange" type="submit" value="Change Password"/>
          </div>
        </div>
      </form>
      <!-- </div> -->


    </div>
    <div class="col-lg-2"></div>
  </div>
</div>

<?php endblock() ?>
