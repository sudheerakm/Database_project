<?php
$cookie_name = "Customer_login_cookie";
if(isset($_COOKIE[$cookie_name])) {
	header('Location: CPS5920_customer_check_p2.php');  
}else{
?>
<a href='CPS5920_customer_login_p2.php'>Customer login</a>
  <br>search product (* for all):
  <form name="input" action="CPS5920_search_product.php" method="get" >
  <input type="text" name="search_items" required>
  <input type="submit" value="Search">
  </form>
  <a href='index.html'>project home page</a>
  <?php
  }?>