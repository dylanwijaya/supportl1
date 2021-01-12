<?php
$connect = mysqli_connect("localhost", "root", "", "testing");
if(isset($_POST["id"]))
{
 $query = "DELETE FROM upsale WHERE id = '".$_POST["id"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Deleted';
 }
}
?>