<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "", "testing");
$columns = array('no_ticket', 'department', 'product', 'description', 'last_update', 'status', 'priority', 'logs_agent', 'date');

$query = "SELECT * FROM handover ";

if(isset($_POST["search"]["value"]))
{
 $query .= '
 WHERE no_ticket LIKE "%'.$_POST["search"]["value"].'%" 
 OR department LIKE "%'.$_POST["search"]["value"].'%" 
 OR product LIKE "%'.$_POST["search"]["value"].'%" 
 OR description LIKE "%'.$_POST["search"]["value"].'%" 
 OR last_update LIKE "%'.$_POST["search"]["value"].'%" 
 OR status LIKE "%'.$_POST["search"]["value"].'%" 
 OR priority LIKE "%'.$_POST["search"]["value"].'%" 
 OR logs_agent LIKE "%'.$_POST["search"]["value"].'%" 
 OR date LIKE "%'.$_POST["search"]["value"].'%" 
 ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
 $query .= 'ORDER BY status DESC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

$result = mysqli_query($connect, $query . $query1);

$data = array();

while($row = mysqli_fetch_array($result))
{
 $sub_array = array();
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="no_ticket"><small>' . $row["no_ticket"] . '</small></div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="department"><small>' . $row["department"] . '<small></div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="product"><small>' . $row["product"] . '</small></div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="description"><small>' . $row["description"] . '</small></div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="last_update"><small>' . $row["last_update"] . '</small></div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="status"><small>' . $row["status"] . '</small></div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="priority"><small>' . $row["priority"] . '</small></div>';
 $sub_array[] = '<div  class="update" data-id="'.$row["id"].'" data-column="logs_agent"><small>' . $row["logs_agent"] . '</small></div>';
 $sub_array[] = '<div  class="update" data-id="'.$row["id"].'" data-column="date"><small>' . $row["date"] . '</small></div>';
 $sub_array[] = '<button type="button" name="delete" class="btn btn-danger delete btn-sm" id="'.$row["id"].'"><small>Delete</small></button>';
 $data[] = $sub_array;
}

function get_all_data($connect)
{
 $query = "SELECT * FROM handover";
 $result = mysqli_query($connect, $query);
 return mysqli_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($connect),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);

?>