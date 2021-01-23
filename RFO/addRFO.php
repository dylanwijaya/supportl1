<?php 

error_reporting(E_ALL ^ E_WARNING);

include 'koneksi.php';

session_start();
if(! isset($_SESSION['is_login']))
{
  header('location:index.php');
}

?>
<html>
 <head>
  <title>RFO & RCA</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.23/datatables.min.css"/>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.23/datatables.min.js"></script>
  <script src="js/ajaxRFO.js"></script>	
 

  <style>
  body
  {
   margin:0;
   padding:0;
   background-color:#f1f1f1;
  }
  .box
  {
   width:1300px;
   padding:20px;
   background-color:#fff;
   border:1px solid #ccc;
   border-radius:5px;
   margin-top:25px;
   box-sizing:border-box;
  }
  .copyright {
    text-align: center;
    padding: 1rem;
  }
  </style>

</head>
 <body>

 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">
    <img src="img/bgn-bw.svg" height="40" alt="" >
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="#">Home </a>
      </li>
      <li class="nav-item "> 
        <a class="nav-link" href="#">Statistics</a><span class="sr-only">(current)</span>
      </li>
      <li class="nav-item dropdown ">
        <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Sharepoints
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Upsale</a>
          <a class="dropdown-item" href="#">Manage Support</a>
          <a class="dropdown-item" href="#">Monthly Report</a>
		  <a class="dropdown-item" href="handover.php">Handover</a>
		  <a class="dropdown-item" href="list_gamas.php">List Gamas</a>
          <a class="dropdown-item" href="list_vip.php">List VIP Customer</a>
          <a class="dropdown-item" href="../rfo.php">RFO List</a>
        </div>
      </li>
      <li class="nav-item"> 
        <a class="nav-link" href="#">About</a>
      </li>
    </ul>
    <a href="logout.php" class="form-inline my-2 my-lg-0 btn btn-secondary">Logout</a>
  </div>
</nav>

<div class="container box">	
   <h1 align="center">RFO & RCA</h1>
   <br /><br />

<?php

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
    

	$ekstensi_diperbolehkan	= array('docx','pdf');
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
				echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Oops!</strong> Upload Gambar Gagal
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
			}
		}else{
			echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Oops!</strong> Ukuran file terlalu besar
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
		}
	}else{
		echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Oops!</strong> Ekstensi filenya tidak diperbolehkan
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
	}
}
?>
			<form action="addRFO.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">Add Record</h4>
                    </div>
    				
					<div class="modal-body">
						<div class="form-group">
							<label for="no_ticket" class="control-label">Ticket Number</label>							
							<input type="number" class="form-control" id="no_ticket" name="no_ticket" placeholder="Ticket Number...">							
						</div>
						<div class="form-group">
							<label for="product" class="control-label">Product</label>
							<input type="text" class="form-control" id="product" name="product" placeholder="Product" required>			
						</div>	   	
						<div class="form-group">
							<label for="account" class="control-label">Account</label>
							<input type="text" class="form-control" id="account" name="account" placeholder="Account ID" required>			
						</div>
						<div class="form-group">
							<label for="company" class="control-label">Company</label>							
							<input type="text" class="form-control" id="company" name="company" placeholder="Company...">							
            </div>
            <div class="form-group">
							<label for="subject" class="control-label">Gamas Description</label>							
							<input type="text" class="form-control" id="subject" name="subject" placeholder="Gamas Description...">							
            </div>
            <div class="form-group">
							<label for="incident" class="control-label">Incident Date</label>							
							<input type="date" class="form-control" id="incident" name="incident">							
            </div>
            <div class="form-group">
              <label for="file">Example file input</label>
              <input type="file" class="form-control-file" id="file" name="file">
            </div>
						
   				</div>
    				<div class="modal-footer">
						<input type="hidden" name="id" id="id" />
                        <input type="submit" name="upload" class="btn btn-secondary" value="Upload">
    					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				</div>
    			</div>
    		</form>
	</div>
	

</div>	
<div class="copyright">
    <p>Dibuat oleh Dylan 2021</p>
</div>
</body>
</html>