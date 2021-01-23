<?php

session_start();
if(! isset($_SESSION['is_login']))
{
  header('location:index.php');
}

include_once 'config/Database.php';
include_once 'class/RecordsGamas.php';

$database = new Database();
$db = $database->getConnection();

$record = new Records($db);
$now = new DateTime();


if(!empty($_POST['action']) && $_POST['action'] == 'listRecords') {
	$record->listRecords();
}
if(!empty($_POST['action']) && $_POST['action'] == 'addRecord') {	
	$record->id = $_POST["id"];
	$record->brand = $_POST["brand"];
	$record->product = $_POST["product"];
	$date = date("Y-m-d H:i:s", strtotime($_POST["start"]));
	$record->start = $date;
	$date1 = date("Y-m-d H:i:s", strtotime($_POST["end"]));
	$record->end = $date1;
	$date2=date_create($date);
	$date3=date_create($date1);
	$diff=date_diff($date2,$date3);
	$record->duration = $diff->format("%D hari %H jam %I menit");
	$record->problem = $_POST["problem"];
	$record->escalation = $_POST["escalation"];
	$record->agent = $_SESSION['name'];
	$record->addRecord();
}
if(!empty($_POST['action']) && $_POST['action'] == 'getRecord') {
	$record->id = $_POST["id"];
	$record->getRecord();
}
if(!empty($_POST['action']) && $_POST['action'] == 'updateRecord') {
	$record->id = $_POST["id"];
	$record->brand = $_POST["brand"];
	$record->product = $_POST["product"];
	$date = date("Y-m-d H:i:s", strtotime($_POST["start"]));
	$record->start = $date;
	$date1 = date("Y-m-d H:i:s", strtotime($_POST["end"]));
	$record->end = $date1;
	$date2=date_create($date);
	$date3=date_create($date1);
	$diff=date_diff($date2,$date3);
	$record->duration = $diff->format("%D hari %H jam %I menit");
	$record->problem = $_POST["problem"];
	$record->escalation = $_POST["escalation"];
	$record->agent = $_SESSION['name'];
	$record->updateRecord();
}
if(!empty($_POST['action']) && $_POST['action'] == 'deleteRecord') {
	$record->id = $_POST["id"];
	$record->deleteRecord();
}
?>