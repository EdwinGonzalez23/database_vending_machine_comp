<!DOCTYPE html>   
<html lang="en">   
<head>   
<meta charset="utf-8">   
<title>Final Output</title>   
<meta name="description" content="Bootstrap.">  
<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">   
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>  
<body style="margin:20px auto">  
<div class="container">
<div class="row header" style="text-align:center;color:green">
<h3>Bootstrap</h3>
</div>
<table id="myTable" class="table table-striped" >  
	<thead>  
	  <tr>  
	    <th>LocationID</th>  
	    <th>RouteID</th>  
	    <th>OrderID</th>  
	    <th>OrderDate</th>  
	    <th>TimeArrived</th>  
	    <th>TimeSpent</th>  
	    <th>Street</th>  
	    <th>City</th>  
	    <th>State</th>  
	    <th>ZIP</th>  
	    <th>Description</th>  
	  </tr>  
	</thead>  
	<tbody>  
<?php
include 'config3.php';
$sql =<<<EOF
	select * from delivery natural join location;
EOF;

$ret = pg_query($db,$sql);
while($row = pg_fetch_row($ret)) {
    echo "<tr>";
    echo "<td>" .$row[0] ."</td>";
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
    echo "</tr>";
}
?>


	</tbody>  
      </table>  
	  </div>
</body>  
<script>
$(document).ready(function(){
    $('#myTable').dataTable();
});
</script>
</html>  

