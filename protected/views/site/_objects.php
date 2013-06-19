<!-- Javascript for tooltip has to be placed here, otherwise won't work with pagination -->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.qtip-1.0.0-rc3.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/tooltips.js"></script>
<?php echo "<br/><input type='text' name='apiurl' id='apiurl' size='113' value='".$this->apiURL."'>"; ?>
<?php //print_r($myhouses); // some debugging for myself ?>
<?php foreach($objects as $object) { ?>
	<div class="view">
		<?php
		 // Instead of showing 1018ZA separate numbers an letters 1018 ZA
		 preg_match('#(\d*)([A-Z]*)#', $object->Postcode, $postcode);
		 
		 // Middel foto looks better than Klein (found this in funda web page)
		 $foto =  preg_replace('/klein.jpg/', 'middel.jpg',  $object->Foto);
		 //$foto =  $object->Foto;
		?>
		<div class="list-image"><?php echo CHtml::link(CHtml::image($foto), $object->URL, array('target' => '_blank')); ?></div>
		<div class="list-data">
			<ul>
			<li><?php echo CHtml::link($object->Adres, $object->URL, array('target' => '_blank')); ?></li>
			<li><?php echo CHtml::encode($postcode[1]) . '  ' . CHtml::encode($postcode[2]) . ' ' . CHtml::encode($object->Woonplaats); ?></li>
			<li><?php echo CHtml::encode($object->AantalKamers) . ' kamers - ' . CHtml::encode($object->Woonoppervlakte) . ' m²'; ?></li>
			<li><?php echo '€ ' . CHtml::encode($object->KoopprijsTot); ?></li>
			<li><?php echo CHtml::encode($object->MakelaarNaam); ?></li>
			</ul>
		</div>

		<?php 
			// display the Map Button with all atributes needed to generate the map
			echo CHtml::link('kaart', '', array('class' => 'map-btn', 
													'center' => $object->WGS84_Y . ',' . $object->WGS84_X,
													'adres'=>$object->Adres . ', ' . $object->Postcode . ' ' . $object->Woonplaats
													)); ?>
		<?php
			//  If an authenticated user, display the button to save a house
			if(!Yii::app()->user->isGuest)
			{
				$key=array_search($object->URL, $myhouses); // Check if the house is already saved
				if($key!==false)
				{
					unset($myhouses[$key]); // will decrease the array size every iteration
					echo CHtml::button('in mijn huizen', array('class'=>'btn'));
				}
				else
				{ 
					echo $this->renderPartial('_form', array('object'=>$object));
				}
			 }
		?>
			
	</div>
<?php } ?>