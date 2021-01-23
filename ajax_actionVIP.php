<?php

session_start();
if(! isset($_SESSION['is_login']))
{
  header('location:index.php');
}

include_once 'config/Database.php';
include_once 'class/RecordsVIP.php';

$database = new Database();
$db = $database->getConnection();

$record = new Records($db);
$now = new DateTime();


if(!empty($_POST['action']) && $_POST['action'] == 'listRecords') {
	$record->listRecords();
}
if(!empty($_POST['action']) && $_POST['action'] == 'addRecord') {	
	$record->id = $_POST["id"];
	$record->company = $_POST["company"];
  $record->product = $_POST["product"];
  $record->account = $_POST["account"];
  $record->customer = $_POST["customer"];
  $record->sales = $_POST["sales"];
  $record->email = $_POST["email"];
  $record->phone = $_POST["phone"];
  $record->agent = $_SESSION['name'];
  $record->logs_date = $now->format('Y-m-d');
	$record->addRecord();
}
if(!empty($_POST['action']) && $_POST['action'] == 'getRecord') {
	$record->id = $_POST["id"];
	$record->getRecord();
}
if(!empty($_POST['action']) && $_POST['action'] == 'updateRecord') {
	$record->id = $_POST["id"];
	$record->company = $_POST["company"];
  $record->product = $_POST["product"];
  $record->account = $_POST["account"];
  $record->customer = $_POST["customer"];
  $record->sales = $_POST["sales"];
  $record->email = $_POST["email"];
  $record->phone = $_POST["phone"];
  $record->agent = $_SESSION['name'];
  $record->logs_date = $now->format('Y-m-d');
	$record->updateRecord();
}
if(!empty($_POST['action']) && $_POST['action'] == 'deleteRecord') {
	$record->id = $_POST["id"];
	$record->deleteRecord();
}
?>