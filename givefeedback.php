<?php
include 'navbar.php' ?>

<?php startblock('content') ?>

<?php
$date = date('F Y');

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
$hostel = "";
$name = "";
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $curmess = $row["HostelSubscribed"];
    $hostel = $row["HostelReside"];
    $name = $row["Name"];

  }
} else {
  echo "0 results";
}

?>

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-2"></div>
    <div class="col">

      <br><br><br>

      <div class="card">
        <!-- <div class="card-header">
        Update Password
      </div> -->
      <div class="card-body">
        <p>Welcome to the feedback portal <b><?php echo $name; ?></b></p>
        <p>Residing Hostel: <b><?php echo $hostel; ?></b></p>
        <p>Current Hostel Mess: <b><?php echo $curmess; ?></b></p>
        <p>You are going to enter feedback for <b><?php echo $date ?></b></p>
        <div class="form-group">
          <form action="givefeedback.php" method="post">
            <textarea class="form-control" name="feedtext" rows="6" placeholder="Enter your feedback here" required></textarea><br>
            <input class="btn btn-primary" name="feedback" type="submit" value="Submit Feedback"/>
          </form>
        </div>
      </div>
    </div>


  </div>
  <div class="col-lg-2"></div>
</div>
</div>

<?php
$dateDB = date('Ym');
if(isset($_POST['feedback'])){
  $feedback = $_POST['feedtext'];
  $sql = "SELECT * FROM Feedback WHERE Username='$user' AND YearMonth='$dateDB'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    // output data of each row
    $sql2 = "UPDATE Feedback SET Feedback='$feedback' WHERE Username='$user' AND YearMonth='$dateDB'";
    $result2 = $conn->query($sql2);
    if ($result2 == true){
      $message = "Feedback updated successfully!";
      echo "<script type='text/javascript'>alert('$message');</script>";
    }
    else{
      $message = "Feedback update failed!";
      echo "<script type='text/javascript'>alert('$message');</script>";

    }
  }
  else{
    // echo "Hi2";
    $sql2 = "INSERT INTO Feedback (Username, HostelSubscribed, Feedback, YearMonth) VALUES ('$user', '$curmess', '$feedback', '$dateDB')";
    $result2 = $conn->query($sql2);
    if ($result2 == true){
      $message = "Feedback added successfully!";
      echo "<script type='text/javascript'>alert('$message');</script>";
    }
    else{
      $message = "Feedback addition failed!";
      echo "<script type='text/javascript'>alert('$message');</script>";

    }
  }
}


?>

<?php endblock() ?>
