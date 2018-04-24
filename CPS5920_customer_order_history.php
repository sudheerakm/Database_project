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
  include "dbconfig1.php";
// Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $query = "SELECT id FROM ORDERS where id is not null ";
  $result = mysqli_query($conn,$query);
  if($result){
    if ($result->num_rows > 0 ) {
      echo "Your order history";   
      $total_paid = 0;
      while( $row = mysqli_fetch_array($result) ){

        $orderid=$row['id'];
        $details_query = 
        "SELECT o.id,p.name,po.quantity,p.sell_price,(po.quantity*p.sell_price) as sub_total, o.date from PRODUCT p,PRODUCT_ORDER po, ORDERS o where po.product_id=p.id and po.order_id=o.id and po.order_id=$orderid";

        $details_result = mysqli_query($conn,$details_query);
        if($details_result){
          if ($details_result->num_rows > 0) {
            $total_value=0;
            ?>
            <table border="1">
             <thead>
               <tr>
                <th><b>Order ID</b></th>
                <th><b>Product Name</b></th>
                <th><b>Order Quantity</b></th>
                <th><b>Unit Price </b></th>
                <th><b>Subtotal</b></th>
                <th><b>Order Date</b></th>
              </tr>
            </thead>
            <tbody>
              <?php
              while( $details_row = mysqli_fetch_array($details_result) ){
                $price = $details_row['sub_total'];

                echo "<tr><td>{$details_row['id']}</td>
                <td>{$details_row['name']}</td>
                <td>{$details_row['quantity']}</td>
                <td>{$details_row['sell_price']}</td>
                <td>{$price}</td>
                <td>{$details_row['date']}</td>
              </tr>\n";
              $total_value=$total_value+$price;
              $total_paid+=$total_value;
            }
            echo "<tr><td></td><td>order paid</td><TD colspan=2 align=right></td><td>".$total_value."</td></tr>\n";
          }    
        }
        else{
          echo"<br>No records in the database.\n";
          mysqli_free_result($result);

        }
        ?>
      </tbody>
    </table>
    <br> 

    <?php
  }
  echo "<table border=1>
  <tr><td>Total Paid</td><td>".$total_paid."</td></tr>
</table>";
}
else{ 
  echo"<br>No result set return from the database.\n";   
}

}
mysqli_close($conn);
?>


</body>
</html>