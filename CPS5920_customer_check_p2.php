<!DOCTYPE html>
<html>
<body>

	<?php
	//session_start();

	include "dbconfig1.php";
	$cookie_name = "Customer_login_cookie";
	
	
	if(!isset($_COOKIE[$cookie_name])) {

		$myLoginId= $_POST['login_id'];
		$myPassword=$_POST['password'];

		if(($myLoginId== "")||($myPassword=="")){

			echo "Authentication Error ,Please try again";

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

					$Customer_cookie_name = "Customer_login_cookie";
					$cookie_value = $myLoginId;
					setcookie($Customer_cookie_name, $cookie_value, time() + (86400 * 30), "/");
					checkName($row['first_name'],$row['last_name'],$row['address'],$row['city'],$row['state'],$row['zipcode']);
				}
			}

		}
	}
	else{
		$myLoginId= $_COOKIE[$cookie_name];
		$conn = new mysqli($servername, $username, $password, $dbname);

		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		$query = "SELECT * FROM CUSTOMER where login_id='$myLoginId'";
		$result = mysqli_query($conn,$query);
		$row = mysqli_fetch_assoc($result);			
		checkName($row['first_name'],$row['last_name'],$row['address'],$row['city'],$row['state'],$row['zipcode']);
	}
	function checkName($fname,$lname,$address,$city,$state,$zipcode){
		echo"Welcome customer:".'<b>'.$fname.'</b>'.'<b>'.$lname.'</b>';
		echo "<br>".$address.",".$city.",".$state." ".$zipcode.'</b>';
		$ip =$_SERVER['REMOTE_ADDR'];
		echo "<br>Your IP:".$ip;
		$ip_subnet=explode(".", $ip);
		if(($ip_subnet[0]=="131"and$ip_subnet[1]=="125") or ($ip_subnet[0]=="10"))  	{
			echo"<br>You are from Kean University";
		}
		else {
			echo"<br>You are not from Kean University";
		}
		?>
		<br><a href="logout.php">Customer logout</a>
		<br><a href="CPS5920_customer_display_customer_p2.php">Update my data</a>		
		<br><a href='CPS5920_customer_order_history.php'>View my order history</a>
		<br>search product (* for all):
		<form name="input" action="CPS5920_search_product.php" method="get" >
			<input type="text" name="search_items">
			<input type="submit" value="Search">
		</form>		

		<?php
		$search_cookie_name = "search_cookie";
		$category="OTHER";
		if(isset($_COOKIE[$search_cookie_name]) && $_COOKIE[$search_cookie_name]!='*'){
			$category= $_COOKIE[$search_cookie_name];
		}

		include "dbconfig.php";
		$conn = new mysqli($servername, $username, $password, $dbname);

		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		$Imagequery = "SELECT image,description,url from CPS5920.Advertisement where category like '%$category%'";
		
		$result = mysqli_query($conn,$Imagequery);
		$row = mysqli_fetch_assoc($result);	
		$img= $row['image'] ;
		$text=$row['description'] ;
		$url=$row['url'] ;
		echo "<br><a href='$url' target='_blank'>
		 <img src='data:image/jpeg;base64," . base64_encode($img) ."'/></a>\n";
		echo "<br>".$text;
		echo '<br><br><a href="index.html">Project home page</a>';
	}

	?>
	
</body>
</html>