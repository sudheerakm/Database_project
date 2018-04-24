<HTML>
<link rel = "stylesheet" type = "text/css" href="Style.css"/>
<body>
<font size=4><b><center>Customer sign up</center></b></font>
<form name="input" action="CPS5920_customer_insert.php" method="post" >
<br> Login ID: <input type="text" name="login_id" required="required">
<br> Password: <input type="password" name="passwd1" required="required">
<br> Retype Password: <input type="password" name="passwd2" required="required">
<br> First Name: <input type="text" name="first_name" required="required">
<br> Last Name: <input type="text" name="last_name" required="required">
<br> TEL: <input type="text" name="tel" >
<br> Address: <input type="text" name="address" required="required">
<br> City: <input type="text" name="city" required="required">
<br> Zipcode: <input type="text" name="zipcode" required="required">
<br> State:
<select name="State" required="required">
        <option value=""></option>
        <option value="AL">Alabama</option>
        <option value="AK">Alaska</option>
        <option value="AZ">Arizona</option>
        <option value="AR">Arkansas</option>
        <option value="CA">California</option>
        <option value="CO">Colorado</option>
        <option value="CT">Connecticut</option>
        <option value="DE">Delaware</option>
        <option value="DC">District Of Columbia</option>
        <option value="FL">Florida</option>
        <option value="GA">Georgia</option>
        <option value="HI">Hawaii</option>
        <option value="ID">Idaho</option>
        <option value="IL">Illinois</option>
        <option value="IN">Indiana</option>
        <option value="IA">Iowa</option>
        <option value="KS">Kansas</option>
        <option value="KY">Kentucky</option>
        <option value="LA">Louisiana</option>
        <option value="ME">Maine</option>
        <option value="MD">Maryland</option>
        <option value="MA">Massachusetts</option>
        <option value="MI">Michigan</option>
        <option value="MN">Minnesota</option>
        <option value="MS">Mississippi</option>
        <option value="MO">Missouri</option>
        <option value="MT">Montana</option>
        <option value="NE">Nebraska</option>
        <option value="NV">Nevada</option>
        <option value="NH">New Hampshire</option>
        <option value="NJ">New Jersey</option>
        <option value="NM">New Mexico</option>
        <option value="NY">New York</option>
        <option value="NC">North Carolina</option>
        <option value="ND">North Dakota</option>
        <option value="OH">Ohio</option>
        <option value="OK">Oklahoma</option>
        <option value="OR">Oregon</option>
        <option value="PA">Pennsylvania</option>
        <option value="RI">Rhode Island</option>
        <option value="SC">South Carolina</option>
        <option value="SD">South Dakota</option>
        <option value="TN">Tennessee</option>
        <option value="TX">Texas</option>
        <option value="UT">Utah</option>
        <option value="VT">Vermont</option>
        <option value="VA">Virginia</option>
        <option value="WA">Washington</option>
        <option value="WV">West Virginia</option>
        <option value="WI">Wisconsin</option>
        <option value="WY">Wyoming</option>
</select>
<br><br> <input type="submit" value="Sign up">
</form>
</body>
</HTML>