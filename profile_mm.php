<?php

    include 'navbar_mm.php';

?>

<?php startblock('content') ?>

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-2"></div>
    <div class="col">
      <br><br><br>



      <?php
      $user = $_SESSION['Username'];

      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "IITGMessRating";

      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      $sql = "SELECT * FROM Hostels WHERE MessManagerUsername='".$user."'";
      $result = $conn->query($sql);
      $curmess = "";
      if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          echo '<div class="card">
          <div class="card-header">
          Profile
          </div>
          <div class="card-body">
          <h5 class="card-title">'.$row["MessManagerName"].'</h5>
          <p class="card-text">
          <b>Username:</b> '.$row["MessManagerUsername"].'<br>
          <b>Contact Number:</b> '.$row["MessManagerContactNumber"].'<br>
          <b>Designation:</b> Mess Manager<br>
          </p>
          </div>
          </div>

          ';
        }
      } else {
        echo "0 results";
      }

      ?>



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
        $sql = "SELECT MessManagerPassword FROM Hostels WHERE MessManagerUsername='$user'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            // if(.$row["Password"].==$upassword){
            if($row["MessManagerPassword"]!=md5($curpass) ){
              // $_SESSION['Username'] = $uname;
              // header("Location: profile.php");
              $message = 'Invalid Password';
              echo "<script type='text/javascript'>alert('$message');</script>";
            }

            else {
              $sql2 = "UPDATE Hostels SET MessManagerPassword='$newpasshash' WHERE MessManagerUsername='$user'";
              $result2 = $conn->query($sql2);
              $message = 'Password Updated Successfully';
              echo "<script type='text/javascript'>alert('$message');</script>";

            }
          }
        }
      }
    }

    ?>

    </div>
    <div class="col-lg-2"></div>
  </div>
</div>

<br>

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-2"></div>
    <div class="col">
      <form action="profile_mm.php" method="post">
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
