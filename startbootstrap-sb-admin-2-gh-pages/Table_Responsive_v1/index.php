<!DOCTYPE html>
<html lang="en">
<head>
<title>Table V01</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="css/util.css">
<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->

<style>

td {
    background-color: Transparent;
    background-repeat:no-repeat;
    border: none;
    cursor:pointer;
    overflow: hidden;
    outline:none;
}

</style>


</head>

<body>
<div class="limiter">
    <div class="container-table100">
	<div class="wrap-table100">
	    <div class="table100">
		<p><font color = "white">Push to Load Data</font></p>
		<br>
		<button type = "button" onclick="myFunction()"><font color = "white">Load Data</font></button>
		<table id = "mytable">
		    <thead>
			<tr class="table100-head">
			    <th class="column1">LocationID</th>
			    <th class="column1">RouteID</th>
			    <th class="column2">OrderID</th>
			    <th class="column3">OrderDate</th>
			    <th class="column4">TimeArrived</th>
			    <th class="column5">TimeSpent</th>
			    <th class="column6">StreetName</th>
			    <th class="column2">City</th>
			    <th class="column3">State</th>
			    <th class="column4">Zip</th>
			    <th class="column5">Description</th>
			</tr>
		    </thead>
		    <tbody id = "mybody">

<?php
include 'config3.php';
//Deliveries 
$sql =<<<EOF
select * from delivery natural join location order by delivery.odate desc;
EOF;
$ret = pg_query($db,$sql);
echo "<form action=\"routes.php\">";
echo "<table>";
//while($row = pg_fetch_row($ret)) {
    echo "<tr>" . "\n";
    echo "<td>" . $row[0] . "</td>" . "\n";
    echo "<td><input type=\"submit\" value= $row[1]>" . $row[1] . "</td>" . "\n";
    echo "<td = \"click\"><a href = \"routes.php\">" . $row[1] . "</td>" . "\n";
    echo "<td>" . $row[2] . "</td>" . "\n";
    echo "<td>" . $row[3] . "</td>" . "\n";
    echo "<td>" . $row[4] . "</td>" . "\n";
    echo "<td>" . $row[5] . "</td>" . "\n";
    echo "<td>" . $row[6] . "</td>" . "\n";
    echo "<td>" . $row[7] . "</td>" . "\n";
    echo "<td>" . $row[8] . "</td>" . "\n";
    echo "<td>" . $row[9] . "</td>" . "\n";
    echo "<td>" . $row[10] . "</td>" . "\n";
    echo "</tr>" . "\n";

//}
echo "</table>";
echo "</form>";
?>

		    </tbody>
		</table>
	    </div>
	</div>
    </div>
</div>
<!--
<script>

function myFunction() {
    var i = 0;
    while(i < 5) {
	var table = document.getElementById("mybody");
	var row = table.insertRow(0);
	var cell1 = row.insertCell(0);
	var cell2 = row.insertCell(1);
	cell1.innerHTML = "NEW CELL1";
	cell2.innerHTML = "NEW CELL2";
	i++;
    }
} 
</script>
-->









<!--
<div class="limiter">
    <div class="container-table100">
	<div class="wrap-table100">
	    <div class="table100">
		<table>
		    <thead>
			<tr class="table100-head">
			    <th class="column1">Date</th>
			    <th class="column2">Order ID</th>
			    <th class="column3">Name</th>
			    <th class="column4">Price</th>
			    <th class="column5">Quantity</th>
			    <th class="column6">Total</th>
			</tr>
		    </thead>
		    <tbody>
		    <tr>
			<td class="column1">2017-09-29 01:22</td>
			<td class="column2">200398</td>
			<td class="column3">iPhone X 64Gb Grey</td>
			<td class="column4">$999.00</td>
			<td class="column5">1</td>
			<td class="column6">$999.00</td>
		    </tr>

		    </tbody>
		</table>
	    </div>
	</div>
    </div>
</div>

-->


<!--===============================================================================================-->	
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/bootstrap/js/popper.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="js/main.js"></script>

</body>
</html>
