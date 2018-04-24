<?php
$cookie_name = "Employee_login_cookie";
$Customer_cookie_name = "Customer_login_cookie";
$ip =$_SERVER['SERVER_NAME'];
unset($_COOKIE[$cookie_name]);
unset($_COOKIE[$Customer_cookie_name]);
setcookie($cookie_name,'', time() - 3600, "/");
setcookie($Customer_cookie_name,'', time() - 3600, "/");
$url = "Location: http://".$ip."/~kasturim/CPS5920/index.html";
header($url);
exit;
?>