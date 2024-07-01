<?php
    include 'nav_bar_admin.php';
?>

<?php startblock('content') ?>

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

$sql = "SELECT * FROM Users WHERE Designation='student'";
$result = $conn->query($sql);
$i=0;
?>

<div class="container-fluid">
        <div class="row">
          <div class="col-lg-2"></div>
          <div class="col align-self-center">
<br><br><br>


  <form action="updateusers.php" method="post">
    <div class="card">
      <div class="card-header">
        Add User
      </div>
      <div class="card-body">
      <p><input class="form-control" name='messmanagerusername' placeholder="Username" type="text" size="50" required/></p>
      <p><input class="form-control" name='messmanagerpassword' placeholder="Password" type="password" size="50" required/></p>
      <p><input class="form-control" name='roll' placeholder="Roll Number" type="text" size="20" required/></p>
      <p><input class="form-control" name='messmanagername' placeholder="Name" type="text" size="100" required/></p>
      <!-- <p><input class="form-control" name='hostelres' placeholder="Hostel Resided" type="text" size="30" required/></p> -->
      <p>
        <select class="form-control" id="select_1" name="hostelres">
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
      <!-- <p><input class="form-control" name='hostelsub' placeholder="Hostel Subscribed" type="text" size="30" required/></p> -->
      <p>
        <select class="form-control" id="select_2" name="hostelsub">
          <?php
          $sql16 = "SELECT * FROM Hostels";
          $result16 = $conn->query($sql16);
          if ($result16->num_rows > 0) {
            // output data of each row
            while($row16 = $result16->fetch_assoc()) {
              $hostel16 = $row16['Name'];
              ?>
              <option value="<?php echo $hostel16; ?>"><?php echo $hostel16; ?></option>

              <?php
            }
          }
          ?>
        </select>
        </p>
      <p><input class="form-control" name='prog' placeholder="Program" type="text" size="10" required/></p>
        <input class="btn btn-primary " name="add" type="submit" value="Add User"/>
        </div>
      </div>

  </form>

<div class="accordion" id="accordionExample">
   <?php while($row = $result->fetch_assoc()) {

 ?>

       <div class="card">
         <div class="card-header" id="heading<?php  print $i ?>" >
           <h2 class="mb-0">
             <button class="btn btn-light collapsed" type="button" data-toggle="collapse" data-target="#collapse<?php  print $i ?>" aria-expanded="false" aria-controls="collapse<?php  print $i ?>" >
                <?php echo $row["Username"] ?>
             </button>
           </h2>
         </div>

         <div id="collapse<?php  print $i ?>" class="collapse" aria-labelledby="heading<?php  print $i ?>" data-parent="#accordionExample">
           <div class="card-body">
             <form action="updateusers.php" method="post">
               <?php
                $tempusername=$row['Username'];
                $temproll=$row['RollNumber'];
                $tempname=$row['Name'];
                $temphostelres=$row['HostelReside'];
                $temphostelsub=$row['HostelSubscribed'];
               ?>
               <label >Username</label>
               <p><input class="form-control" name='messmanagerusername<?php  print $i ?>' placeholder="Username" type="text" size="50" value="<?php echo $tempusername?>" readonly/></p>
               <label >Roll Number</label>
               <p><input class="form-control" name='roll<?php  print $i ?>' placeholder="Roll Number" type="text" size="20" value="<?php echo $temproll ?>" readonly/></p>
               <label >Name</label>
               <p><input class="form-control" name='messmanagername<?php  print $i ?>' placeholder="Name" type="text" size="100" value="<?php echo $tempname ?>" readonly/></p>
               <label >Hostel Resident</label>
               <p><input class="form-control" name='hostelres<?php  print $i ?>' placeholder="Hostel Resided" type="text" size="30" value="<?php echo $temphostelres ?>" readonly/></p>
               <label >Hostel Subscribed</label>
               <p><input class="form-control" name='hostelsub<?php  print $i ?>' placeholder="Hostel Subscribed" type="text" size="30" value="<?php echo $temphostelsub ?>" readonly/></p>
                 <input class="btn btn-primary " name="delete<?php  print $i ?>" type="submit" value="Delete User"/>
             </form>
           </div>
         </div>
       </div>
     <?php
     $i=$i+1;
   } ?>


 </div>

 <?php
   $j=0;
   while($j<$i){
     if(isset($_POST['delete'.$j])){
       $username=$_POST['messmanagerusername'.$j];
       $sql2 = "DELETE FROM Users WHERE Username='".$username."'";
       if ($conn->query($sql2) === TRUE) {
           header("Location: updateusers.php");
       }


     }
     $j=$j+1;
   }

   if(isset($_POST['add'])){
     $messmanagerusername2=$_POST['messmanagerusername'];
     $messmanagerpassword2=md5($_POST['messmanagerpassword']);
     $roll2=$_POST['roll'];
     $messmanagername2=$_POST['messmanagername'];
     $hostelres2=$_POST['hostelres'];
     $hostelsub2=$_POST['hostelsub'];
     $prog2=$_POST['prog'];
     $sql4="SELECT * FROM Users WHERE Username='".$messmanagerusername2."'";

     if ($conn->query($sql4)->num_rows >0) {
       $message = "Username Exists";
       echo "<script type='text/javascript'>alert('$message');</script>";
     }else{
     $sql3 = "INSERT INTO Users (Username,Password,RollNumber,Name,HostelReside,HostelSubscribed,HostelNew,Program,Designation) VALUES ('".$messmanagerusername2."','".$messmanagerpassword2."','".$roll2."','".$messmanagername2."','".$hostelres2."','".$hostelsub2."','-','".$prog2."','student')";
     if ($conn->query($sql3) === TRUE) {
       header("Location: updateusers.php");
     }
   }

   }
 ?>

</div>
<div class="col-lg-2"></div>
</div>
</div>

<br><br>



<?php endblock() ?>
