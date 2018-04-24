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

include "dbconfig.php";

	$myLoginId= $_POST['login_id'];
	$myPassword=$_POST['password'];

if(($myLoginId== "")||($myPassword==""))
{
	echo "Please enter valid LoginID and Password";
	//sleep(10);
	
	//header("Location: http://localhost/test/index.php");
    //exit;
}
else{
	 $conn = new mysqli($servername, $username, $password, $dbname);
	 
	 if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	 }
	 
	 $query = "SELECT * FROM EMPLOYEE where login='$myLoginId' and binary password='$myPassword'";
	 $result = mysqli_query($conn,$query);
	 $row = mysqli_fetch_assoc($result);
	
	 if($result){
 		if ($result->num_rows == 0) {
 			$query = "SELECT * FROM EMPLOYEE where login='$myLoginId'";
	 		$result = mysqli_query($conn,$query);
	 		$row = mysqli_fetch_assoc($result);
	 		if ($result->num_rows > 0) {
	 			echo "Employee ".$myLoginId." exists,but password not matches";
	 		} else{
	 			echo "LoginID ".$myLoginId." doesn't exists in the database";
	 		}
  		} else{
  			$cookie_name = "Employee_login_cookie";
			$cookie_value = $myLoginId;
			setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
  			
  			$ip =$_SERVER['REMOTE_ADDR'];
  			echo "Your IP:".$ip;
  			//echo "<br>Your Hostname".gethostbyaddr($ip);

  			$ip_subnet=explode(".", $ip);
  			if(($ip_subnet[0]=="131"and$ip_subnet[1]=="125") or ($ip_subnet[0]=="10"))  	{
  				echo"<br>You are from Kean University";
  			}
  			else {
  				echo"<br>You are not from Kean University";
  			}
  			if($row['role']=='M'){
  				echo"<br>Welcome manager:".'<b>'.$row['name'].'</b>';
  				echo '<br><a href="logout.php">Manager logout</a>';
  			}
  			elseif ($row['role']=='E') {
  				echo"<br>Welcome employee:".'<b>'.$row['name'].'</b>';
  				echo '<br><a href="logout.php">Employee logout</a>';
  			}
  			

  		}
	 }
	 
	}
 
?>
</body>
</html>
  

