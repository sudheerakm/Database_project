<HTML>
  <title>View all vendors</title>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      #map-canvas {
        height: 600px;
        margin: 0px;
        padding: 0px
      }
    </style>
    <body>

      <div style="margin:auto;  width: 720px; ">

        <?php

        include 'dbconfig.php';

        $apikey = "AIzaSyBvUSJbOmOnJJgrBDG2tXITfuVqM4FM7As";

        $conn = new mysqli($servername, $username, $password, $dbname);
          // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        $query = "SELECT * FROM VENDOR";

        if(!$result = $conn->query($query)){
         die('There was an error running the query [' . $con->error . ']');
       } else {
        ?>
        <a href='logout.php'>Employee logout</a><br>
        <b><p align=center>The following vendors are in the database</p><b>
        <table border="1">
         <thead>
           <tr>
            <th><b>vendor_id</b></th>
            <th><b>name</b></th>
            <th><b>address</b></th>
            <th><b>city </b></th>
            <th><b>state</b></th>
            <th><b>zipcode</b></th>
            <th><b>latitude</b></th>
            <th><b>Longitude</b></th>
          </tr>
        </thead>
        <tbody>
          <?php
          $locArray = array();
          while( $row = mysqli_fetch_array($result) ){
            $locArray[] = array($row['vendor_id'],$row['name'],$row['latitude'],$row['Longitude']);
            echo "<tr><td>{$row['vendor_id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['address']}</td>
            <td>{$row['city']}</td>
            <td>{$row['state']}</td>
            <td>{$row['zipcode']}</td>
            <td>{$row['latitude']}</td>
            <td>{$row['Longitude']}</td></tr>\n";
          }
          ?>
        </tbody>
      </table> 
      <?php

    }   

    ?>

    <script type="text/javascript"
    src="https://maps.googleapis.com/maps/api/js?key=
    <?php echo $apikey; ?>&sensor=false">
  </script>

  <script type="text/javascript">
    function initialize() {
      var infowindow 
      var markerIcon = {
        scaledSize: new google.maps.Size(80, 80),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(32,65),
        labelOrigin: new google.maps.Point(40,33)
      };    
      var locations = [
      <?php for($i=0;$i<count($locArray);$i++){ ?>
        [
        '<?php echo $locArray[$i][0];?>', // vendor_id
        '<?php echo $locArray[$i][1];?>', // vendor_name
        <?php echo $locArray[$i][2];?>,   // latitude
        <?php echo $locArray[$i][3];?>,   // longitude
        ]<?php if($i+1!=count($locArray))echo ","; }?>
        ];

        var origin = new google.maps.LatLng(locations[0][2], locations[0][3]);

        var mapOptions = {
          zoom: 3,
          center: origin,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

        infowindow = new google.maps.InfoWindow();

        for(i=0; i<locations.length; i++) {
          var position = new google.maps.LatLng(locations[i][2], locations[i][3]);
          var marker = new google.maps.Marker({
            position: position,
            map: map,
            icon: markerIcon, 
            label: {
              text: locations[i][0] ,
              color: "black",
              fontSize: "16px",
              fontWeight: "bold"
            }
          });
          google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
              infowindow.setContent("Vendor Name:"+ locations[i][1]);
              infowindow.open(map, marker);
            }
          }) (marker, i));
        }
        
      }
      google.maps.event.addDomListener(window, 'load', initialize);

    </script>
  </head>
  <div id="map-canvas" style="height: 400px; width: 720px;"></div>
</body>
</html>