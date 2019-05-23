<!DOCTYPE html>
<html>
<body>

<h2>HTML Forms</h2>

<form action="test.php" method = "post">
  <br><br>
  <button type="submit" name = "lastname" value="Submit">button</button>
</form> 

<p>If you click the "Submit" button, the form-data will be sent to a page called "/action_page.php".</p>
<?php
echo "test";
$var = $_POST["lastname"];
echo $var;


?>
</body>
</html>

