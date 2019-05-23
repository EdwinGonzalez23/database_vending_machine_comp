<?php

// Report All PHP Errors
error_reporting(E_ALL);

// Session start
    session_start();

// Currency symbol, you can change it
$currency = "$";

$msg = "";
$v = "1.6.2";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PHP Session Based Cart System is pretty simple and fast way for listing small amount of products. This script doesn't include any payment method or payment page. This script lists manually added products, you can add that products to your shopping cart, remove them, change quantity via sessions.">
    <meta name="author" content="anbarli.org">

    <title>PHP-SBCS / Session Based Cart System</title>

    <!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<script language="Javascript">
<!-- Allows only numeric chars -->
    function isNumberKey(evt)
    {
	var charCode=(evt.which)?evt.which:event.keyCode
	    if(charCode>31&&(charCode<48||charCode>57))
		return false;return true;
    }
</script>

	<style>
	.quantity { width: 20px; float: left; margin-right: 10px; height: 23px; font-size: 12px; padding: 5px; }
	</style>

  </head>

  <body>

<?php
// Add item to cart
if (empty($_POST['item']) || empty($_POST['price']) || empty($_POST['quantity']))
{ } else {

    # Take values
    $SBCSprice = $_POST['price'];
    $SBCSitem = $_POST['item'];
    $SBCSquantity = $_POST['quantity'];
    $SBCSuniquid = rand();
    $SBCSexist = false;
    $SBCScount = 0;
    // If SESSION Generated?
    if($_SESSION['SBCScart']!="")
    {
	// Look for item
	foreach($_SESSION['SBCScart'] as $SBCSproduct)
	{
	    // Yes we found it
	    if($SBCSitem == $SBCSproduct['item']) {
		$SBCSexist = true;
		break;
	    }
	    $SBCScount++;
	}
    }
    // If we found same item
   
//    itemtypeid orderid numitemtype   itemtypeprice      expdate      
	
   
   
    if($SBCSexist)
    {
	// Update quantity
	$_SESSION['SBCScart'][$SBCScount]['quantity'] += $SBCSquantity;
	// Write down the message and then we open in modal at the bottom
	$msg = "
	    <script type=\"text/javascript\">
$(document).ready(function(){
    $('#myDialogText').text('".$SBCSitem." quantity updated..');
    $('#modal-cart').modal('show');
    });
			</script>
			";

} else {

    // If we do not found, insert new
    $SBCSmycartrow = array(
	'item' => $SBCSitem,
	'unitprice' => $SBCSprice,
	'quantity' => $SBCSquantity,
	'id' => $SBCSuniquid
    );

    // If session not exist, create
    if (!isset($_SESSION['SBCScart']))
	$_SESSION['SBCScart'] = array();

    // Add item to cart
    $_SESSION['SBCScart'][] = $SBCSmycartrow; //COME BACK HERE

    // Write down the message and then we open in modal at the bottom
    $msg = "
<script type=\"text/javascript\">
$(document).ready(function(){
    $('#myDialogText').text('".$SBCSitem." added to your cart');
    $('#modal-cart').modal('show');
});
</script>
			";

}
}

// Clear cart
if(isset($_GET["clear"]))
{
    session_unset();
    session_destroy();
    // Write down the message and then we open in modal at the bottom
    $msg = "
<script type=\"text/javascript\">
$(document).ready(function(){
    $('#myDialogText').text('Your cart is empty now..');
    $('#modal-cart').modal('show');
});
</script>
		";
}

