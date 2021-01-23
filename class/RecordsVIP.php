<?php
class Records {	
   
	private $recordsTable = 'list_vip';
	public $id;
    public $company;
    public $product;
	public $account;
	public $customer;
	public $sales;
	public $email;
	public $phone;
	
	private $conn;
	
	public function __construct($db){
        $this->conn = $db;
    }	    
	

	public function listRecords(){
		
		$sqlQuery = "SELECT * FROM ".$this->recordsTable." ";
		if(!empty($_POST["search"]["value"])){
			$sqlQuery .= 'where(company LIKE "%'.$_POST["search"]["value"].'%" ';			
			$sqlQuery .= ' OR product LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR account LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR customer LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR sales LIKE "%'.$_POST["search"]["value"].'%" ';			
			$sqlQuery .= ' OR email LIKE "%'.$_POST["search"]["value"].'%" ';
            $sqlQuery .= ' OR phone LIKE "%'.$_POST["search"]["value"].'%" ';
            $sqlQuery .= ' OR agent LIKE "%'.$_POST["search"]["value"].'%" ';
            $sqlQuery .= ' OR logs_date LIKE "%'.$_POST["search"]["value"].'%") ';
			
		}
		
		if(!empty($_POST["order"])){
			$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		} else {
			$sqlQuery .= 'ORDER BY company DESC ';
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
			$rows[] = '<small>'.$record['company'].'</small>';		
			$rows[] = '<small>'.$record['product'].'</small>';	
			$rows[] = '<small>'.$record['account'].'</small>';
			$rows[] = '<small>'.$record['customer'].'</small>';
			$rows[] = '<small>'.$record['sales'].'</small>';
			$rows[] = '<small>'.$record['email'].'</small>';
            $rows[] = '<small>'.$record['phone'].'</small>';
            $rows[] = '<small>'.$record['agent'].'</small>';
			$rows[] = '<small>'.$record['logs_date'].'</small>';
			$rows[] = '<center> <div class="btn-group" role="group" aria-label="Basic example"><button type="button" name="update" id="'.$record["id"].'" class="btn btn-warning btn-sm update">Update</button><button type="button" name="delete" id="'.$record["id"].'" class="btn btn-danger btn-sm delete" >Delete</button> </div></center>';
			
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
			SET company = ?, product = ?, account = ?, customer = ?, sales = ?, email = ?, phone = ?, agent = ?, logs_date = ?
			WHERE id = ?");
	 
			$this->id = htmlspecialchars(strip_tags($this->id));
			$this->company = htmlspecialchars(strip_tags($this->company));
			$this->product = htmlspecialchars(strip_tags($this->product));
			$this->account = htmlspecialchars(strip_tags($this->account));
			$this->customer = htmlspecialchars(strip_tags($this->customer));
			$this->sales = htmlspecialchars(strip_tags($this->sales));
			$this->email = htmlspecialchars(strip_tags($this->email));
			$this->phone = htmlspecialchars(strip_tags($this->phone));
			$this->agent = htmlspecialchars(strip_tags($this->agent));
			$this->logs_date = htmlspecialchars(strip_tags($this->logs_date));
			
			
			$stmt->bind_param("sssssssssi", $this->company, $this->product, $this->account, $this->customer, $this->sales, $this->email, $this->phone, $this->agent, $this->logs_date, $this->id);
			
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
		
		if($this->company) {

			$stmt = $this->conn->prepare("
			INSERT INTO ".$this->recordsTable."(`company`, `product`, `account`, `customer`, `sales`, `email`, `phone`, `agent`, `logs_date`)
			VALUES(?,?,?,?,?,?,?,?,?)");

			
			$this->id = htmlspecialchars(strip_tags($this->id));
			$this->company = htmlspecialchars(strip_tags($this->company));
			$this->product = htmlspecialchars(strip_tags($this->product));
			$this->account = htmlspecialchars(strip_tags($this->account));
			$this->customer = htmlspecialchars(strip_tags($this->customer));
			$this->sales = htmlspecialchars(strip_tags($this->sales));
			$this->email = htmlspecialchars(strip_tags($this->email));
			$this->phone = htmlspecialchars(strip_tags($this->phone));
			$this->agent = htmlspecialchars(strip_tags($this->agent));
			$this->logs_date = htmlspecialchars(strip_tags($this->logs_date));
			
			$stmt->bind_param("sssssssss", $this->company, $this->product, $this->account, $this->customer, $this->sales, $this->email, $this->phone, $this->agent, $this->logs_date);

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