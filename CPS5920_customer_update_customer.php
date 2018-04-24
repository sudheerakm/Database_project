<html>
<body>
<a href='logout.php'>Customer logout</a><br>
<?php
include "dbconfig1.php";
//session_start();
//$myLoginId= $_SESSION["loginid_from_session"] ;
//echo "from session".$myLoginId;
$cookie_name = "Customer_login_cookie";
$myLoginId= $_COOKIE[$cookie_name];
$myPasasword1=$_POST["password"];

$myFirstName=$_POST["first_name"];
$myLastName=$_POST["last_name"];
$myTel=$_POST["tel"];
$myAddress=$_POST["address"];
$myCity=$_POST["city"];
$myZipcode=$_POST["zipcode"];
$myState=$_POST["State"];

	$conn = new mysqli($servername, $username, $password, $dbname);	 
	 if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	 }
	 $query = "UPDATE CUSTOMER set password='$myPasasword1',first_name='$myFirstName',last_name='$myLastName',tel='$myTel',address='$myAddress',city='$myCity',zipcode='$myZipcode',state='$myState' where login_id='$myLoginId'";
	 
	 if ($conn->query($query) === TRUE) {
    echo "Successfully update the customer profile.";
	} else {
    echo "Error: " . $query . "<br>" . $conn->error;
	}
	$conn->close();
	
?>
<br><a href='index.html'>project home page</a>
</body>
</html>
