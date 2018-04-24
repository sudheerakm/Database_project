<?php
		include "dbconfig1.php";
		$conn = new mysqli($servername, $username, $password, $dbname);

		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		$Imagequery = "SELECT image,description,url from CPS5920.Advertisement where id='4' ";
		
		$result = mysqli_query($conn,$Imagequery);
		$row = mysqli_fetch_assoc($result);	
		$img= $row['image'] ;
		$text=$row['description'] ;
		$url=$row['url'] ;
		echo "<a href='$url' target='_blank'> <imgsrc='data:image/jpeg;base64," . base64_encode($img) ."'/></a>\n";
?>		