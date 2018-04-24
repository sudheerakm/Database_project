<html>
<body>
	<a href='logout.php'>Customer logout</a><br>

	<?php
	include "dbconfig1.php";

	$cookie_name = "Customer_login_cookie";	
	
	if(!isset($_COOKIE[$cookie_name])) {
			echo"Please login first ";
	}
	else{
		$myLoginId=$_COOKIE[$cookie_name];
		$conn = new mysqli($servername, $username, $password, $dbname);	 
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		$size=count($_POST['quantity']);
		$i = 0;
		validateOrderQty($size, $i);

		$isOrderIdNotCreated = true;
		$subTotal = 0;
		$total = 0;
		?>
		
		<?php
		while ($i < $size) {
			$myPname=$_POST['pname'][$i];			
			$myDescription=$_POST['description'][$i];			
			$mysell_price=$_POST['sell_price'][$i];
			$myAvailablequantity=$_POST['quantity'][$i];
			$myOrderquantity=$_POST['order_quantity'][$i];
			$myVendorName=$_POST['name'][$i];
			++$i;
			try{
					// $conn->beginTransaction(MYSQLI_TRANS_START_READ_ONLY);
				// mysqli_begin_transaction($conn);
				// Auto Commit on
				// mysqli_autocommit($conn, false); 

					$conn->autocommit(FALSE); 
					$productQtyquery="SELECT quantity from PRODUCT WHERE name='$myPname'";
					$productQty_result = mysqli_query($conn,$productQtyquery);
					$productQty_row = mysqli_fetch_assoc($productQty_result);
					$pqty=$productQty_row['quantity'];
					if($pqty < $myOrderquantity){
						echo "<br>Not enough quantity for product ".$myPname.". This order did not go through";
						break;
						// exit;
					}

					if($isOrderIdNotCreated){
						echo "<b> Your Order List</b>
						<table border=2>
							<tbody>
								<tr><td>Product name</td><td>Unit Price</td><td>Quantity</td><td>Sub Total</t></tr>
							</tbody>";
						// get customer id by loginid
						$CustomerIdquery="SELECT customer_id from CUSTOMER WHERE login_id='$myLoginId'";
						$Customer_result = mysqli_query($conn,$CustomerIdquery);
						$Customer_row = mysqli_fetch_assoc($Customer_result);
						$myCustomerId=$Customer_row['customer_id'];

						// insert customerid in Orders
						$InsertOrderquery="INSERT INTO ORDERS(customer_id,date) VALUES ($myCustomerId,NOW())";
						$InsertOrderquery_result = mysqli_query($conn,$InsertOrderquery);

						// select Order id from Orders
						$selectOrderIdQuery = "select id from ORDERS where customer_id=$myCustomerId order by date DESC limit 1;";
						$selectOrderIdQuery_result = mysqli_query($conn,$selectOrderIdQuery);
						$selectOrderIdQuery_row = mysqli_fetch_assoc($selectOrderIdQuery_result);
						$myOrderId=$selectOrderIdQuery_row['id'];

						$isOrderIdNotCreated = false;
					}

					if($myOrderquantity!='' && $myOrderquantity>0){
						// update order quantity
						$Updatequery="UPDATE PRODUCT set quantity = quantity-$myOrderquantity where name='$myPname'";
						$Update_result = mysqli_query($conn,$Updatequery);

						// select Product Id from PRODUCT
						$selectProductIdQuery = "SELECT id from PRODUCT WHERE name='$myPname'";
						$selectProductIdQuery_result = mysqli_query($conn,$selectProductIdQuery);
						$selectProductIdQuery_row = mysqli_fetch_assoc($selectProductIdQuery_result);
						$myProductId=$selectProductIdQuery_row['id'];

						// Insert order_id, quantity in Product_Order table
						$InsertOrderquery="INSERT INTO PRODUCT_ORDER(order_id,product_id,quantity) VALUES ($myOrderId,$myProductId,$myOrderquantity)";
						$InsertOrderquery_result = mysqli_query($conn,$InsertOrderquery);
						
						$subTotal = ($mysell_price*$myOrderquantity);
						$total+=$subTotal;

						echo "<tr><td>".$myPname."</td><td>".$mysell_price."</td><td>".$myOrderquantity."</td><td>".$subTotal."</td></tr>";
					}
					// commit the transaction
            		//	$conn->commit();
            		// mysqli_commit($conn);
            		$conn->commit(); //commit the transaction
                	$conn->autocommit(TRUE); //set auto commit to true
               		//$conn->close();
			} catch (Exception $e){
				 echo $e;
				  $conn->rollback();
           		  	  $conn->autocommit(TRUE);
            	  		$conn->close();
				 // $conn->rollBack();
				 // mysqli_rollback($conn);
           		 // die($e->getMessage());
			}
		}
			echo "<tr><td colspan=3>Total</td><td>".$total."</td></tr>";
		?>
		</table>
		<br><a href='CPS5920_customer_check_p2.php'>Customer's home page</a>
		<br><a href='index.html'>project home page</a>
		<?php
	}	

	function validateOrderQty($size, $i){
		$isOrderQtyEmpty = true;
		

		while ($i < $size) {
			$myPname=$_POST['pname'][$i];			
			$myDescription=$_POST['description'][$i];			
			$mysell_price=$_POST['sell_price'][$i];
			$myAvailablequantity=$_POST['quantity'][$i];
			$myOrderquantity=$_POST['order_quantity'][$i];
			$myVendorName=$_POST['name'][$i];

			if($myOrderquantity==''){
				++$i;
				continue;
			}else if($myOrderquantity==0){
				echo "Error! you place order with all quantities in 0 ";
				exit;
			}else if($myOrderquantity<0){
				echo "Error, the item: <b>".$myPname."</b> cannot have negative amount order: ".$myOrderquantity;
				exit;
			}
			else if($myOrderquantity>$myAvailablequantity)
			{
				echo "<br>Not enough quantity for product <b>".$myPname.".</b> This order did not go through";
				exit;
			}
			$isOrderQtyEmpty = false;
			++$i;
		}
		if($isOrderQtyEmpty){
			echo "Error! you place order with all quantities in 0 ";
			exit;
		}
	}
		?>
	</body>
	</html>
