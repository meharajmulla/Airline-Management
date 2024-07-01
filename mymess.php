<?php
include 'navbar_messmanager.php' ?>

<?php startblock('content') ?>


<div class="container-fluid">
  <div class="row">
    <div class="col-lg-2"></div>
    <div class="col">

      <br><br><br>
      <div class="card">
        <div class="card-body">
          <form action="mymess.php" method="post">

            <p>Enter year and month of the mess ratings that you want to view</p>
            <p><input class="form-control" placeholder="Year (yyyy)" name="year" type="text" required/></p>
            <p>
              <select class="form-control" id="select_1" name="mon">
                <option value="01">January</option>
                <option value="02">February</option>
                <option value="03">March</option>
                <option value="04">April</option>
                <option value="05">May</option>
                <option value="06">June</option>
                <option value="07">July</option>
                <option value="08">August</option>
                <option value="09">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
              </select>
            </p>
            <input class="btn btn-primary" name="viewrat" type="submit" value="View Feedbacks"/>
          </form>
        </div>
      </div>
      <br>
      <div id="accordion">

        <?php
        if (empty($_SESSION['datee']))
        {
          header("Location: temprating2.php");
        }
        $date=$_SESSION["datee"];
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
        $sql3 = "SELECT * FROM Feedback WHERE HostelSubscribed='".$mess10."' AND YearMonth='$date'";
        $result = $conn->query($sql3);

        if ($result==TRUE && $result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {

        ?>
        <div class="card">
          <div class="card-body">
            <?php echo $row["Feedback"] ?>
          </div>
        </div>
      <?php }}?>


        <?php
        if (isset($_POST['viewrat'])){
          $date2 = "";
          $fail = 0;

          $year = $_POST['year'];
          $month = $_POST['mon'];
            if (is_numeric($year)){
              if ($year < 2100 && $year > 1950){
                  $date2 = $year."".$month;
              }
              else
               $fail = 1;
            }
            else
              $fail = 1;
          // }

          if ($fail == 0){
              $_SESSION["datee"]=$date2;
              header("Location: temprating2.php");

      }
        else {
          $message = "Invalid Year";
          echo "<script type='text/javascript'>alert('$message');</script>";
        }
      }
        ?>
      </div>

    </div>
    <div class="col-lg-2"></div>
  </div>
</div>

<?php endblock() ?>
