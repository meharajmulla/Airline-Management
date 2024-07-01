<?php

include 'navbar.php';

?>

<?php startblock('content') ?>

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-4">
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

      $sql = "SELECT * FROM Users WHERE Username='".$user."'";
      $result = $conn->query($sql);
      $curmess = "";
      if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          $curmess = $row["HostelSubscribed"];
          echo '<div class="card">
          <div class="card-header">
          Profile
          </div>
          <div class="card-body">
          <h5 class="card-title">'.$row["Name"].'</h5>
          <h6 class="card-subtitle mb-2 text-muted">'.$row["Username"].'</h6>
          <p class="card-text">
          <b>Roll Number:</b> '.$row["RollNumber"].'<br>
          <b>Hostel Residence:</b> '.$row["HostelReside"].'<br>
          <b>Current Hostel Mess Subscribed:</b> '.$row["HostelSubscribed"].'<br>
          <b>Program:</b> '.$row["Program"].'<br>
          <b>Designation:</b> '.$row["Designation"].'<br>
          </p>
          </div>
          </div>

          ';
        }
      } else {
        echo "0 results";
      }

      ?>

    </div>


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
        $sql = "SELECT Password FROM Users WHERE Username='$user' AND Designation='student'";
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
    // echo "hello";

    ?>


    <div class="col-lg-4">
      <br><br><br>

      <form action="profile.php" method="post">
        <div class="card">
          <div class="card-header">
            Change Next Month Mess
          </div>
          <div class="card-body">
            <p><b>Current Mess:</b> <?php echo $curmess ?></p>
            <p>
              <select class="form-control" id="select_1" name="newmess">
                <?php
                $sql15 = "SELECT * FROM Hostels";
                $result15 = $conn->query($sql15);
                if ($result15->num_rows > 0) {
                  // output data of each row
                  while($row15 = $result15->fetch_assoc()) {
                    $hostel15 = $row15['Name'];
                    ?>
                    <option value="<?php echo $hostel15; ?>"><?php echo $hostel15; ?></option>

                    <?php
                  }
                }
                ?>
              </select>
            </p>
            <input class="btn btn-primary btn-block" name="messchange" type="submit" value="Change Mess"/>
            <p><h6 class="card-subtitle mb-2 text-muted">All changes in mess are reflected at the end of the month only.</h6></p>
          </div>
        </div>

      </form>
    </div>
  </div>
  <div class="col-lg-2"></div>
</div>
</div>

<?php
if (isset($_POST['messchange'])){
  $newmess = $_POST['newmess'];
  $sql = "UPDATE Users SET HostelNew='$newmess' WHERE Username='$user'";
  // echo $sql;
  $conn->query($sql);
  $message = 'Hostel Mess Updated Successfully';
  echo "<script type='text/javascript'>alert('$message');</script>";
  $conn->close();

}
?>
<br>

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-2"></div>
    <div class="col">
      <form action="profile.php" method="post">
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