// Remove item from cart (Updating quantity to 0)
$remove = isset($_GET['remove']) ? $_GET['remove'] : '';
if($remove!="")
{
    $_SESSION['SBCScart'][$_GET["remove"]]['quantity'] = 0;
}
?>

    <div class="navbar navbar-inverse" role="navigation">
      <div class="container">
	<div class="navbar-header">
	  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	    <span class="icon-bar"></span>
	    <span class="icon-bar"></span>
	    <span class="icon-bar"></span>
	  </button>
	  <a class="navbar-brand" href="index.php">PHP-SBCS</a>
	</div>
	<div class="collapse navbar-collapse">
	  <ul class="nav navbar-nav navbar-right">
			<li class="active"><a href="/" target="blank">Who Am I</a></li>
			<li class="active"><a href="https://github.com/ganbarli/PHP-SBCS" target="blank">GitHub Project Page</a></li>
	  </ul>
	</div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </div><!-- /.navbar -->

    <div class="container">
      <div class="row">
	<div class="col-xs-12 col-sm-8">
	  <p class="pull-right visible-xs">
	    <button type="button" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-shopping-cart"></span> My Cart</button>
	  </p>
	  <div class="jumbotron">
	    <p>PHP Session Based Cart System is pretty simple and fast way for listing small amount of products. This script lists manually added products, you can add that products to your shopping cart, remove them, change quantity via sessions. This script doesn't include any payment method or payment page.</p>
	  </div><!-- /.jumbotron -->
	  <div class="col-sm-13">
			<?php if(isset($_GET["pay"])) { ?>
			<div class="panel panel-success">
			  <div class="panel-heading"><span class="glyphicon glyphicon-shopping-cart"></span> Well done!</div>
			  <div class="panel-body">
				Payment options for <b><?php echo $_POST["payment"];?></b>, here you can code, or simply change the forms action to another script page.<br><br>
				If you wish, you can write session variables into database (do not forget to clean the variables, for example you can use mysql_real_escape_string) or simply you can mail the form values. After  And then destroy & unset the session "SBCScart".
				<br><br>
				<b>Order Details</b>
				<br><br>
<?php 
echo $_POST["OrderDetail"];
include 'config2.php';
$sql =<<<EOF
	select * from supplier; 
EOF;
$orderview =<<<EOF
	select * from placesorder natural join orders natural join ordercontains;
EOF;
$ret = pg_query($db, $sql);
if(!$ret) {
    echo pg_last_error($db);
    exit;
}
/*$items =<<<EOF
	select * from itemtype;
EOF;
$itemret = pg_query($db, $items); //row [2] for name, row[0] for id
 */
//get latestOID
$latestOID =<<<EOF
		select orderid from orders order by orderid desc;
EOF;
$ret2 = pg_query($db, $latestOID);
$latestOID = pg_fetch_row($ret2); $latestOID[0] = $latestOID[0] + 1; echo "Latest: $latestOID[0]";
$badgenumber = 1; $dates = date("Y-m-d"); $times = date("h:i:sa");
$supid;
while($row = pg_fetch_row($ret)){
    if($_POST["cselect"] == $row[1]) { 
	$supid = $row[0];
	break;
    }

}
//Frist create order
$q2 = "INSERT INTO orders(orderid,supplierid,ordertype) values ($latestOID[0],$supid,'TESTTYPE')";
$retq2 = pg_query($db,$q2);

//Second PLACE Order
$q = "INSERT INTO placesorder(orderid,badgenumber,timeplaced,dateplaced) values ($latestOID[0], $badgenumber,current_timestamp,date'$dates')";
$retq = pg_query($db,$q);

//Third, insert int orderContains
foreach($_SESSION['SBCScart'] as $SBCSitem) {
    $itemid;
    echo "pre while: ";
    echo $SBCSitem['item'];echo "<br>";
    echo $SBCSitem['unitprice'];echo "<br>";
$items =<<<EOF
	select * from itemtype;
EOF;
$itemret = pg_query($db, $items); //row [2] for name, row[0] for id
    while($itemrow = pg_fetch_row($itemret)){
	    echo "in  while: ";
	    echo $SBCSitem['item'];echo "<br>";	
	if($itemrow[1] == $SBCSitem['item']) {
	    $itemid = $itemrow[0];
	    echo "in if while: ";
	    echo $SBCSitem['item'];echo "<br>";	
	    break;
	}	
    }
    $quant = $SBCSitem['quantity'];
    $price = $SBCSitem['unitprice'];
    $q3 = "INSERT INTO ordercontains(itemtypeid,orderid,numitemtype,itemtypeprice,expdate) values ($itemid,$latestOID[0],$quant,money'$price',date'05-05-2015')";
    $retq3 = pg_query($db,$q3); //should add all this stuffs
}
$_SESSION['oid'] = $latestOID[0]; $_SESSION['sid'] = $supid;
header('Location: http://delphi.cs.csubak.edu/~egonzale/startbootstrap-sb-admin-2-gh-pages/EditableInvoice/index.php');
echo $_POST["OrderDetail"];
//session_destroy();
?>
			  </div>
			</div><!-- /.panel -->
			<?php } ?>
			<!-- Products Group -->
			<div class="panel panel-default">
			  <div class="panel-heading"><span class="glyphicon  glyphicon-cutlery"></span>Items</div>
			  <ul class="list-group">
				<!-- Product 1 -->
