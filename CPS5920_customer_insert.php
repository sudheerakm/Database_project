<html>
<body>
<?php
include "dbconfig1.php";

$myLoginId=$_POST["login_id"];
$myPasasword1=$_POST["passwd1"];
$myPasasword2=$_POST["passwd2"];
$myFirstName=$_POST["first_name"];
$myLastName=$_POST["last_name"];
$myTel=$_POST["tel"];
$myAddress=$_POST["address"];
$myCity=$_POST["city"];
$myZipcode=$_POST["zipcode"];
$myState=$_POST["State"];
if($myPasasword1!=$myPasasword2){
	echo "Password and Retype password doesn't match";
}
else{
	$conn = new mysqli($servername, $username, $password, $dbname);	 
	 if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	 }
	 $query = "INSERT INTO CUSTOMER (login_id,password,first_name,last_name,tel,address,city,zipcode,state) VALUES ('$myLoginId','$myPasasword1','$myFirstName','$myLastName','$myTel','$myAddress','$myCity','$myZipcode','$myState')";
	 if ($conn->query($query) === TRUE) {
    echo "Successfully run query:".$query;
	} else {
    echo "Error: " . $query . "<br>" . $conn->error;
	}
	$conn->close();
}

?>