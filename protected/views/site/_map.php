    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAzUbqULUkUSV-ICTh9kK3BuMXAIL21jD0&amp;sensor=false&v=3"></script>
	<script type="text/javascript">
      function initialize() 
      {
        var myLatlng = new google.maps.LatLng(<?php echo $center; ?>);
        var mapOptions = {
          center: myLatlng,
          zoom: 13,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map_canvas"),mapOptions);
        var marker = new google.maps.Marker({position: myLatlng, title:"<?php echo $adres; ?>"});
        marker.setMap(map);
      }
      google.maps.event.addDomListener(window, 'load', initialize);
</script>
<?php echo CHtml::encode($adres); ?>
<div id="map_canvas"  style="background-color: rgb(229, 227, 223); height: 400px; width: 600px; overflow: auto; position: absolute;"></div>