<img src="http://maps.googleapis.com/maps/api/staticmap?center=<?php echo $center; ?>&zoom=11&size=350x250&markers=color:blue|label:F|<?php echo $center; ?>&sensor=false">
<?php echo CHtml::link('geopend kaart', "index.php?r=site/ShowMap&center=$center&adres=$adres", array('class' => 'map btn', 'target'=>'_blank')); ?>