<?php 
include 'config2.php';
$sql =<<<EOF
	select * from itemtype;
EOF;
$pNum = 1;
setlocale(LC_MONETARY, 'en_US');
$ret = pg_query($db,$sql);
while($row = pg_fetch_row($ret)) {
    //list all items
    $test =trim(strval($row[2]),"$?");

    echo	"<li class=\"list-group-item\">";
    echo	"<form action=\"?\" method=\"post\">";
    echo		"<input type=\"submit\" name=\"ok\" value=\"+\" class=\"btn btn-success btn-xs\">";
    echo		"<input class=\"form-control quantity\" name=\"quantity\" type=\"text\" onkeypress=\"return isNumberKey(event)\" maxlength=\"10\" value=\"1\"> $row[1]";
    echo		"<span class=\"pull-right\">$row[2] <?php echo $currency;?></span>";
    echo		"<input type=\"hidden\" name=\"item\" value=\"$row[1]\" />";
    echo		"<input type=\"hidden\" name=\"price\" value=$test />";
    echo	"</form>";
    echo	"</li>";
    $pNum = $pNum + 1;

    //1521 (delphi port)
}
?>



			</ul>
			</div>
			</div>

			<div class="panel panel-default">
			  <div class="panel-heading"><span class="glyphicon  glyphicon-cutlery"></span></div>
			  <ul class="list-group">
				<!-- Product 1 -->
			  </ul>
			</div>

	  </div><!--/row-->
	</div><!--/span-->

	<div class="col-xs-6 col-sm-4" id="sidebar" role="navigation">
	  <div class="sidebar-nav">
