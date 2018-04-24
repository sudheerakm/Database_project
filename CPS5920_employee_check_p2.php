	<!DOCTYPE html>
	<html>
	<body>

		<?php

		include "dbconfig.php";
		$cookie_name = "Employee_login_cookie";

		if(!isset($_COOKIE[$cookie_name])) {
			$myLoginId= $_POST['login_id'];
			$myPassword=hash('sha256', $_POST['password']);

			if(($myLoginId== "")||($myPassword==""))
			{
				echo "Please enter valid LoginID and Password";

			}
			else{
				$conn = new mysqli($servername, $username, $password, $dbname);

				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				}
				$login_id=mysqli_real_escape_string($conn,$myLoginId);
				$password=mysqli_real_escape_string($conn,$myPassword);

				$query = "SELECT * FROM EMPLOYEE2 where login='$login_id' and binary password='$password'";
				$result = mysqli_query($conn,$query);
				$row = mysqli_fetch_assoc($result);

				if($result){
					if ($result->num_rows == 0) {
						$query = "SELECT * FROM EMPLOYEE2 where login='$login_id'";
						$result = mysqli_query($conn,$query);
						$row = mysqli_fetch_assoc($result);
						if ($result->num_rows > 0) {
							echo "Employee ".$login_id." exists,but password not matches";
						} else{
							echo "LoginID ".$login_id." doesn't exists in the database";
						}
					} else{
						$cookie_name = "Employee_login_cookie";
						$cookie_value = $login_id;
						setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");						
						checkRole($row['name'],$row['role']);
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
			$query = "SELECT * FROM EMPLOYEE2 where login='$myLoginId'";
			$result = mysqli_query($conn,$query);
			$row = mysqli_fetch_assoc($result);
			$role= $row['role'];
			$name= $row['name'];
			checkRole($name,$role);
		}
		

		function checkRole($name, $role){
			if($role=='M'){
				echo"Welcome manager:".'<b>'.$name.'</b>';
				echo '<br><a href="logout.php">Manager logout</a>';
				?>	
				<br><br><a href="CPS5920_product_add.php">Add products</a>
				<br><a href="CPS5920_view_vendors_p2.php">View all vendors</a>
				<br><a href="CPS5920_employee_search_product.php">Search & update product</a>
				<form name="input" action="CPS5920_view_report.php" method="post" >
					View Reports -
					period:
					<select name='report_period'>
						<option value="all">all</option>
						<option value="past_week">past week</option>
						<option value="current_month">current month</option>
						<option value="past_month">past month</option>
						<option value="this_year">this year</option>
						<option value="past_year">past year</option>
					</select>
					, by:
					<select name='report_type'>
						<option value="all">all sales</option>
						<option value="products">products</option>
						<option value="vendors">vendors</option>
					</select>
					<input type="submit" value="Submit">
				</form>
				<?php
			}
			elseif ($role=='E') {
				echo"Welcome employee:".'<b>'.$name.'</b>';
				echo '<br><a href="logout.php">Employee logout</a>';
				?>
				<br><br><a href="CPS5920_product_add.php">Add products</a>
				<br><a href="CPS5920_view_vendors_p2.php">View all vendors</a>
				<br><a href="CPS5920_employee_search_product.php">Search & update product</a>
				<?php
			}
		}

		?>

	</body>
	</html>


