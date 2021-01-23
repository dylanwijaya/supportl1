<?php
class Records {	
   
	private $recordsTable = 'gamas';
	public $id;
	public $brand;
    public $product;
	public $start;
	public $problem;
	public $escalation;
	public $agent;

	private $conn;
	
	public function __construct($db){
        $this->conn = $db;
    }	    
	

	public function listRecords(){
		
		$sqlQuery = "SELECT * FROM ".$this->recordsTable." ";
		if(!empty($_POST["search"]["value"])){
			$sqlQuery .= 'where(brand LIKE "%'.$_POST["search"]["value"].'%" ';			
			$sqlQuery .= ' OR product LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR start LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR end LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR duration LIKE "%'.$_POST["search"]["value"].'%" ';		
			$sqlQuery .= ' OR problem LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR escalation LIKE "%'.$_POST["search"]["value"].'%") ';
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
			$rows[] = '<small>'.$record['brand'].'</small>';
			$rows[] = '<small>'.$record['product'].'</small>';		
			$rows[] = '<small>'.$record['start'].'</small>';
			$rows[] = '<small>'.$record['end'].'</small>';
			$rows[] = '<small>'.$record['duration'].'</small>';	
			$rows[] = '<small>'.$record['problem'].'</small>';
			$rows[] = '<small>'.$record['escalation'].'</small>';
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
			SET brand= ?, product = ?, start = ?, end = ?, duration = ?, problem = ?, escalation = ?
			WHERE id = ?");
	 
			$this->id = htmlspecialchars(strip_tags($this->id));
			$this->brand = htmlspecialchars(strip_tags($this->brand));
			$this->product = htmlspecialchars(strip_tags($this->product));
			$this->start = htmlspecialchars(strip_tags($this->start));
			$this->end = htmlspecialchars(strip_tags($this->end));
			$this->duration = htmlspecialchars(strip_tags($this->duration));
			$this->problem = htmlspecialchars(strip_tags($this->problem));
			$this->escalation = htmlspecialchars(strip_tags($this->escalation));
			
			
			$stmt->bind_param("sssssssi", $this->brand, $this->product, $this->start, $this->end, $this->duration, $this->problem, $this->escalation, $this->id);
			
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
		
		if($this->brand) {

			$stmt = $this->conn->prepare("
			INSERT INTO ".$this->recordsTable."(`brand`, `product`, `start`, `end`, `duration`, `problem`, `escalation`)
			VALUES(?,?,?,?,?,?,?)");

			
			$this->id = htmlspecialchars(strip_tags($this->id));
			$this->brand = htmlspecialchars(strip_tags($this->brand));
			$this->product = htmlspecialchars(strip_tags($this->product));
			$this->start = htmlspecialchars(strip_tags($this->start));
			$this->end = htmlspecialchars(strip_tags($this->end));
			$this->duration = htmlspecialchars(strip_tags($this->duration));
			$this->problem = htmlspecialchars(strip_tags($this->problem));
			$this->escalation = htmlspecialchars(strip_tags($this->escalation));

			
			$stmt->bind_param("sssssss", $this->brand, $this->product, $this->start, $this->end, $this->duration, $this->problem, $this->escalation);

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