<?php
// If cart is empty
if (!isset($_SESSION['SBCScart']) || (count($_SESSION['SBCScart']) == 0)) {
?>
				<div class="panel panel-default">
				  <div class="panel-heading">
					<h3 class="panel-title"><span class="glyphicon glyphicon-shopping-cart"></span> My Cart</h3>
				  </div>
				  <div class="panel-body">Your cart is empty..</div>
				</div>
<?php
    // If cart is not empty
} else {
?>
				<div class="panel panel-default">
					<div class="panel-heading" style="margin-bottom:0;">
						<h3 class="panel-title"><span class="glyphicon glyphicon-shopping-cart"></span> My Cart</h3>
					</div>
					<div class="table-responsive">
					<table class="table">
						<tr class="tableactive"><th>Product</th><th>Price</th><th>Qty.</th><th>Tot.</th></tr>
<?php
    // List cart items
    // We store order detail in HTML
    $OrderDetail = '
	<table border=1 cellpadding=5 cellspacing=5>
	<thead>
	<tr>
	<th>Product</th>
	<th>Price</th>
	<th>Quantity</th>
	<th>Total</th>
	</tr>
	</thead>
	<tbody>';

    // Equal total to 0
    $total = 0;

    // For finding session elements line number
    $linenumber = 0;
    foreach($_SESSION['SBCScart'] as $SBCSitem)
    {
	if($SBCSitem['quantity']!=0) {

	    // For calculating total values with decimals
	    $pricedecimal = str_replace(",",".",$SBCSitem['unitprice']);
	    $qtydecimal = str_replace(",",".",$SBCSitem['quantity']);

	    $pricedecimal = (float)$pricedecimal;
	    $qtydecimal = (float)$qtydecimal;
	    $qtydecimaltotal = $qtydecimaltotal + $qtydecimal;

	    $totaldecimal = $pricedecimal*$qtydecimal;

	    // We store order detail in HTML
	    $OrderDetail .= "<tr><td>".$SBCSitem['item']."</td><td>".$SBCSitem['unitprice']." ".$currency."</td><td>".$SBCSitem['quantity']."</td><td>".$totaldecimal." ".$currency."</td></tr>";

	    // Write cart to screen
	    echo
		"
		<tr class='tablerow'>
		<td><a href=\"?remove=".$linenumber."\" class=\"btn btn-danger btn-xs\" onclick=\"return confirm('Are you sure?')\">X</a> ".$SBCSitem['item']."</td>
		<td>".$SBCSitem['unitprice']." ".$currency."</td>
		<td>".$SBCSitem['quantity']."</td>
		<td>".$totaldecimal." ".$currency."</td>
		</tr>
		";

	    // Total
	    $total += $totaldecimal;
	    echo $_POST['cselect'];
	}
	   /* $q = "INSERT INTO placesorder(orderid,badgenumber) values ($latestOID[0], 1)";
	    $q2 = "INSERT INTO orders(orderid,supplierid,ordertype) values ($latestOID[0],10,TESTTYPE)";
	    $q3 = "INSERT INTO ordercontains(orderid,numitemtype,itemtypeprice,expdate) values ($latestOID[0],500,5,5-5-2015)";
	    $retq = pg_query($db,$q);
	    $retq2 = pg_query($db,$q2);
	   $retq3 = pg_query($db,$q3);*/

	$linenumber++;
	// break;
    }
    // We store order detail in HTML
    $OrderDetail .= "<tr><td>Total</td><td></td><td></td><td>".$total." ".$currency."</td></tr></tbody></table>";

?>
						    <tr class='tableactive'>
							    <td><a href='?clear' class='btn btn-danger btn-xs' onclick="return confirm('Are you sure?')">Empty Cart</a></td>
							    <td class='text-right'>Total</td>
							    <td><?php echo $qtydecimaltotal;?></td>
							    <td><?php echo $total;?> <?php echo $currency;?></td>
						    </tr>
					    </table>
					    </div>
				    </div>
				    <!-- // Cart -->

				    <!-- Address -->
				    <div class="panel panel-default">
				      <div class="panel-heading">
					    <h3 class="panel-title"><span class="glyphicon glyphicon-phone-alt"></span> Supplier Info</h3>
				  </div>
				  <div class="panel-body">
					<form role="form" method="post" action="?pay" target="_blank">
					  <div class="form-group">

						<label for="inputEmail1"></label>
						<div>
						<p><b>Choose Order Type</b></p>
						<select name = "typeorder" method = "post">
						<option value = "WarehouseOrder">Warehouse</option>
						<option value = "VendingOrder">Vending</option>
						</select><p><b>Choose a supplier</b></p>
						<select name = "cselect" method = "post">
<?php
    include 'config2.php';
    $sql =<<<EOF
	select * from supplier;
EOF;
    $ret = pg_query($db,$sql);
    while($row = pg_fetch_row($ret)) {

	echo "<option value = \"$row[1]\">$row[1]</option>";

    }

?>


<!-- name, phone, street, citty, state, zip-->


						</select>
  <!--  <input type="text" name="name" class="form-control" id="inputEmail1" placeholder="supplier name"</div>
					  <div class="form-group">
						<label for="inputEmail2">Email</label>
						<div>
						  <input type="phone" name="phone" class="form-control" id="inputEmail2" placeholder="mail@domain.com">
						</div>
					  </div>
					  <div class="form-group">
						<label for="inputEmail3">Phone</label>
						<div>
						  <input type="text" name="phone" class="form-control" id="inputEmail3" placeholder="Phone" onkeypress="return isNumberKey(event)" >
						</div>
					  </div>
					  <div class="form-group">
						<label for="inputEmail4">Address</label>
						<div>
						  <textarea class="form-control" name="address" id="inputEmail4" style="height:50px;"></textarea>
						</div>
					  </div>
					  <div class="form-group">
						<label for="optionsRadios1">Payment</label>
						<div style="margin-top: 6px;">
							<select class="form-control selectEleman" name="payment">
							  <option value="Credit Card">Credit Card</option>
							  <option value="PayPal">PayPal</option>
							</select>
						</div>
					  </div>-->
					  <div class="form-group">
						<div>
					<!--	<button class="btn btn-success pull-right"><a href = "http://delphi.cs.csub.edu/~egonzale/startbootstrap-sb-admin-2-gh-pages/EditableInvoice/index.php" target = "_blank">Order</a></button>
<a type = "submit" class="btn btn-success" href="http://delphi.cs.csub.edu/~egonzale/startbootstrap-sb-admin-2-gh-pages/EditableInvoice/index.php" target = "_blank">test</a>-->
			<button type="submit" class="btn btn-success pull-right">Give Order</button> 
						</div>
					  </div>
					<input type="hidden" name="total" value="<?php echo $total;?>">
					<input type="hidden" name="OrderDetail" value="<?php echo htmlentities($OrderDetail);?>">
					</form>
				  </div>
				</div>
				<!-- // Address -->

			<?php } # End Cart Listing ?>
	  </div><!--/.well -->
	</div><!--/span-->
      </div><!--/row-->
      <hr>
