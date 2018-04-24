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
  <a href='logout.php'>Employee logout</a><br>  
    <?php
    $mySearchItems= $_POST['search_items'];
    include "dbconfig1.php";
  $cookie_name = "Employee_login_cookie";

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
    if($mySearchItems=='*'){
      $query = "select p.id,p.name as pname,p.description,p.cost,p.sell_price,p.quantity,v.name as vname from PRODUCT p,CPS5920.VENDOR v WHERE p.vendor_id=v.vendor_id";
    }
    else{
      $query = "select p.id,p.name as pname,p.description,p.cost,p.sell_price,p.quantity,v.name as vname from PRODUCT p,CPS5920.VENDOR v WHERE p.vendor_id=v.vendor_id 
      and (lower(p.name) LIKE lower('%$mySearchItems%') OR lower(p.description) LIKE lower('%$mySearchItems%'))";
    }
    $result = mysqli_query($conn,$query);
    if($result){
      if ($result->num_rows > 0) {  	
        echo"<br>Available product list for search keyword:".'<b>'.$mySearchItems.'</b>';
        ?>
        <form name='input' action='CPS5920_employee_update_product.php' method='post' >
          <input type="hidden" name="updatedPID" />
          <table border="1">
           <thead>
             <tr>
              <th>Product ID</th>
              <th>Product Name</th>
              <th>Description</th>
              <th>Cost</th>
              <th>Sell price</th>
              <th>Available quantity </th>
              <th>Vendor name </th>
              <th>Last update by </th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i=0;
            while( $row = mysqli_fetch_array($result) ){
              echo '<tr>';
              echo "<td>{$row['id']}<input type='hidden' name='id[$i]' value='{$row['id']}'></td>";
              echo "<td><input type='text' size=8 name='product_name[$i]' value='{$row['pname']}' ></td>";
              echo "<td><input type='text' size=8 name='Description[$i]' value='{$row['description']}'></td>";
              echo "<td><input type='text' size=8 name='cost[$i]' value='{$row['cost']}'></td>";
              echo "<td><input type='text' size=8 name='sell_price[$i]' value='{$row['sell_price']}'></td>";
              echo "<td><input type='text' size=8 name='quantity[$i]' value='{$row['quantity']}'></td>";
              echo "<td> <select name='vendor_id[$i]'>";
                  $results = mysqli_query($conn,"SELECT vendor_id,name FROM CPS5920.VENDOR");
                  while( $vendor_row = mysqli_fetch_array($results) ){
              ?> 
                    <option 
                      value='<?php echo($vendor_row['vendor_id'])?>' <?php echo ($vendor_row['name'] == $row['vname']) ? 'selected' : ''; ?>>
                      <?php echo($vendor_row['name'] )?> </option>
              <?php   
                  }
                echo "</SELECT></td>";           
               
                $nameQuery = "SELECT name FROM CPS5920.EMPLOYEE2 where login='$myLoginId'";
                $nameResult = mysqli_query($conn,$nameQuery);  
                $name_row= mysqli_fetch_assoc($nameResult);
                ?>
                <td>
                  <?php 
                  echo $name_row['name']
                  ?></td>
                <?php
                ++$i;
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
      <br><input type='submit' value='Update Products'>
    <br><a href='CPS5920_employee_check_p2.php'>Employee home page</a>
    <br><a href='index.html'>project home page</a>

  
    <!-- <script>
      function check(val) {
        alert("The input value has changed. The new value is: " + val);
        alert("checkme["+val+"]");
        alert(document.getElementById("checkme[0]").value);
        document.getElementById("checkme[0]").value = "chandra";
      }
    </script> -->
    </body>
    </html>
    


    
