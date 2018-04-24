<!DOCTYPE html>
<html>
<style>
body  {
    background-image: url("image.jpg");
    /*background-color: #cccccc;*/
}

/*ul { display:table; margin:0 auto;}*/
</style>
<body>

	<?php
	//session_start();

	include "dbconfig1.php";

	$myLoginId= $_POST['login_id'];
	$myPassword=$_POST['password'];
	//$_SESSION["loginid_from_session"] = $myLoginId;

	if(($myLoginId== "")||($myPassword==""))
	{
		echo "Authentication Error ,Please try again";
	//sleep(10);

	//header("Location: http://localhost/test/index.php");
    //exit;
	}
	else{
		$conn = new mysqli($servername, $username, $password, $dbname);

		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		$query = "SELECT * FROM CUSTOMER where login_id='$myLoginId' and binary password='$myPassword'";
		$result = mysqli_query($conn,$query);
		$row = mysqli_fetch_assoc($result);

		if($result){
			if ($result->num_rows == 0) {
				$query = "SELECT * FROM CUSTOMER where login_id='$myLoginId'";
				$result = mysqli_query($conn,$query);
				$row = mysqli_fetch_assoc($result);
				if ($result->num_rows > 0) {
					echo "Customer ".$myLoginId." exists,but password not matches";
				} else{
					echo "LoginID ".$myLoginId."doesn't exists in the database";
				}
			} else{
				echo"Welcome customer:".'<b>'.$row['first_name'].'</b>'.'<b>'.$row['last_name'].'</b>';
				echo "<br>".$row['address'].",".$row['city'].",".$row['state']." ".$row['zipcode'];
				$Customer_cookie_name = "Customer_login_cookie";
				$cookie_value = $myLoginId;
				setcookie($Customer_cookie_name, $cookie_value, time() + (86400 * 30), "/");

				$ip =$_SERVER['REMOTE_ADDR'];
				echo "<br>Your IP:".$ip;
  			//echo "<br>Your Hostname".gethostbyaddr($ip);

				$ip_subnet=explode(".", $ip);
				if(($ip_subnet[0]=="131"and$ip_subnet[1]=="125") or ($ip_subnet[0]=="10"))  	{
  				echo"<br>You are from Kean University";
  			}
  			else {
  				echo"<br>You are not from Kean University";
  			}


				echo '<br><a href="logout.php">Customer logout</a>';


				echo '<br><a href="CPS5920_customer_display_customer.php">Update my data</a>';



			}
		}

	}

	?>
	<br><br><br><a href="index.html">Project home page</a>
</body>
</html>
