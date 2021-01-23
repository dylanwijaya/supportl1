<?php 
session_start();
if(! isset($_SESSION['is_login']))
{
  header('location:index.php');
}
?>
<html>
 <head>
  <title>Upsale L1</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.23/datatables.min.css"/>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.23/datatables.min.js"></script>
  <script src="js/ajaxGamas.js"></script>	
 

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
          <a class="dropdown-item" href="upsale.php">Upsale</a>
          <a class="dropdown-item" href="#">Manage Support</a>
          <a class="dropdown-item" href="#">Monthly Report</a>
		  <a class="dropdown-item" href="handover.php">Handover</a>
		  <a class="dropdown-item" href="#">List Gamas</a>
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
   <h1 align="center">List Gangguan Massal</h1>
   <br /><br />
			
		<div class="panel-heading">
			<div class="row">
				<div class="col-md-10">
					<h3 class="panel-title"></h3>
				</div>
				<div class="col-md-2" align="right" style="margin-bottom:1rem">
					<button type="button" name="add" id="addRecord" class="btn btn-success">Add New Record</button>
				</div>
			</div>
		</div>
		<table id="recordListing" class="table table-bordered table-striped table-sm" style="width:100%">
			<thead>
				<tr>
					<th>Brand</th>					
					<th>Product</th>					
          <th>Start</th>	
          <th>End</th>	
          <th>Duration</th>
          <th>Problem</th>
          <th>Escalation</th>
					<th>Action</th>			
				</tr>
			</thead>
		</table>
	
	<div id="recordModal" class="modal fade">
    	<div class="modal-dialog">
		<form method="post" id="recordForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">Edit Record</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
    				
					<div class="modal-body">
            <div class="form-group">
							<label for="brand">Brand</label>
							<select id="brand" name="brand" class="form-control">
								<option value="NEO">NEO</option>
								<option value="GIO">GIO</option>
							</select>
						</div>
						<div class="form-group">
							<label for="product" class="control-label">Product</label>
							<input type="text" class="form-control" id="product" name="product" placeholder="Product" required>			
            </div>	   	
            <div class="form-group">
							<label for="start" class="control-label">Start Time</label>
							<input type="datetime-local" class="form-control" id="start" name="start">			
            </div>
            <div class="form-group">
							<label for="end" class="control-label">Finish Time</label>
							<input type="datetime-local" class="form-control" id="end" name="end" placeholder="Finish Date">			
						</div>
						<div class="form-group">
							<label for="problem" class="control-label">Problem</label>
							<input type="text" class="form-control" id="problem" name="problem" placeholder="Problem" required>			
            </div>	
            <div class="form-group">
							<label for="escalation" class="control-label">Escalation</label>
							<input type="number" class="form-control" id="escalation" name="escalation" placeholder="Problem" required>			
            </div>	
   				</div>
    				<div class="modal-footer">
						<input type="hidden" name="id" id="id" />
    					<input type="hidden" name="action" id="action" value="" />
    					<input type="submit" name="save" id="save" class="btn btn-info" value="Save" />
    					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				</div>
    			</div>
    		</form>
    	</div>
	</div>
	

</div>	
<div class="copyright">
    <p>Dibuat oleh Dylan 2021</p>
</div>
</body>
</html>