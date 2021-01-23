<?php
$connect = mysqli_connect("localhost", "root", "", "testing");

session_start();
if(! isset($_SESSION['is_login']))
{
  header('location:index.php');
}

if(isset($_POST["no_ticket"], $_POST["product"], $_POST["company"], $_POST["kebutuhan"], $_POST["sales"], $_POST["tgl_fu"], $_POST["channel"]))
{
 $no_ticket = mysqli_real_escape_string($connect, $_POST["no_ticket"]);
 $product = mysqli_real_escape_string($connect, $_POST["product"]);
 $company = mysqli_real_escape_string($connect, $_POST["company"]);
 $kebutuhan = mysqli_real_escape_string($connect, $_POST["kebutuhan"]);
 $agent = mysqli_real_escape_string($connect, $_SESSION['name']);
 $sales = mysqli_real_escape_string($connect, $_POST["sales"]);
 $tgl_fu = mysqli_real_escape_string($connect, $_POST["tgl_fu"]);
 $channel = mysqli_real_escape_string($connect, $_POST["channel"]);
 $query = "INSERT INTO upsale(no_ticket, product, company, kebutuhan, agent, sales, tgl_fu, channel) VALUES('$no_ticket', '$product', '$company', '$kebutuhan', '$agent', '$sales', '$tgl_fu', '$channel')";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Inserted';
 }
}
?>