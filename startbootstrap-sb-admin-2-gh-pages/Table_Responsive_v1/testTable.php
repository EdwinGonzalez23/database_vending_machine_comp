<!DOCTYPE html>
<html>
<head>
</head>
<body>

<p> Employee table created bellow </p>

<p>bellow is a regular table with no php</p>
<br>
<table>
<tr>
<td>1</td>
<td>Nadiya</td>
<td>Sleightholme</td>
</tr>
</table>
<br>
<p>Now with PHP in between </p>

<br>
<?php
//include can be different depending where you put it, i made a bunch of config.php to keep things easier for me
//QUERY BELLOW 
include 'config3.php';
$sql =<<<EOF
select * from Employee;
EOF;
$ret = pg_query($db,$sql);

//Set up HTML table within PHP with echo
echo "<table>";
while($row = pg_fetch_row($ret)) {
    echo "<tr>" . "\n";
    echo "<td>" . $row[0] . "</td>" . "\n";
    echo "<td>" . $row[1] . "</td>" . "\n";
    echo "<td>" . $row[2] . "</td>" . "\n";
    echo "<td>" . $row[3] . "</td>" . "\n";
    echo "<td>" . $row[4] . "</td>" . "\n";
    echo "<td>" . $row[5] . "</td>" . "\n";
    echo "<td>" . $row[6] . "</td>" . "\n";
    echo "<td>" . $row[7] . "</td>" . "\n";
    echo "<td>" . $row[8] . "</td>" . "\n";
    echo "<td>" . $row[9] . "</td>" . "\n";
    echo "<td>" . $row[10] . "</td>" . "\n";
    echo "<td>" . $row[11] . "</td>" . "\n";
    echo "<td>" . $row[12] . "</td>" . "\n";
    echo "<td>" . $row[13] . "</td>" . "\n";
    echo "<td>" . $row[14] . "</td>" . "\n";
    echo "</tr>" . "\n";

}
echo "</table>";

?>



</body>
</html>

