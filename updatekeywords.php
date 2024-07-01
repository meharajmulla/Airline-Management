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

$sql = "SELECT * FROM Keywords";
$result = $conn->query($sql);
$i=0;
?>

<div class="container-fluid">
        <div class="row">
          <div class="col-lg-2"></div>
          <div class="col align-self-center">
<br><br><br>


  <form action="updatekeywords.php" method="post">
    <div class="card">
      <div class="card-header">
        Add Keyword
      </div>
      <div class="card-body">
      <p><input class="form-control" name='key' placeholder="KeyName" type="text" size="50" required/></p>
      <p><input class="form-control" name='val' placeholder="Value" type="number" size="10" required/></p>
        <input class="btn btn-primary " name="add" type="submit" value="Add Keyword"/>
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
                <?php echo $row["KeyName"] ?>
             </button>
           </h2>
         </div>

         <div id="collapse<?php  print $i ?>" class="collapse" aria-labelledby="heading<?php  print $i ?>" data-parent="#accordionExample">
           <div class="card-body">
             <form action="updatekeywords.php" method="post">
               <?php
                $tempkey=$row["KeyName"];
                $tempval=$row['Value'];
               ?>
               <label >KeyName</label>
               <p><input class="form-control" name='key<?php  print $i ?>' placeholder="Keyword" type="text" size="50" value="<?php echo $tempkey?>" readonly/></p>
               <label >Value</label>
               <p><input class="form-control" name='value<?php  print $i ?>' placeholder="Value" type="number" size="10" value="<?php echo $tempval?>" required/></p>
                <input class="btn btn-primary " name="delete<?php  print $i ?>" type="submit" value="Delete Keyword"/>
                <input class="btn btn-primary " name="update<?php  print $i ?>" type="submit" value="Update Keyword"/>
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
       $key=$_POST['key'.$j];
       $val=$_POST['value'.$j];
       echo $val;
       $sql2 = "DELETE FROM Keywords WHERE KeyName='".$key."'";
       if ($conn->query($sql2) === TRUE) {
           header("Location: updatekeywords.php");
       }


     }
     if(isset($_POST['update'.$j])){
       $key3=$_POST['key'.$j];
       $val3=$_POST['value'.$j];
       $sql5 = "UPDATE Keywords SET Value='".$val3."' WHERE KeyName='".$key3."'";
       if ($conn->query($sql5) === TRUE) {
           header("Location: updatekeywords.php");
       }


     }

     $j=$j+1;
   }

   if(isset($_POST['add'])){
     $key2=strtolower($_POST['key']);
     $val2=$_POST['val'];
     if($val2 >= -5 && $val2 <=5)
     {
     $sql4="SELECT * FROM Keywords WHERE KeyName='".$key2."'";

     if ($conn->query($sql4)->num_rows >0) {
       $message = "KeyWord Exists";
       echo "<script type='text/javascript'>alert('$message');</script>";
     }else{
     $sql3 = "INSERT INTO Keywords (KeyName,Value) VALUES ('".$key2."','".$val2."')";
     if ($conn->query($sql3) === TRUE) {
       header("Location: updatekeywords.php");
     }
   }
}
else{
  $message = "Value must be between -5 and 5";
  echo "<script type='text/javascript'>alert('$message');</script>";
}
   }
 ?>

</div>
<div class="col-lg-2"></div>
</div>
</div>
<br><br>



<?php endblock() ?>
