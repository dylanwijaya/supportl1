<?php

session_start();
if(! isset($_SESSION['is_login']))
{
  header('location:index.php');
}

include_once 'config/Database.php';
include_once 'class/RecordsRFO.php';

$database = new Database();
$db = $database->getConnection();

$record = new Records($db);
$now = new DateTime();


if(!empty($_POST['action']) && $_POST['action'] == 'listRecords') {
	$record->listRecords();
}
if(!empty($_POST['action']) && $_POST['action'] == 'addRecord') {	
  $record->id = $_POST["id"];
  $record->no_ticket = $_POST["no_ticket"];
  $record->product = $_POST["product"];
  $record->account = $_POST["account"];
  $record->company = $_POST["company"];
  $record->subject = $_POST["subject"];
  $record->incident = $_POST["incident"];
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
    $record->no_ticket = $_POST["no_ticket"];
    $record->product = $_POST["product"];
    $record->account = $_POST["account"];
    $record->company = $_POST["company"];
    $record->subject = $_POST["subject"];
    $record->incident = $_POST["incident"];
    $record->file = $_POST["file"];
    $record->agent = $_SESSION['name'];
    $record->logs_date = $now->format('Y-m-d');
	$record->updateRecord();
}
if(!empty($_POST['action']) && $_POST['action'] == 'deleteRecord') {
	$record->id = $_POST["id"];
	$record->deleteRecord();
}
?>