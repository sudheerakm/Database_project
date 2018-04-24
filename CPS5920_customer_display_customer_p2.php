<?php
include "dbconfig1.php";
//session_start();
//$myLoginId= $_SESSION["loginid_from_session"] ;
//echo "from session".$myLoginId;

$cookie_name = "Customer_login_cookie";

$myLoginId= $_COOKIE[$cookie_name];
if(!isset($_COOKIE[$cookie_name])) {
	echo"Please login first ";
}
else {
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$query = "SELECT * FROM CUSTOMER where login_id='$myLoginId'";
	$result = mysqli_query($conn,$query);
	if($result){
		if ($result->num_rows > 0) {
			?>

			<HTML>
				<a href='logout.php'>Customer logout</a><br>
				<form name='input' action='CPS5920_customer_update_customer.php' method='post' >
					<table border="1">
						<thead>
							<tr>
								<th>Customer_id</th>
								<th>Login</th>
								<th>Password</th>
								<th>FirstName </th>
								<th>LastName </th>
								<th>Telephone</th>
								<th>Address</th>
								<th>City</th>
								<th>Zipcode</th>
								<th>State</th>
							</tr>
						</thead>
						<tbody>
							<?php
							while( $row = mysqli_fetch_array($result) ){
								?>
								

								<tr><td bgcolor=yellow><?php echo $row['customer_id']?></td>
								<td bgcolor=yellow><?php echo $row['login_id']?></td>
								<td> <input type='text' size=8 name='password' value='<?php echo $row['password']?>'></td>
								<td> <input type='text' size=8 name='first_name' value='<?php echo $row['first_name']?>'></td>
								<td> <input type='text' size=8 name='last_name' value='<?php echo $row['last_name']?>'></td>
								<td> <input type='text' size=8 name='tel' value='<?php echo $row['tel']?>'</td>
								<td> <input type='text' size=8 name='address' value='<?php echo $row['address']?>'></td>
								<td> <input type='text' size=8 name='city' value='<?php echo $row['city']?>'></td>
								<td> <input type='text' size=6 name='zipcode' value='<?php echo $row['zipcode']?>'></td>
								<td> <select name='State'>
									
									<option value='AL' <?php echo ($row['state'] == 'AL') ? 'selected' : ''; ?>>Alabama</option>
									<option value='AK' <?php echo ($row['state'] == 'AK') ? 'selected' : ''; ?>>Alaska</option>
									<option value='AZ' <?php echo ($row['state'] == 'AK') ? 'selected' : ''; ?>>Arizona</option>
									<option value='AR' <?php echo ($row['state'] == 'AR') ? 'selected' : ''; ?>>Arkansas</option>
									<option value='CA' <?php echo ($row['state'] == 'CA') ? 'selected' : ''; ?>>California</option>
									<option value='CO' <?php echo ($row['state'] == 'CO') ? 'selected' : ''; ?>>Colorado</option>
									<option value='CT' <?php echo ($row['state'] == 'CT') ? 'selected' : ''; ?>>Connecticut</option>
									<option value='DE' <?php echo ($row['state'] == 'DE') ? 'selected' : ''; ?>>Delaware</option>
									<option value='FL' <?php echo ($row['state'] == 'FL') ? 'selected' : ''; ?>>Florida</option>
									<option value='GA' <?php echo ($row['state'] == 'GA') ? 'selected' : ''; ?>>Georgia</option>
									<option value='HI' <?php echo ($row['state'] == 'HI') ? 'selected' : ''; ?>>Hawaii</option>
									<option value='ID' <?php echo ($row['state'] == 'ID') ? 'selected' : ''; ?>>Idaho</option>
									<option value='IL' <?php echo ($row['state'] == 'IL') ? 'selected' : ''; ?>>Illinois</option>
									<option value='IN' <?php echo ($row['state'] == 'IN') ? 'selected' : ''; ?>>Indiana</option>
									<option value='IA' <?php echo ($row['state'] == 'ID') ? 'selected' : ''; ?>>Iowa</option>
									<option value='KS' <?php echo ($row['state'] == 'KS') ? 'selected' : ''; ?>>Kansas</option>
									<option value='KY' <?php echo ($row['state'] == 'KY') ? 'selected' : ''; ?>>Kentucky</option>
									<option value='LA' <?php echo ($row['state'] == 'LA') ? 'selected' : ''; ?>>Louisiana</option>
									<option value='ME' <?php echo ($row['state'] == 'ME') ? 'selected' : ''; ?>>Maine</option>
									<option value='MD' <?php echo ($row['state'] == 'MD') ? 'selected' : ''; ?>>Maryland</option>
									<option value='MA' <?php echo ($row['state'] == 'MA') ? 'selected' : ''; ?>>Massachusetts</option>
									<option value='MI' <?php echo ($row['state'] == 'MI') ? 'selected' : ''; ?>>Michigan</option>
									<option value='MN' <?php echo ($row['state'] == 'MN') ? 'selected' : ''; ?>>Minnesota</option>
									<option value='MS' <?php echo ($row['state'] == 'MS') ? 'selected' : ''; ?>>Mississippi</option>
									<option value='MO' <?php echo ($row['state'] == 'MO') ? 'selected' : ''; ?>>Missouri</option>
									<option value='MT' <?php echo ($row['state'] == 'MT') ? 'selected' : ''; ?>>Montana</option>
									<option value='NE' <?php echo ($row['state'] == 'NE') ? 'selected' : ''; ?>>Nebraska</option>
									<option value='NV' <?php echo ($row['state'] == 'NV') ? 'selected' : ''; ?>>Nevada</option>
									<option value='NH' <?php echo ($row['state'] == 'NH') ? 'selected' : ''; ?>>New Hampshire</option>
									<option value='NJ' <?php echo ($row['state'] == 'NJ') ? 'selected' : ''; ?>>New Jersey</option>
									<option value='NM' <?php echo ($row['state'] == 'NM') ? 'selected' : ''; ?>>New Mexico</option>
									<option value='NY' <?php echo ($row['state'] == 'NY') ? 'selected' : ''; ?>>New York</option>
									<option value='NC' <?php echo ($row['state'] == 'NC') ? 'selected' : ''; ?>>North Carolina</option>
									<option value='ND' <?php echo ($row['state'] == 'ND') ? 'selected' : ''; ?>>North Dakota</option>
									<option value='OH' <?php echo ($row['state'] == 'OH') ? 'selected' : ''; ?>>Ohio</option>
									<option value='OK' <?php echo ($row['state'] == 'OK') ? 'selected' : ''; ?>>Oklahoma</option>
									<option value='OR' <?php echo ($row['state'] == 'OR') ? 'selected' : ''; ?>>Oregon</option>
									<option value='PA' <?php echo ($row['state'] == 'PA') ? 'selected' : ''; ?>>Pennsylvania</option>
									<option value='RI' <?php echo ($row['state'] == 'RI') ? 'selected' : ''; ?>>Rhode Island</option>
									<option value='SC' <?php echo ($row['state'] == 'SC') ? 'selected' : ''; ?>>South Carolina</option>
									<option value='SD' <?php echo ($row['state'] == 'SD') ? 'selected' : ''; ?>>South Dakota</option>
									<option value='TN' <?php echo ($row['state'] == 'TN') ? 'selected' : ''; ?>>Tennessee</option>
									<option value='TX' <?php echo ($row['state'] == 'TX') ? 'selected' : ''; ?>>Texas</option>
									<option value='UT' <?php echo ($row['state'] == 'UT') ? 'selected' : ''; ?>>Utah</option>
									<option value='VT' <?php echo ($row['state'] == 'VT') ? 'selected' : ''; ?>>Vermont</option>
									<option value='VA' <?php echo ($row['state'] == 'VA') ? 'selected' : ''; ?>>Virginia</option>
									<option value='WA' <?php echo ($row['state'] == 'WA') ? 'selected' : ''; ?>>Washington</option>
									<option value='WV' <?php echo ($row['state'] == 'WV') ? 'selected' : ''; ?>>West Virginia</option>
									<option value='WI' <?php echo ($row['state'] == 'WI') ? 'selected' : ''; ?>>Wisconsin</option>
									<option value='WY' <?php echo ($row['state'] == 'WY') ? 'selected' : ''; ?>>Wyoming</option>
									
								</select>
								</td>
										
								</tr>
								
								
								
								</select>
											
								
							</td></tr>
							<?php		
						}

					}
					else{
						echo"<br>No records in the database.\n";
						mysqli_free_result($result);

					}
				}
				else{ 
					echo"<br>No result set return from the database.\n";   
				}
				mysqli_close($conn);
			}      
			?>
			</tbody>
			</table>
	<input type='submit' value='Update information'>
	<br><a href='CPS5920_customer_check_p2.php'>Customer's home page</a>	
	<br><a href='index.html'>project home page</a>
</HTML>
