<?php

session_start();
if(! isset($_SESSION['is_login']))
{
  header('location:index.php');
}

include_once 'config/Database.php';
include_once 'class/Records.php';

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
	$record->company = $_POST["company"];
	$record->product = $_POST["product"];
	$record->invoice = $_POST["invoice"];
	$record->price = $_POST["price"];
	$record->sow = $_POST["sow"];
	$record->agent = $_SESSION['name'];
	$record->sales = $_POST["sales"];
	$record->start = $_POST["start"];
	$record->finish = $_POST["finish"];
	$record->status = $_POST["status"];
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
	$record->company = $_POST["company"];
	$record->product = $_POST["product"];
	$record->invoice = $_POST["invoice"];
	$record->price = $_POST["price"];
	$record->sow = $_POST["sow"];
	$record->agent = $_SESSION['name'];
	$record->sales = $_POST["sales"];
	$record->start = $_POST["start"];
	$record->finish = $_POST["finish"];
	$record->status = $_POST["status"];
	$record->logs_date = $now->format('Y-m-d');
	$record->updateRecord();
}
if(!empty($_POST['action']) && $_POST['action'] == 'detailRecord') {
	$record->id = $_POST["id"];
	$record->no_ticket = $_POST["no_ticket"];
	$record->company = $_POST["company"];
	$record->product = $_POST["product"];
	$record->invoice = $_POST["invoice"];
	$record->price = $_POST["price"];
	$record->sow = $_POST["sow"];
	$record->agent = $_SESSION['name'];
	$record->sales = $_POST["sales"];
	$record->start = $_POST["start"];
	$record->finish = $_POST["finish"];
	$record->status = $_POST["status"];
	$record->logs_date = $now->format('Y-m-d');
	$record->updateRecord();
}
if(!empty($_POST['action']) && $_POST['action'] == 'deleteRecord') {
	$record->id = $_POST["id"];
	$record->deleteRecord();
}
?>