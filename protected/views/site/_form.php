<?php echo CHtml::beginForm('index.php?r=house/create', 'post'); ?>
	<?php echo CHtml::hiddenField("adres",$object->Adres); ?>
	<?php echo CHtml::hiddenField("aantalkamers",$object->AantalKamers); ?>
	<?php echo CHtml::hiddenField("foto",$object->Foto); ?>
	<?php echo CHtml::hiddenField("koopprijstot",$object->KoopprijsTot); ?>
	<?php echo CHtml::hiddenField("makelaarnaam",$object->MakelaarNaam); ?>
	<?php echo CHtml::hiddenField("postcode",$object->Postcode); ?>
	<?php echo CHtml::hiddenField("url",$object->URL); ?>
	<?php echo CHtml::hiddenField("woonoppervlakte",$object->Woonoppervlakte); ?>
	<?php echo CHtml::hiddenField("woonplats",$object->Woonplaats); ?>
	<?php echo CHtml::hiddenField("wgs84_y",$object->WGS84_Y); ?>
	<?php echo CHtml::hiddenField("wgs84_x",$object->WGS84_X); ?>
	<?php echo CHtml::submitButton('Bewaren', array('class'=>'btn')); ?>
<?php echo CHtml::endForm(); ?>