<?php
class Records {	
   
	private $recordsTable = 'manage_support';
	public $now = new DateTime();
	$now->format('Y-m-d');
	public $id;
	public $no_ticket;
    public $company;
    public $product;
    public $invoice;
	public $sow;
	public $agent;
	public $sales;
	public $start;
	public $finish;
	public $status;
	public $logs_date;
	private $conn;
	
	public function __construct($db){
        $this->conn = $db;
    }	    
	
	public function listRecords(){
		
		$sqlQuery = "SELECT * FROM ".$this->recordsTable." ";
		if(!empty($_POST["search"]["value"])){
			$sqlQuery .= 'where(id LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR no_ticket LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR company LIKE "%'.$_POST["search"]["value"].'%" ';			
			$sqlQuery .= ' OR product LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR invoice LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR sow LIKE "%'.$_POST["search"]["value"].'%") ';	
			$sqlQuery .= ' OR agent LIKE "%'.$_POST["search"]["value"].'%") ';		
			$sqlQuery .= ' OR sales LIKE "%'.$_POST["search"]["value"].'%") ';
			$sqlQuery .= ' OR start LIKE "%'.$_POST["search"]["value"].'%") ';
			$sqlQuery .= ' OR end LIKE "%'.$_POST["search"]["value"].'%") ';
			$sqlQuery .= ' OR status LIKE "%'.$_POST["search"]["value"].'%") ';
			$sqlQuery .= ' OR logs_date LIKE "%'.$_POST["search"]["value"].'%") ';
		}
		
		if(!empty($_POST["order"])){
			$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		} else {
			$sqlQuery .= 'ORDER BY id DESC ';
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
			$rows[] = $record['id'];
			$rows[] = ucfirst($record['no_ticket']);
			$rows[] = $record['company'];		
			$rows[] = $record['product'];	
			$rows[] = $record['invoice'];
			$rows[] = $record['sow'];
			$rows[] = $record['agent'];
			$rows[] = $record['sales'];
			$rows[] = $record['start'];
			$rows[] = $record['finish'];
			$rows[] = $record['status'];	
			$rows[] = $record['logs_date'];				
			$rows[] = '<center><button type="button" name="update" id="'.$record["id"].'" class="btn btn-warning btn-sm update" style="margin-right:1rem">Update</button><button type="button" name="delete" id="'.$record["id"].'" class="btn btn-danger btn-sm delete" >Delete</button></center>';
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
			SET no_ticket= ?, company = ?, product = ?, invoice = ?, sow = ?, agent = ?, sales = ?, start = ?, finish = ?, status = ?, logs_date = ?
			WHERE id = ?");
	 
			$this->id = htmlspecialchars(strip_tags($this->id));
			$this->no_ticket = htmlspecialchars(strip_tags($this->no_ticket));
			$this->company = htmlspecialchars(strip_tags($this->company));
			$this->product = htmlspecialchars(strip_tags($this->product));
			$this->invoice = htmlspecialchars(strip_tags($this->invoice));
			$this->sow = htmlspecialchars(strip_tags($this->sow));
			$this->agent = htmlspecialchars(strip_tags($this->agent));
			$this->sales = htmlspecialchars(strip_tags($this->sales));
			$this->start = htmlspecialchars(strip_tags($this->start));
			$this->finish = htmlspecialchars(strip_tags($this->finish));
			$this->status = htmlspecialchars(strip_tags($this->status));
			$this->logs_date = htmlspecialchars(strip_tags($this->logs_date));

			
			$stmt->bind_param("sisssi", $this->no_ticket, $this->company, $this->product, $this->invoice, $this->sow, $this->agent, $this->sales, $this->start, $this->finish, $this->status, $this->logs_date);
			
			if($stmt->execute()){
				return true;
			}
			
		}	
	}
	public function addRecord(){
		
		if($this->no_ticket) {

			$stmt = $this->conn->prepare("
			INSERT INTO ".$this->recordsTable."(`no_ticket`, `company`, `product`, `invoice`, `sow`, `agent`, `sales`, `start`, `finish`, `status`, `logs_date`)
			VALUES(?,?,?,?,?,?,?,?,?,?,?)");

			$this->no_ticket = htmlspecialchars(strip_tags($this->no_ticket));
			$this->company = htmlspecialchars(strip_tags($this->company));
			$this->product = htmlspecialchars(strip_tags($this->product));
			$this->invoice = htmlspecialchars(strip_tags($this->invoice));
			$this->sow = htmlspecialchars(strip_tags($this->sow));
			$this->agent = htmlspecialchars(strip_tags($this->agent));
			$this->sales = htmlspecialchars(strip_tags($this->sales));
			$this->start = htmlspecialchars(strip_tags($this->start));
			$this->sales = htmlspecialchars(strip_tags($this->sales));
			$this->start = htmlspecialchars(strip_tags($this->start));
			$this->finish = htmlspecialchars(strip_tags($this->finish));
			$this->status = htmlspecialchars(strip_tags($this->status));
			$this->logs_date = $now;
			
			$stmt->bind_param("sisssi", $this->no_ticket, $this->company, $this->product, $this->invoice, $this->sow, $this->agent, $this->sales, $this->start, $this->finish, $this->status, $this->logs_date);

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