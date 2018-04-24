<!DOCTYPE html>
<html>
<style>
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
  $mySearchItems= $_GET['search_items'];
  include "dbconfig1.php";

  $Customer_cookie_name = "Customer_login_cookie";

  $search_cookie_name = "search_cookie";
  $search_cookie_value = $mySearchItems;
  setcookie($search_cookie_name, $search_cookie_value, time() + (86400 * 30), "/");

  if(!isset($_COOKIE[$Customer_cookie_name])) {
// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    
    if($mySearchItems=='*'){
      $query = "SELECT p.name as pname,p.description,p.sell_price,p.quantity,v.name from PRODUCT p,CPS5920.VENDOR v WHERE p.vendor_id=v.vendor_id";
    }
    else{
      $query = "SELECT p.name as pname,p.description,p.sell_price,p.quantity,v.name from PRODUCT p,CPS5920.VENDOR v WHERE p.vendor_id=v.vendor_id 
      and (lower(p.name) LIKE lower('%$mySearchItems%') OR lower(p.description) LIKE lower('%$mySearchItems%'))";
    }
    
    $Visitor_result = mysqli_query($conn,$query);
    if($Visitor_result){
      if ($Visitor_result->num_rows > 0) {  	
        echo '<a href="CPS5920_customer_login_p2.php">Customer login</a>';  
        echo "<br>Available product list for search keyword:".'<b>'.$mySearchItems.'</b>';
        ?>

        <table border="1">
         <thead>
           <tr>
            <th>Product Name</th>
            <th>Description</th>
            <th>Sell price</th>
            <th>Available quantity </th>
            <th>Vendor name </th>
          </tr>
        </thead>
        <tbody>
          <?php
          while( $row = mysqli_fetch_array($Visitor_result) ){
            echo "<tr><td>{$row['pname']}</td>
            <td>{$row['description']}</td>
            <td>{$row['sell_price']}</td>
            <td>{$row['quantity']}</td>
            <td>{$row['name']}</td>\n";          
          }    
          ?>
            </tbody>
          </table>
          <?php
        }
        else{
          echo"<br>No records in the database.\n";          
          mysqli_free_result($Visitor_result);

        }
      }
      else{ 
        echo"<br>No result set return from the database.\n";   
      }
      mysqli_close($conn);
    }
    else{
      $myLoginId= $_COOKIE[$Customer_cookie_name];
      $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      if($mySearchItems=='*'){
        $Customer_query = "SELECT p.name as pname,p.description,p.sell_price,p.quantity,v.name from PRODUCT p,CPS5920.VENDOR v WHERE p.vendor_id=v.vendor_id";
      }
      else{
        $Customer_query = "SELECT p.name as pname,p.description,p.sell_price,p.quantity,v.name from PRODUCT p,CPS5920.VENDOR v WHERE p.vendor_id=v.vendor_id 
        and (lower(p.name) LIKE lower('%$mySearchItems%') OR lower(p.description) LIKE lower('%$mySearchItems%'))";
      }
      $result = mysqli_query($conn,$Customer_query);
      if($result){
        if ($result->num_rows > 0) {    
          echo '<a href="logout.php">Customer logout</a>';  
          echo"<br>Available product list for search keyword:".'<b>'.$mySearchItems.'</b>';
          ?>
          
         <form name='input' action='CPS5920_customer_order.php' method='post' >
          <table border="1">
           <thead>
             <tr>
              <th>Product Name</th>
              <th>Description</th>
              <th>Sell price</th>
              <th>Available quantity </th>
              <th>Order quantity </th>
              <th>Vendor name </th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i=0;
            while( $row = mysqli_fetch_array($result) ){
              echo "<tr><td>{$row['pname']}<input type='hidden' name='pname[$i]' value='{$row['pname']}'></td>";
              echo "<td>{$row['description']}<input type='hidden' name='description[$i]' value='{$row['description']}'></td>";              
              echo "<td>{$row['sell_price']}<input type='hidden' name='sell_price[$i]' value='{$row['sell_price']}'></td>";
              echo "<td>{$row['quantity']}<input type='hidden' name='quantity[$i]' value='{$row['quantity']}'></td>";
              echo "<td> <input type='text' size=10 name='order_quantity[$i]'></td>";
              echo "<td>{$row['name']}<input type='hidden' name='name[$i]' value='{$row['name']}'></td>";
              ++$i;                      
            }
            
            ?>

            </tbody>
          </table>
          <input type='submit' value='Place Order'>
          <br><a href='CPS5920_customer_check_p2.php'>Customer's home page</a>
          <?php      
          }
          else{
            echo"<br>No records in the database.\n";
            setcookie($search_cookie_name, "OTHER", time() + (86400 * 30), "/");
            mysqli_free_result($result);

          }
        }
        else{ 
          echo"<br>No result set return from the database.\n";   
        }
        mysqli_close($conn);

      }

      ?>
     
  <br><a href='index.html'>project home page</a>
</body>
</html>
