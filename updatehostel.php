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

$sql = "SELECT * FROM Hostels";
$result = $conn->query($sql);
$i=0;
?>


<div class="container-fluid">
        <div class="row">
          <div class="col-lg-2"></div>
          <div class="col align-self-center">
            <br><br><br>


  <form action="updatehostel.php" method="post">
    <div class="card">
      <div class="card-header">
        Add Hostel
      </div>
      <div class="card-body">

      <p><input class="form-control" name='hname' placeholder="Hostel Name" type="text" size="20" required/></p>
      <p><input class="form-control" name='messmanagerusername' placeholder="Username" type="text" size="50" required/></p>
      <p><input class="form-control" name='messmanagerpassword' placeholder="Password" type="password" size="50" required/></p>
      <p><input class="form-control" name='messmanagername' placeholder="Name" type="text" size="50" required/></p>
      <p><input class="form-control" name='messmanagercontact' placeholder="Contact Number" type="number" size="20" required/></p>
        <input class="btn btn-primary " name="add" type="submit" value="Add Hostel"/>
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
                <?php echo $row["Name"] ?>
             </button>
           </h2>
         </div>

         <div id="collapse<?php  print $i ?>" class="collapse" aria-labelledby="heading<?php  print $i ?>" data-parent="#accordionExample">
           <div class="card-body">
             <form action="updatehostel.php" method="post">
               <?php
                $temphname=$row['Name'];
                $tempusername=$row['MessManagerUsername'];
                $tempname=$row['MessManagerName'];
                $tempcontact=$row['MessManagerContactNumber'];
               ?>
               <label >Hostel Name</label>
               <p><input class="form-control" name='hname<?php  print $i ?>' placeholder="Hostel Name" type="text" size="20" value=<?php echo $temphname ?> readonly/></p>
               <label >Username</label>
             <p><input class="form-control" name='messmanagerusername<?php  print $i ?>' placeholder="Username" type="text" size="50" value=<?php echo $tempusername ?> required/></p>
              <label >Full Name</label>
             <p><input class="form-control" name='messmanagername<?php  print $i ?>' placeholder="Name" type="text" size="50" value="<?php echo $tempname ?>" required/></p>
             <label >Contact Number</label>
             <p><input class="form-control" name='messmanagercontact<?php  print $i ?>' placeholder="Contact Number" type="number" size="20" value=<?php echo $tempcontact ?> required/></p>
             <input class="btn btn-primary" name="update<?php  print $i ?>" type="submit" value="Update"/>
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
     if(isset($_POST['update'.$j])){
       $hname=$_POST['hname'.$j];
       $messmanagerusername=$_POST['messmanagerusername'.$j];
       $messmanagername=$_POST['messmanagername'.$j];
       $messmanagercontact=$_POST['messmanagercontact'.$j];
       $sql2 = "UPDATE Hostels SET MessManagerUsername='".$messmanagerusername."', MessManagerName='".$messmanagername."', MessManagerContactNumber='".$messmanagercontact."' WHERE Name='".$hname."'";
       if ($conn->query($sql2) === TRUE) {
           header("Location: updatehostel.php");
       }


     }
     $j=$j+1;
   }

   if(isset($_POST['add'])){
     $hname2=$_POST['hname'];
     $messmanagerusername2=$_POST['messmanagerusername'];
     $messmanagerpassword2=md5($_POST['messmanagerpassword']);
     $messmanagername2=$_POST['messmanagername'];
     $messmanagercontact2=$_POST['messmanagercontact'];
     $sql4="SELECT * FROM Hostels WHERE MessManagerUsername='".$messmanagerusername2."'";

     if ($conn->query($sql4)->num_rows >0) {
       $message = "Username Exists";
       echo "<script type='text/javascript'>alert('$message');</script>";
     }
     else{
     $sql3 = "INSERT INTO Hostels (Name,MessManagerUsername,MessManagerPassword,MessManagerName,MessManagerContactNumber) VALUES ('".$hname2."','".$messmanagerusername2."','".$messmanagerpassword2."','".$messmanagername2."','".$messmanagercontact2."')";
     if ($conn->query($sql3) === TRUE) {
       header("Location: updatehostel.php");
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
