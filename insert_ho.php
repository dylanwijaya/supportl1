<?php
$connect = mysqli_connect("localhost", "root", "", "testing");

session_start();
if(! isset($_SESSION['is_login']))
{
  header('location:index.php');
}

$now = new DateTime();
$now->format('Y-m-d');
if(isset($_POST["no_ticket"], $_POST["department"], $_POST["product"], $_POST["description"], $_POST["last_update"], $_POST["status"], $_POST["priority"]))
{
 $no_ticket = mysqli_real_escape_string($connect, $_POST["no_ticket"]);
 $department = mysqli_real_escape_string($connect, $_POST["department"]);
 $product = mysqli_real_escape_string($connect, $_POST["product"]);
 $description = mysqli_real_escape_string($connect, $_POST["description"]);
 $last_update = mysqli_real_escape_string($connect, $_POST["last_update"]);
 $status = mysqli_real_escape_string($connect, $_POST["status"]);
 $priority = mysqli_real_escape_string($connect, $_POST["priority"]);
 $logs_agent = mysqli_real_escape_string($connect, $_SESSION['name']);
 $date = mysqli_real_escape_string($connect, $now->format('Y-m-d'));
 $query = "INSERT INTO handover(no_ticket, department, product, description, last_update, status, priority, logs_agent, date) VALUES('$no_ticket', '$department', '$product', '$description', '$last_update', '$status', '$priority', '$logs_agent', '$date')";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Inserted';
 }
}
?>