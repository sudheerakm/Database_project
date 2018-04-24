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
  $cookie_name = "Employee_login_cookie";

  if(!isset($_COOKIE[$cookie_name])) {

    echo "Please Login as Manager first";

  }
  else{
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    $myReportPeriod= $_POST['report_period'];
    $myReportType=$_POST['report_type'];
    echo "Report by <b>".$myReportPeriod."</b> during period: <b>".$myReportType."</b>";
    // Report by products during period: all
    if($myReportType=='all'){
      $query  = buildQuery($myReportPeriod,$myReportType);
      $result = mysqli_query($conn,$query);
      if($result){
        if ($result->num_rows > 0 ) {
          
          echo "<table border='1'>
          <thead>
           <tr>
             <th><b>#</b></th>
             <th><b>Product Name</b></th>
             <th><b>Vendor name</b></th>
             <th><b>Unit cost</b></th>
             <th><b>Current Quantity </b></th>
             <th><b>Sold Quantity</b></th>
             <th><b>Sold Unit Price</b></th>
             <th><b> Sub Total</b></th>
             <th><b> Profit</b></th>
             <th><b>Customer Name</b></th>
             <th><b>Order Date</b></th>
           </tr>
         </thead>
         <tbody>";
          $row_count = 0;
          $subtotal_sum = 0;
          $profit_sum = 0;
          while( $row = mysqli_fetch_array($result) ){
            $row_count++;
            echo "<tr><td>$row_count</td>
            <td>{$row['pname']}</td>
            <td>{$row['name']}</td>
            <td>{$row['cost']}</td>
            <td>{$row['current_quantity']}</td>
            <td>{$row['sold_quantity']}</td>
            <td>{$row['sell_price']}</td>
            <td>{$row['subtotal']}</td>
            <td>{$row['profit']}</td>
            <td>{$row['cname']}</td>
            <td>{$row['date']}</td>
          </tr>\n";
          $subtotal_sum+=$row['subtotal'];
          $profit_sum+=$row['profit'];
        }
        echo "<tr><td>Total</td>
        <td colspan=6></td>
        <td>$subtotal_sum</td>
        <td>$profit_sum</td>
        <td colspan=2></td>
      </tr>\n";
    }
    else{
      echo"<br>No records in the database.\n";
      mysqli_free_result($result);
    }
  } 
  else { 
    echo"<br>No result set return from the database.\n";   
  }
  echo "</tbody></table>";    
}

// Report by products during period: all
else if($myReportType=='products'){
  $query  = buildQuery($myReportPeriod,$myReportType);
  $result = mysqli_query($conn,$query);
  if($result){
    if ($result->num_rows > 0 ) {
      
      echo "<table border='1'>
      <thead>
       <tr>
         <th><b>#</b></th>
         <th><b>Product Name</b></th>
         <th><b>Vendor name</b></th>
         <th><b>Avg unit cost</b></th>
         <th><b>Current quantity </b></th>
         <th><b>Sold quantity</b></th>
         <th><b>Avg sold qnit price</b></th>
         <th><b> Sub Total</b></th>
         <th><b> Profit</b></th>
       </tr>
     </thead>
     <tbody>";
      $row_count = 0;
      $subtotal_sum = 0;
      $profit_sum = 0;
      while( $row = mysqli_fetch_array($result) ){
        $row_count++;
        echo "<tr><td>$row_count</td>
        <td>{$row['pname']}</td>
        <td>{$row['name']}</td>
        <td>{$row['avg_cost']}</td>
        <td>{$row['current_quantity']}</td>
        <td>{$row['sold_quantity']}</td>
        <td>{$row['avg_sold_price']}</td>
        <td>{$row['subtotal']}</td>
        <td>{$row['profit']}</td>
      </tr>\n";
      $subtotal_sum+=$row['subtotal'];
      $profit_sum+=$row['profit'];
    }
    echo "<tr><td>Total</td>
    <td colspan=6></td>
    <td>$subtotal_sum</td>
    <td>$profit_sum</td>
  </tr>\n";
}
else{
  echo"<br>No records in the database.\n";
  mysqli_free_result($result);
}
} 
else { 
  echo"<br>No result set return from the database.\n";   
}
echo "</tbody></table>";    

}
// Report by vendors during period: all
else if($myReportType=='vendors'){
 $query  = buildQuery($myReportPeriod,$myReportType);
 $result = mysqli_query($conn,$query);
 if($result){
  if ($result->num_rows > 0 ) {
    
    echo "<table border='1'>
    <thead>
     <tr>
       <th><b>#</b></th>            
       <th><b>Vendor name</b></th>
       <th><b>Quantity in Stock</b></th>
       <th><b>Amount to Vendor </b></th>
       <th><b>Sold quantity</b></th>            
       <th><b> Sub Total Sale</b></th>
       <th><b> Profit</b></th>
     </tr>
   </thead>
   <tbody>";
    $row_count = 0;
    $subtotal_sum = 0;
    $profit_sum = 0;
    while( $row = mysqli_fetch_array($result) ){
      $row_count++;
      echo "<tr><td>$row_count</td>
      <td>{$row['vendor_name']}</td>
      <td>{$row['stock_qty']}</td>
      <td>{$row['amount_to_vendor']}</td>            
      <td>{$row['sold_quantity']}</td>            
      <td>{$row['subtotal']}</td>
      <td>{$row['profit']}</td>
    </tr>\n";
    $subtotal_sum+=$row['subtotal'];
    $profit_sum+=$row['profit'];
  }
  echo "<tr><td>Total</td>
  <td colspan=4></td>
  <td>$subtotal_sum</td>
  <td>$profit_sum</td>
</tr>\n";
}
else{
  echo"<br>No records in the database.\n";
  mysqli_free_result($result);
}
} 
else { 
  echo"<br>No result set return from the database.\n";   
}
echo "</tbody></table>";    

}
mysqli_close($conn);
echo "<br><a href='index.html'>project home page</a>";
}

