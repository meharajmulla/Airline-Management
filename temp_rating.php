<?php
session_start();

if (empty($_SESSION['datee']))
{
    $date = date("Ym", strtotime("-1 months"));
    $_SESSION['datee']=$date;
    header("Location: viewratings.php");
    exit(0);
}
else{
  header("Location: viewratings.php");
}

?>
