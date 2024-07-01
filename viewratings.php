<?php
include 'navbar.php' ?>

<?php startblock('content') ?>


<div class="container-fluid">
  <div class="row">
    <div class="col-lg-2"></div>
    <div class="col">

      <br><br><br>
      <div class="card">
        <div class="card-body">
          <form action="viewratings.php" method="post">

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
            <input class="btn btn-primary" name="viewrat" type="submit" value="View Ratings"/>
          </form>
        </div>
      </div>
      <br>
      <div id="accordion">

        <?php
        if (empty($_SESSION['datee']))
        {
          header("Location: temp_rating.php");
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


        $sql2 = "SELECT * FROM Keywords";

        $hcount = 0;
        $sql3 = "SELECT * FROM Hostels";
        $result3 = $conn->query($sql3);
        if ($result3->num_rows > 0){
          while ($row3 = $result3->fetch_assoc()){
            $hostel = $row3['Name'];
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
                  <form action="viewratings.php" method="post">
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

            <?php

          }
        }

        ?>

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
              header("Location: temp_rating.php");

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
<br><br>

<?php endblock() ?>
