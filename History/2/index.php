<html>
 <head>
  <title>Manage Support L1</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.23/datatables.min.css"/>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.23/datatables.min.js"></script>
  <script src="js/ajax.js"></script>	
 </head>
 <body>


<div class="container contact">	
	<h2>Buat Manage Support</h2>	
			
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
					<th>id</th>
					<th>#</th>
					<th>Company</th>					
					<th>Product</th>					
					<th>Invoice No.</th>
					<th>SoW</th>
					<th>Agent</th>	
					<th>Sales</th>	
					<th>Start</th>
					<th>End</th>
					<th>Status</th>	
					<th>Logs Date</th>	
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
							<label for="no_ticket" class="control-label">Ticket Number</label>							
							<input type="number" class="form-control" id="no_ticket" name="no_ticket" placeholder="Ticket Number...">							
						</div>
						<div class="form-group">
							<label for="company" class="control-label">Company Name</label>
							<input type="text" class="form-control" id="company" name="company" placeholder="Company Name" required>			
						</div>
						<div class="form-group">
							<label for="product" class="control-label">Product</label>
							<input type="text" class="form-control" id="product" name="product" placeholder="Product" required>			
						</div>	   	
						<div class="form-group">
							<label for="invoice" class="control-label">Invoice Number</label>
							<input type="text" class="form-control" id="invoice" name="invoice" placeholder="Invoice Number" required>			
						</div>
						<div class="form-group">
							<label for="sow" class="control-label">SoW</label>							
							<textarea class="form-control" rows="5" id="sow" name="sow"></textarea>							
						</div>
						<div class="form-group">
							<label for="agent" class="control-label">Agent</label>
							<input type="text" class="form-control" id="agent" name="agent" placeholder="Agent" required>			
						</div>
						<div class="form-group">
							<label for="sales">Sales</label>
							<select id="sales" class="form-control">
								<option selected>Choose...</option>
								<option>Aisyah</option>
								<option>Putri</option>
								<option>Zuma</option>
							</select>
						</div>
						<div class="form-group">
							<label for="start" class="control-label">Start Date</label>
							<input type="date" class="form-control" id="start" name="start" placeholder="Start Date" required>			
						</div>
						<div class="form-group">
							<label for="finish" class="control-label">Finish Date</label>
							<input type="date" class="form-control" id="finish" name="finish" placeholder="Finish Date" required>			
						</div>
						<div class="form-group">
							<label for="status">Status</label>
							<select id="status" class="form-control">
								<option selected>Choose...</option>
								<option>On Progress</option>
								<option>On Hold</option>
							</select>
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
</body>
</html>