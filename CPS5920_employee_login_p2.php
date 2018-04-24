<?php
$cookie_name = "Employee_login_cookie";
if(isset($_COOKIE[$cookie_name])) {
	header('Location: CPS5920_employee_check_p2.php');  
}else{
?>

<HTML>
<link rel = "stylesheet" type = "text/css" href="Style.css"/>
<body>
<font size=4><b><center>Employee login</center></b></font>
<form name="input" action="CPS5920_employee_check_p2.php" method="post" >
<br> Login ID: <input type="text" name="login_id">
<br> Password: <input type="password" name="password">
<br> <input type="submit" value="Login" name='submit'>
</form>
</body>
</HTML>
<?php
  }?>
