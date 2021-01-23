<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "", "testing");
$columns = array('no_ticket', 'product', 'company', 'kebutuhan', 'agent', 'sales', 'tgl_fu', 'channel');

$query = "SELECT * FROM upsale ";

if(isset($_POST["search"]["value"]))
{
 $query .= '
 WHERE no_ticket LIKE "%'.$_POST["search"]["value"].'%" 
 OR product LIKE "%'.$_POST["search"]["value"].'%" 
 OR company LIKE "%'.$_POST["search"]["value"].'%" 
 OR kebutuhan LIKE "%'.$_POST["search"]["value"].'%" 
 OR agent LIKE "%'.$_POST["search"]["value"].'%" 
 OR sales LIKE "%'.$_POST["search"]["value"].'%" 
 OR tgl_fu LIKE "%'.$_POST["search"]["value"].'%" 
 OR channel LIKE "%'.$_POST["search"]["value"].'%" 
 ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
 $query .= 'ORDER BY id DESC ';
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
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="no_ticket">' . $row["no_ticket"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="product">' . $row["product"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="company">' . $row["company"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="kebutuhan">' . $row["kebutuhan"] . '</div>';
 $sub_array[] = '<div class="update" data-id="'.$row["id"].'" data-column="agent">' . $row["agent"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="sales">' . $row["sales"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="tgl_fu">' . $row["tgl_fu"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="channel">' . $row["channel"] . '</div>';
 $sub_array[] = '<button type="button" name="delete" class="btn btn-danger delete btn-sm" id="'.$row["id"].'">Delete</button>';
 $data[] = $sub_array;
}

function get_all_data($connect)
{
 $query = "SELECT * FROM upsale";
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