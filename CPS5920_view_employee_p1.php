<!DOCTYPE html>
<html>
<style>
body  {
    background-image: url("image.jpg");
    /*background-color: #cccccc;*/
}
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
include "dbconfig.php";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$query = "SELECT * FROM EMPLOYEE";
$result = mysqli_query($conn,$query);
if($result){
  if ($result->num_rows > 0) {
  echo "<p align=left>The following employee are in the database</p>";   
  ?>
  <table border="1">
   <thead>
   <tr>
      <th><b>ID</b></th>
      <th><b>Login</b></th>
      <th><b>Password</b></th>
      <th><b>Name </b></th>
      <th><b>Role</b></th>
    </tr>
    </thead>
    <tbody>
    <?php
     while( $row = mysqli_fetch_array($result) ){
          echo "<tr><td>{$row['employee_id']}</td>
          <td>{$row['login']}</td>
          <td>{$row['password']}</td>
          <td>{$row['name']}</td>
          <td>{$row['role']}</td></tr>\n";
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
    ?>
    </tbody>
  </table> 

</body>
</html>
