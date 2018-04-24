<!DOCTYPE html>
<html>
<style>

body  {
    background-image: url("image.jpg");
    /*background-color: #cccccc;*/
}

/*ul { display:table; margin:0 auto;}*/

table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    text-align: left;
    padding: 8px;
}

th {
    background-color: #4CAF50;
    color: white;
}
</style>
<body>

<?php

include "dbconfig1.php";
$cookie_name = "Employee_login_cookie"; 
if(!isset($_COOKIE[$cookie_name])) {
 echo"This page is for employee only,Please login first as a employee/manager";
}
else{
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$query = "SELECT * FROM CUSTOMER";
$result = mysqli_query($conn,$query);
if($result){
  if ($result->num_rows > 0) {
  echo "<p align=left>The following customers are in the database</p>";   
  ?>
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
          echo "<tr><td>{$row['customer_id']}</td>
          <td>{$row['login_id']}</td>
          <td>{$row['password']}</td>
          <td>{$row['first_name']}</td>
          <td>{$row['last_name']}</td>
          <td>{$row['tel']}</td>
          <td>{$row['address']}</td>
          <td>{$row['city']}</td>
          <td>{$row['zipcode']}</td>
          <td>{$row['state']}</td></tr>\n";
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

</body>
</html>
