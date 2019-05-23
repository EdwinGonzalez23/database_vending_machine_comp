<!DOCTYPE html>
<html>
<body>

<?php
include 'config2.php';
echo "fdsfa";
$sql =<<<EOF
	select * from itemtype;
EOF;
$ret = pg_query($db,$sql);
echo "here!\n";
while($row = pg_fetch_row($ret)){
    echo $row[2] . "\n";
    if($_POST["submit"] == "Pepsi") {
	echo "match";
    }
}
returnPepsi($ret);
function returnPepsi($ret, $brand) {
    while($row = pg_fetch_row($ret)){
	if($row[2] == $brand) {
	    echo $row[3];
	}
    }
}

?>

<!-- Form with prefilled 10 items?
<h2>Place Order</h2>
Items:<br>
<form name='find' method='post'>
<select>
<!-- --------------------------------------------------------- -->
<option value="Pepsi">Pepsi 
<?php 
$sql =<<<EOF
	select * from itemtype;
EOF;
$ret = pg_query($db,$sql); returnPepsi($ret, "Pepsi");
?> 
</option>
<!-- --------------------------------------------------------- -->
<option value="Sprite">Sprite
<?php 
$sql =<<<EOF
	select * from itemtype;
EOF;
$ret = pg_query($db,$sql); returnPepsi($ret, "Sprite");
?> 
</option>

<!-- --------------------------------------------------------- -->
<option value="Squirt">Squirt

<?php 
$sql =<<<EOF
	select * from itemtype;
EOF;
$ret = pg_query($db,$sql); returnPepsi($ret, "Squirt");
?> 
</option>

<!-- --------------------------------------------------------- -->
<option value="Coke">Coke
<?php 
$sql =<<<EOF
	select * from itemtype;
EOF;
$ret = pg_query($db,$sql); returnPepsi($ret, "Coke");
?> </option>
<!-- --------------------------------------------------------- -->
<option value="Diet Pepsi">Diet Pepsi
<?php 
$sql =<<<EOF
	select * from itemtype;
EOF;
$ret = pg_query($db,$sql); returnPepsi($ret, "Diet Pepsi");
?> </option>
<!-- --------------------------------------------------------- -->
<option value="Diet Coke">Diet Coke
<?php 
$sql =<<<EOF
	select * from itemtype order by itemtypeid asc;
EOF;
$ret = pg_query($db,$sql); returnPepsi($ret, "Diet Coke");
?> </option>
<!-- --------------------------------------------------------- -->
<option value="Fanta">Fanta
<?php 
$sql =<<<EOF
	select * from itemtype;
EOF;
$ret = pg_query($db,$sql); returnPepsi($ret, "Fanta");
?> </option>
<!-- --------------------------------------------------------- -->
<option value="Powerade">Powerade
<?php 
$sql =<<<EOF
	select * from itemtype;
EOF;
$ret = pg_query($db,$sql); returnPepsi($ret, "Powerade");
?> </option>
<!-- --------------------------------------------------------- -->
<option value="Minute Maid">Minute Maid
<?php 
$sql =<<<EOF
	select * from itemtype;
EOF;
$ret = pg_query($db,$sql); returnPepsi($ret, "Minute Maid");
?> </option>
<!-- --------------------------------------------------------- -->
<option value="Crush">Crush
<?php 
$sql =<<<EOF
	select * from itemtype;
EOF;
$ret = pg_query($db,$sql); returnPepsi($ret, "Crush");
?> </option>
<!-- --------------------------------------------------------- -->
</select>
<input type='submit' name='submit'/>
</form>



<form action="orderform.php">
First name:<br>
<input type="text" name="STuff Stuff" value="">
<br>
Last name:<br>
<input type="text" name="MoreStuff" value="">
<br><br>
<input type="submit" value="Submit">
</form> 

<p>If you click the "Submit" button, the form-data will be sent to a page called "/action_page.php".</p>

</body>
</html>

