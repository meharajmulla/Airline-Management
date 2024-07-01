<?php

    include 'navbar_messmanager.php';

?>

<?php startblock('content') ?>

<br><br><br>
  <div class="container-fluid">
          <div class="row">
            <div class="col-lg-2"></div>
            <div class="col align-self-center">

<?php
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
$date = date("Ym", strtotime("-1 months"));
$user10=$_SESSION["Username"];
$sql10 = "SELECT * FROM Hostels WHERE MessManagerUsername='$user10'";
$result10 = $conn->query($sql10);

$mess10="";
$fname="";

if ($result10->num_rows > 0) {

while($row10 = $result10->fetch_assoc()) {
  $mess10=$row10["Name"];
  $fname=$row10["MessManagerName"];
}
}


$sql2 = "SELECT * FROM Keywords";

$hcount = 0;
    $hostel = $mess10;
    $totrating = 0.0;
    $totcount = 0;
    $poscount=0;
    $negcount=0;
    $nocount=0;
    $hcount += 1;
    $sql = "SELECT * FROM Feedback WHERE YearMonth='$date' AND HostelSubscribed='$hostel'";
    // echo $sql;
    $result = $conn->query($sql);
    if ($result ==TRUE && $result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {

        $feedback = $row["Feedback"];
        $feed_arr = explode(" ",$feedback);
        $rating = 0.0;
        $count = 0;
        // print_r($feed_arr);
        for ($i=0; $i<count($feed_arr); $i=$i+1){
          $result2 = $conn->query($sql2);
          if ($result2->num_rows > 0){
            // echo  $feed_arr[$i];
            // echo "a ";
            while ($row2 = $result2->fetch_assoc()){
              // echo  $feed_arr[$i];
              // echo "b ";
              if (strtolower($feed_arr[$i]) == strtolower($row2['KeyName'])){
                $rating = $rating + $row2['Value'];
                $count += 1;
              }
            }
          }

        }
        if ($count != 0){
          // echo $rating/$count;
          if($rating>0)
          {$poscount=$poscount+1;}
          else if($rating<0){
            $negcount=$negcount+1;
          }
          else{
            $nocount=$nocount+1;
          }
          $totrating +=  $rating / $count;
          $totcount += 1;
        }
      }
    }
    // else {
    //   echo "0 results";
    // }
    if ($totcount != 0){
      $totrating /= $totcount;
    }
    $totrating = round($totrating, 2);
    ?>

    <div class="card">
      <div class="card-header" id="heading<?php echo $hostel; ?>">
        <h5 class="mb-0">
          <button class="btn btn-link <?php if ($hcount != 1) echo "collapsed";?>" data-toggle="collapse" data-target="#collapse<?php echo $hostel; ?>" aria-expanded="<?php if ($hostel == 1) echo "true"; else echo "false"; ?>" aria-controls="collapse<?php echo $hostel; ?>">
            <b><?php echo $hostel; ?></b> :  Average Rating = <b><?php echo $totrating; ?></b>
          </button>
        </h5>
      </div>
      <div id="collapse<?php echo $hostel; ?>" class="collapse <?php if ($hcount == 1) echo "show";?>" aria-labelledby="heading<?php echo $hostel; ?>" data-parent="#accordion">
        <div class="card-body">
          <form action="notice.php" method="post">
            <label>Total Meaningful Feedbacks</label>
              <p><input class="form-control" type="text" size="50" value= <?php echo $totcount ?> readonly/></p>
              <label>Positive Feedbacks</label>
              <p><input class="form-control" type="number" size="50" value= <?php echo $poscount ?> readonly/></p>
              <label>Negative Feedbacks</label>
              <p><input class="form-control" type="number" size="50" value= <?php echo $negcount ?> readonly/></p>
              <label>Neutral Feedbacks</label>
              <p><input class="form-control" type="number" size="50" value= <?php echo $nocount ?> readonly/></p>

          </form>
        </div>
      </div>
    </div>

    <br><br>
    <?php if($totrating < 0){ ?>
    <div class="card">
  <h5 class="card-header" align = "center">Notice</h5>
  <div class="card-body">
    <h5 class="card-title" align = "center" >Show Cause!</h5>
    <p class="card-text">The mess manager <b><?php echo $fname ?></b> is hereby informed that the mess of hostel <b><?php echo $mess10 ?></b> has underperformed considerably attaining a rating of <b><?php echo $totrating ?> (</b>on a scale of -5 to 5<b>)</b> for the month of <b><?php echo date("F Y",strtotime("-1 months"))?></b>. He/She is, therefore, required to submit a detailed report of what went wrong and what strategies will be undertaken to change this situation next month. A repetition of such an event will result in cancellation of contract with the mess manager. Failing to do so will result in serious action against the mess manager.</p>
  </div>
</div>
<?php
} else{ ?>
  <div class="card">
<h3 class="card-header" align="center">Notice</h3>
<div class="card-body">
  <h5 class="card-title" align="center">No New Notice</h5>
</div>
</div>
<?php
}
?>

</div>
<div class="col-lg-2"></div>
</div>
</div>


<?php endblock() ?>
