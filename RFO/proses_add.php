<?php 
include 'koneksi.php';

session_start();
if(! isset($_SESSION['is_login']))
{
  header('location:index.php');
}

$now = new DateTime();
$logs_date = $now->format('Y-m-d');

if($_POST['upload']){

    $id = $_POST['id'];
    $no_ticket = $_POST['no_ticket'];
    $product = $_POST['product'];
    $account = $_POST['account'];
    $company = $_POST['company'];
    $subject = $_POST['subject'];
    $incident = $_POST['incident'];
    $agent = $_SESSION['name'];
    

	$ekstensi_diperbolehkan	= array('png','jpg');
	$nama = $_FILES['file']['name'];
	$x = explode('.', $nama);
	$ekstensi = strtolower(end($x));
	$ukuran	= $_FILES['file']['size'];
	$file_tmp = $_FILES['file']['tmp_name'];	

	if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
		if($ukuran < 10440700){			
            move_uploaded_file($file_tmp, 'file/'.$nama);
            
			$query = mysqli_query($koneksi, "INSERT INTO rfo VALUES(NULL, '$no_ticket', '$product', '$account','$company', '$subject', '$incident', '$nama', '$agent', '$logs_date')");
			if($query){
				header('Location: ../rfo.php');
			}else{
				echo 'GAGAL MENGUPLOAD GAMBAR';
			}
		}else{
			echo 'UKURAN FILE TERLALU BESAR';
		}
	}else{
		echo 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
	}
}
?>