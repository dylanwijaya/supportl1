<?php
$connect = mysqli_connect("localhost", "root", "", "testing");

session_start();
if(! isset($_SESSION['is_login']))
{
  header('location:index.php');
}

$now = new DateTime();
$now->format('Y-m-d');
if(isset($_POST["id"]))
{
 $value = mysqli_real_escape_string($connect, $_POST["value"]);
 $query = "UPDATE handover SET ".$_POST["column_name"]."='".$value."', `date`='".$now->format('Y-m-d')."', `logs_agent`='".$_SESSION['name']."' WHERE id = '".$_POST["id"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Updated';
 }
}
?>