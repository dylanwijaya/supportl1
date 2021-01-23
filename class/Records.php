<?php
class Records {	
   
	private $recordsTable = 'live_records';
	public $id;
	public $no_ticket;
    public $company;
    public $product;
	public $invoice;
	public $price;
	public $sow;
	public $agent;
	public $sales;
	public $start;
	public $finish;
	public $status;

	private $conn;
	
	public function __construct($db){
        $this->conn = $db;
    }	    
	

	public function listRecords(){
		
		$sqlQuery = "SELECT * FROM ".$this->recordsTable." ";
		if(!empty($_POST["search"]["value"])){
			$sqlQuery .= 'where(no_ticket LIKE "%'.$_POST["search"]["value"].'%" ';			
			$sqlQuery .= ' OR sow LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR company LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR product LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR invoice LIKE "%'.$_POST["search"]["value"].'%" ';			
			$sqlQuery .= ' OR price LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR agent LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR sales LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR start LIKE "%'.$_POST["search"]["value"].'%" ';	
			$sqlQuery .= ' OR finish LIKE "%'.$_POST["search"]["value"].'%" ';		
			$sqlQuery .= ' OR status LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR sow LIKE "%'.$_POST["search"]["value"].'%") ';
			
		}
		
		if(!empty($_POST["order"])){
			$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		} else {
			$sqlQuery .= 'ORDER BY start DESC ';
		}
		
		if($_POST["length"] != -1){
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}
		
		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();	
		
		$stmtTotal = $this->conn->prepare("SELECT * FROM ".$this->recordsTable);
		$stmtTotal->execute();
		$allResult = $stmtTotal->get_result();
		$allRecords = $allResult->num_rows;
		
		$displayRecords = $result->num_rows;
		$records = array();		
		while ($record = $result->fetch_assoc()) { 				
			$rows = array();			
			$rows[] = '<small>'.$record['no_ticket'].'</small>';
			$rows[] = '<small>'.$record['company'].'</small>';		
			$rows[] = '<small>'.$record['product'].'</small>';	
			$rows[] = '<small>'.$record['invoice'].'</small>';
			$rows[] = '<small>'.$record['price'].'</small>';
			$rows[] = '<small>'.$record['agent'].'</small>';
			$rows[] = '<small>'.$record['sales'].'</small>';
			$rows[] = '<small>'.$record['start'].'</small>';
			$rows[] = '<small>'.$record['finish'].'</small>';
			$rows[] = '<small>'.$record['status'].'</small>';
									
			$rows[] = '<center> <div class="btn-group" role="group" aria-label="Basic example"><button type="button" name="info" id="'.$record["id"].'" class="btn btn-info btn-sm info">Info</button> <button type="button" name="update" id="'.$record["id"].'" class="btn btn-warning btn-sm update">Update</button><button type="button" name="delete" id="'.$record["id"].'" class="btn btn-danger btn-sm delete" >Delete</button> </div></center>';
			
			$records[] = $rows;
		}
		
		$output = array(
			"draw"	=>	intval($_POST["draw"]),			
			"iTotalRecords"	=> 	$displayRecords,
			"iTotalDisplayRecords"	=>  $allRecords,
			"data"	=> 	$records
		);
		
		echo json_encode($output);
	}
	
	public function getRecord(){
		if($this->id) {
			$sqlQuery = "
				SELECT * FROM ".$this->recordsTable." 
				WHERE id = ?";			
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->bind_param("i", $this->id);	
			$stmt->execute();
			$result = $stmt->get_result();
			$record = $result->fetch_assoc();
			echo json_encode($record);
		}
	}
	public function updateRecord(){
		
		if($this->id) {			
			
			$stmt = $this->conn->prepare("
			UPDATE ".$this->recordsTable." 
			SET no_ticket= ?, company = ?, product = ?, invoice = ?, price = ?, sow = ?, agent = ?, sales = ?, start = ?, finish = ?, status = ?, logs_date = ?
			WHERE id = ?");
	 
			$this->id = htmlspecialchars(strip_tags($this->id));
			$this->no_ticket = htmlspecialchars(strip_tags($this->no_ticket));
			$this->company = htmlspecialchars(strip_tags($this->company));
			$this->product = htmlspecialchars(strip_tags($this->product));
			$this->invoice = htmlspecialchars(strip_tags($this->invoice));
			$this->price = htmlspecialchars(strip_tags($this->price));
			$this->sow = htmlspecialchars(strip_tags($this->sow));
			$this->agent = htmlspecialchars(strip_tags($this->agent));
			$this->sales = htmlspecialchars(strip_tags($this->sales));
			$this->start = htmlspecialchars(strip_tags($this->start));
			$this->finish = htmlspecialchars(strip_tags($this->finish));
			$this->status = htmlspecialchars(strip_tags($this->status));
			$this->logs_date = htmlspecialchars(strip_tags($this->logs_date));
			
			
			$stmt->bind_param("ssssssssssssi", $this->no_ticket, $this->company, $this->product, $this->invoice, $this->price, $this->sow, $this->agent, $this->sales, $this->start, $this->finish, $this->status, $this->logs_date , $this->id);
			
			if($stmt->execute()){
				return true;
			}
			
		}	
	}
	public function detailRecord(){
		
		if($this->id) {			
			
			
		}	
	}
	public function addRecord(){
		
		if($this->no_ticket) {

			$stmt = $this->conn->prepare("
			INSERT INTO ".$this->recordsTable."(`no_ticket`, `company`, `product`, `invoice`, `price`, `sow`, `agent`, `sales`, `start`, `finish`, `status`, `logs_date`)
			VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");

			
			$this->id = htmlspecialchars(strip_tags($this->id));
			$this->no_ticket = htmlspecialchars(strip_tags($this->no_ticket));
			$this->company = htmlspecialchars(strip_tags($this->company));
			$this->product = htmlspecialchars(strip_tags($this->product));
			$this->invoice = htmlspecialchars(strip_tags($this->invoice));
			$this->price = htmlspecialchars(strip_tags($this->price));
			$this->sow = htmlspecialchars(strip_tags($this->sow));
			$this->agent = htmlspecialchars(strip_tags($this->agent));
			$this->sales = htmlspecialchars(strip_tags($this->sales));
			$this->start = htmlspecialchars(strip_tags($this->start));
			$this->finish = htmlspecialchars(strip_tags($this->finish));
			$this->status = htmlspecialchars(strip_tags($this->status));
			$this->logs_date = htmlspecialchars(strip_tags($this->logs_date));
			
			$stmt->bind_param("isssssssssss", $this->no_ticket, $this->company, $this->product, $this->invoice, $this->price, $this->sow, $this->agent, $this->sales, $this->start, $this->finish, $this->status, $this->logs_date);

			if($stmt->execute()){
				return true;
			}		
		}
	}
	public function deleteRecord(){
		if($this->id) {			

			$stmt = $this->conn->prepare("
				DELETE FROM ".$this->recordsTable." 
				WHERE id = ?");

			$this->id = htmlspecialchars(strip_tags($this->id));

			$stmt->bind_param("i", $this->id);

			if($stmt->execute()){
				return true;
			}
		}
	}
}
?>