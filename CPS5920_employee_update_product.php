<html>
<body>
	<a href='logout.php'>Employee logout</a><br>
	<?php
	include "dbconfig1.php";
//session_start();
//$myLoginId= $_SESSION["loginid_from_session"] ;
//echo "from session".$myLoginId;
	$cookie_name = "Employee_login_cookie";
	if(!isset($_COOKIE[$cookie_name])) {
		echo"Please login first ";
	}
	else {
		$conn = new mysqli($servername, $username, $password, $dbname);	 
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}		

		$size=count($_POST['id']);
		$i = 0;
		$no_of_updated_rows=0;
		while ($i < $size) {
			$myID=$_POST['id'][$i];
			$myProductName=$_POST['product_name'][$i];
			$myDescription=$_POST['Description'][$i];
			$mycost=$_POST['cost'][$i];
			$mysell_price=$_POST['sell_price'][$i];
			$myquantity=$_POST['quantity'][$i];
			$myVendor_id=$_POST['vendor_id'][$i];

			if(emptyCheck($myProductName)){
				echo "Please enter product name";
				exit;
			}
			if(emptyCheck($myDescription)){
				echo "Please enter product description";
				exit;
			}
			if(numberNegativeCheck($mycost)){
				echo "Please enter product cost";
				exit;
			}
			if(numberNegativeCheck($mysell_price)){
				echo "Please enter product sell price";
				exit;
			}
			if(numberNegativeCheck($myquantity)){
				echo "Please enter product quantity";
				exit;
			}

			$fetchQuery="select * from PRODUCT where id=$myID";
			$fetch_result = mysqli_query($conn,$fetchQuery);
			if($fetch_result){
				if ($fetch_result->num_rows > 0) {
					while( $fetch_row = mysqli_fetch_array($fetch_result)){
						$dbProdName=$fetch_row['name'];
						$dbDescription=$fetch_row['description'];
						$dbCost=$fetch_row['cost'];
						$dbSellPrice=$fetch_row['sell_price'];
						$dbQty=$fetch_row['quantity'];
						$updated=false;
						if($myProductName!=$dbProdName){
							$updated=true;
						}else if($myDescription!=$dbDescription){
							$updated=true;
						}else if($mycost!=$dbCost){
							$updated=true;
						}else if($mysell_price!=$dbSellPrice){
							$updated=true;
						}else if($myquantity!=$dbQty){
							$updated=true;
						}
					}
				}
			}
			if($updated){
				$query = "UPDATE PRODUCT set name='$myProductName',description='$myDescription',cost='$mycost',sell_price='$mysell_price',quantity='$myquantity',vendor_id='$myVendor_id' where id= '$myID'";

				if ($conn->query($query) === TRUE) {
					echo '<br>'."Successfully updated product ID: $myID";
				} else {
					echo "Error: " . $query . "<br>" . $conn->error;
				}
				++$no_of_updated_rows;
			}
			++$i;
		}
		$conn->close();
		if($no_of_updated_rows==0){
			echo '<br>'."No product was updated.";
		}else if($no_of_updated_rows==1){
			echo '<br>'."Only one product was updated.";
		}else{
			echo '<br>'.$no_of_updated_rows." products were updated";
		}
		
	}	

	function emptyCheck($value){
		if($value=='' || $value==' '){
			return true;
		}
		return false;
	}
	function numberNegativeCheck($value){
		if(emptyCheck($value) || $value<0){
			return true;
		}
		return false;
	}
	?>
	<br><a href='CPS5920_employee_check_p2.php'>Employee home page</a>
	<br><a href='index.html'>project home page</a>
</body>
</html>

















