function buildQuery($myReportPeriod,$myReportType){
   $build_query = ''; 
   $query = '';
   $end_query = '';

   if($myReportType=='all'){
    $query = "SELECT p.name as pname, v.name, p.cost,  p.quantity as current_quantity, po.quantity as sold_quantity, p.sell_price, (po.quantity*p.sell_price) as subtotal,
    (po.quantity * (p.sell_price-p.cost))  as profit,
    concat(c.first_name,' ',c.last_name) as cname, o.date 
    from PRODUCT p, ORDERS o, CPS5920.VENDOR v, CUSTOMER c, PRODUCT_ORDER po
    where p.vendor_id= v.vendor_id and
    o.customer_id=c.customer_id and
    p.id=po.product_id";
    $end_query = " and po.order_id=o.id";
  } else if($myReportType=='products'){
   $query = "SELECT p.name as pname,v.name, avg(p.cost) as avg_cost, p.quantity as current_quantity,sum(po.quantity) as sold_quantity ,
   avg(p.sell_price) as avg_sold_price,(sum(po.quantity) * avg(p.sell_price)) as subtotal,
   (sum(po.quantity) * (avg(p.sell_price)-avg(p.cost))) as profit
   from PRODUCT p,ORDERS o,CPS5920.VENDOR v,PRODUCT_ORDER po
   where p.vendor_id= v.vendor_id and
   p.id=po.product_id and po.order_id=o.id";
   $end_query = " group by p.name";
  } else if($myReportType == 'vendors'){
    $query = "SELECT v.name as vendor_name,  
    sum(p.quantity) as stock_qty, (sum(p.cost)*pq.sell_qty) as amount_to_vendor, pq.sell_qty as sold_quantity,
    (sum(p.sell_price)*pq.sell_qty) as subtotal, ((sum(p.sell_price)*pq.sell_qty) - (sum(p.cost)*pq.sell_qty)) as profit
    from CPS5920.VENDOR v, PRODUCT p , ORDERS o, view_prod_sell_qty pq where p.vendor_id=v.vendor_id  
    and p.id = pq.product_id
    and o.id = pq.order_id";
    $end_query = " group by p.vendor_id";
  }

  if($myReportPeriod == 'past_week'){
    $build_query=$query." and date between date_sub(now(),INTERVAL 2 WEEK) and date_sub(now(),INTERVAL 1 WEEK)";
  } else if($myReportPeriod == 'current_month'){
    $build_query = $query." and MONTH(date) = MONTH(CURDATE())";
  } else if($myReportPeriod == 'past_month'){
    $build_query = $query."  and YEAR(date) = YEAR(now() - INTERVAL 1 MONTH)
    AND MONTH(date) = MONTH(now() - INTERVAL 1 MONTH)";
  } else if($myReportPeriod == 'this_year'){
    $build_query = $query." and YEAR(date) = YEAR(CURDATE())";
  } else if($myReportPeriod == 'past_year'){
    $build_query = $query." and YEAR(date) = YEAR(DATE_SUB(CURDATE(), INTERVAL 1 YEAR))";
  } else{
   $build_query=$query;
  }
  return $build_query.$end_query;
}

?>        