<!--
    //Start session and Create new RECEIPT! 
    include 'config.php';
    //   session_start();

    $sql =<<<EOF
	select * from supplier; 
EOF;
/*echo "CHANGES HAVE BEEN MADE";
    $ret = pg_query($db, $sql);
    if(!$ret) {
	echo pg_last_error($db);
	exit;
    } 

    while($row = pg_fetch_row($ret)) {
	if($_POST["cselect"] == $row[1]) {
	    echo $_POST["cselect"];
	    $_SESSION["SName"] = $_POST["cselect"];
	    $_SESSION["SID"] = $row[0];
	    $SID = $_SESSION["SID"];
	    //get latest orderid
	    $latestOID =<<<EOF
		select orderid from orders order by orderid desc;
EOF;
	    $ret2 = pg_query($db, $latestOID);
	    $latestOID = pg_fetch_row($ret2); $latestOID[0] = $latestOID[0] + 1; echo "Latest: $latestOID[0]";
	    $badgenumber = 1; $dates = date("Y-m-d"); $times = date("h:i:sa"); echo "TIME HERE: $dates";
	    //insert into places order () values (orderid, badgenumber, dateplaces, timeplaced
	    $query1 = "INSERT INTO placesorder(orderid, badgenumber,timeplaced,dateplaced) values ($latestOID[0], $badgenumber,current_timestamp, date'$dates')";
	    $ret3 = pg_query($db, $query1);
	    $query2 = "INSERT INTO orders(orderid, supplierid, ordertype) values ($latestOID[0], 1, 'warehouse')";
	    $re4 = pg_query($db, $query2);

	    echo "HEY HERE"; $t = $_POST['quantity']; echo $t;

	    //NEW ORDRE PLACES
	    //PLACESORDER: orderid, badgenumber, dateplaces, time places
	    //supplierid, orderid, badgenumber, timeplaced, dateplaced, ordertype, name, phone, streetname, city, state, zip 
	//    header('Location: http://delphi.cs.csubak.edu/~egonzale/startbootstrap-sb-admin-2-gh-pages/EditableInvoice/index.php');
	}// else if ($_POST["uname"] == $row[3]) { 
    }
 */?> -->
      <footer>
	<p><a href="https://github.com/ganbarli/PHP-SBCS" target="blank">PHP-SBCS</a> (<?php echo $v; ?>) is coded with <i class="glyphicon glyphicon-heart"></i> in İstanbul, <a href="http://www.turkeydiscoverthepotential.com/" target="blank">Türkiye</a></p>
      </footer>

    </div><!--/.container-->

	<div id="modal-cart" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<p class="text-center" id="myDialogText"></p>
				</div>
			</div>
		</div>
	</div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
	<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<?php if($msg != "") { echo $msg; } ?>

     <script>
     (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	 (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	     m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
     })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-928914-3', 'anbarli.org');
ga('send', 'pageview');

</script>

  </body>
</html>
