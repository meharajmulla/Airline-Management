<?php
session_start();

if (empty($_SESSION['datee']))
{
    $date = date("Ym", strtotime("-1 months"));
    $_SESSION['datee']=$date;
    header("Location: mymess.php");
    exit(0);
}
else{
  header("Location: mymess.php");
}

?>
