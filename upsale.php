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
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.23/datatables.min.css"/>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.23/datatables.min.js"></script>

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
          <a class="dropdown-item" href="manage_support.php">Manage Support</a>
          <a class="dropdown-item" href="#">Monthly Report</a>
          <a class="dropdown-item" href="handover.php">Handover</a>
          <a class="dropdown-item" href="list_gamas.php">List Gamas</a>
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
   <h1 align="center">Upsale L1</h1>
   <br />
   <div class="table-responsive">
   <br />
    <div align="right">
     <button type="button" name="add" id="add" class="btn btn-info">Add</button>
    </div>
    <br />
    <div id="alert_message"></div>
    <table id="user_data" class="table table-bordered table-striped table-sm" style="width:100%">
     <thead>
      <tr style="width:100%">
       <th>No Ticket</th>
       <th>Product</th>
       <th>Company</th>
       <th>Requirement</th>
       <th>Agent</th>
       <th>Sales</th>
       <th>Follup Date</th>
       <th>Channel</th>
       <th>Action</th>
      </tr>
     </thead>
    </table>
   </div>
  </div>
  <div class="copyright">
    <p>Dibuat oleh Dylan 2021</p>
  </div>
 </body>
</html>

<script type="text/javascript" language="javascript" >
 $(document).ready(function(){
  
  fetch_data();

  function fetch_data()
  {
   var dataTable = $('#user_data').DataTable({
    "processing" : true,
    "serverSide" : true,
    "order" : [],
    "ajax" : {
     url:"fetch.php",
     type:"POST"
    }
   });
  }
  
  function update_data(id, column_name, value)
  {
   $.ajax({
    url:"update.php",
    method:"POST",
    data:{id:id, column_name:column_name, value:value},
    success:function(data)
    {
     $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
     $('#user_data').DataTable().destroy();
     fetch_data();
    }
   });
   setInterval(function(){
    $('#alert_message').html('');
   }, 5000);
  }

  $(document).on('blur', '.update', function(){
   var id = $(this).data("id");
   var column_name = $(this).data("column");
   var value = $(this).text();
   update_data(id, column_name, value);
  });
  
  $('#add').click(function(){
   var html = '<tr>';
   html += '<td contenteditable id="data1"></td>';
   html += '<td contenteditable id="data2"></td>';
   html += '<td contenteditable id="data3"></td>';
   html += '<td contenteditable id="data4"></td>';
   html += '<td  id="data5"></td>';
   html += '<td contenteditable id="data6"></td>';
   html += '<td contenteditable id="data7"></td>';
   html += '<td contenteditable id="data8"></td>';
   html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">Insert</button></td>';
   html += '</tr>';
   $('#user_data tbody').prepend(html);
  });
  
  $(document).on('click', '#insert', function(){
   var no_ticket = $('#data1').text();
   var product = $('#data2').text();
   var company = $('#data3').text();
   var kebutuhan = $('#data4').text();
   var sales = $('#data6').text();
   var tgl_fu = $('#data7').text();
   var channel = $('#data8').text();
   if(no_ticket != '' && product != '' && company != '' && kebutuhan != '' && sales != '' && tgl_fu != '' && channel != '')
   {
    $.ajax({
     url:"insert.php",
     method:"POST",
     data:{no_ticket:no_ticket, product:product, company:company, kebutuhan:kebutuhan, sales:sales, tgl_fu:tgl_fu, channel:channel},
     success:function(data)
     {
      $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
      $('#user_data').DataTable().destroy();
      fetch_data();
     }
    });
    setInterval(function(){
     $('#alert_message').html('');
    }, 5000);
   }
   else
   {
    alert("Both Fields is required");
   }
  });
  
  $(document).on('click', '.delete', function(){
   var id = $(this).attr("id");
   if(confirm("Are you sure you want to remove this?"))
   {
    $.ajax({
     url:"delete.php",
     method:"POST",
     data:{id:id},
     success:function(data){
      $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
      $('#user_data').DataTable().destroy();
      fetch_data();
     }
    });
    setInterval(function(){
     $('#alert_message').html('');
    }, 5000);
   }
  });
 });
</script>