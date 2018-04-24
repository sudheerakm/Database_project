<HTML>
<link rel = "stylesheet" type = "text/css" href="Style.css"/>
<a href='logout.php'><center>Employee logout</center></a><br>
<body>
<font size=4><b><center>Add products</center></b></font>
<form name="input" action="CPS5920_product_insert.php" method="post" >
<br> Product Name: <input type="text" name="product_name" required="required">
<br> description: <input type="text" name="description" required="required">
<br> Cost: <input type="text" name="cost" required="required">
<br> Sell Price: <input type="text" name="sell_price" required="required">
<br> Quantity: <input type="text" name="quantity" required="required">

<br>Select vendor: 
<SELECT name='vendor_id'>

<?php
include "dbconfig1.php";

$conn = new mysqli($servername, $username, $password, $dbname);	 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$results = mysqli_query($conn,"SELECT vendor_id,name FROM CPS5920.VENDOR");
while( $row = mysqli_fetch_array($results) ){
?> 


<option value=<?php echo($row['vendor_id'])?>> <?php echo($row['name'])?> </option> 
<!-- <option value='AL' <?php echo ($row['state'] == 'AL') ? 'selected' : ''; ?>>Alabama</option> -->
<?php
}
?>
</SELECT>

<br><input type='hidden' name='employee_id' value='1'>
<br><input type='submit' value='Submit'>
</form>
</body>
</HTML>
