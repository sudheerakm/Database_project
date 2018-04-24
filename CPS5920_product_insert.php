<html>
<body>
<a href='logout.php'>Employee logout</a><br>
<?php
include "dbconfig1.php";

$myName=$_POST["product_name"];
$myDescription=$_POST["description"];
$myCost=$_POST["cost"];
$mySellPrice=$_POST["sell_price"];
$myQuantity=$_POST["quantity"];
$myVendor=$_POST["vendor_id"];
$myEmployeeId=$_POST["employee_id"];

	$conn = new mysqli($servername, $username, $password, $dbname);	 
	 if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	 }
	
	 $query = "INSERT INTO PRODUCT (name,description,vendor_id,cost,sell_price,quantity,employee_id) VALUES ('$myName','$myDescription','$myVendor',
	 '$myCost','$mySellPrice','$myQuantity','$myEmployeeId')";
	 if ($conn->query($query) === TRUE) {
    echo "Successfully insert the product:".$myName;
	} else {
    echo "Error: " . $query . "<br>" . $conn->error;
	}
	$conn->close();


?>
<br><br><a href='CPS5920_employee_check_p2.php'>Employee home page</a><br>
<a href='index.html'>Project home page</a><br>