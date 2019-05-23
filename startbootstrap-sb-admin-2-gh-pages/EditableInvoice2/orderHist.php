<!DOCTYPE html>   
<html lang="en">   
<head>   
<meta charset="utf-8">   
<title>Orders</title>   
<meta name="description" content="Bootstrap.">  
<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">   
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<style>
.click {
background:none;
    border:none;
    margin:0;
    padding:0;
    cursor: pointer;
	color:blue;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
</style>
</head> 

<body style="margin:20px auto">  
<div class="container">
<div class="row header" style="text-align:center;color:green">
<h3>Order History</h3>
</div>
<table id="myTable" class="table table-striped" >  
	<thead>  
	  <tr>  
	    <th>OrderID</th>  
	    <th>SupID</th>  
	    <th>Type</th>  
	    <th>SupName</th>  
	    <th>Phone</th>  
	    <th>Street</th>  
	    <th>City</th>  
	    <th>State</th>  
	    <th>Zip</th>  
	    <th>BadgeNum</th>  
	    <th>TimePlaced</th>  
	    <th>DatePlaced</th>  
	  </tr>  
	</thead>  
	<tbody>  
	<form action = "listrec.php" method = "post">
	<input = "text" name ="test1">
<?php
include 'config2.php';
$sql =<<<EOF
	select * from orders natural join supplier natural join placesorder;
EOF;
$ret = pg_query($db,$sql);
while($row = pg_fetch_row($ret)) {
    $id = strval($row[0]);
    echo "<tr>\n";
    echo "<td><button id = \"myBtn\">" .$row[0] ."</button></td>";
    echo "<td>" .$row[1] ."</td>";
    echo "<td>" .$row[2] ."</td>";
    echo "<td>" .$row[3] ."</td>";
    echo "<td>" .$row[4] ."</td>";
    echo "<td>" .$row[5] ."</td>";
    echo "<td>" .$row[6] ."</td>";
    echo "<td>" .$row[7] ."</td>";
    echo "<td>" .$row[8] ."</td>";
    echo "<td>" .$row[9] ."</td>";
    echo "<td>" .$row[10] ."</td>";
    echo "<td>" .$row[11] ."</td>";
    echo "</tr>\n";
}
?>
</form>
	</tbody>  
      </table>  
	  </div>
<div id = "myModal" class="modal">
<div class = "modal-content">
<span class="close">&times;</span>
<p>TEST</p>

</div>
</div>


</body>  
<script>
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
	modal.style.display = "none";
    }
}
</script>
<script>
$(document).ready(function(){
    $('#myTable').dataTable();
});
</script>
</html>  
