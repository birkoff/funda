<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.qtip-1.0.0-rc3.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/tooltips.js"></script>

<div class="myhouses-view">
		<?php
		 preg_match('#(\d*)([A-Z]*)#', $data->postcode, $postcode); 
		 $foto =  preg_replace('/klein.jpg/', 'middel.jpg',  $data->foto); 
		?>
		<div class="myhouses-list-image"><?php echo CHtml::link(CHtml::image($foto), $data->url, array('target' => '_blank')); ?></div>
		<div class="list-data">
			<ul>
			<li><?php echo CHtml::link($data->adres, $data->url, array('target' => '_blank')); ?></li>
			<li><?php echo CHtml::encode($postcode[0]) . '  ' . CHtml::encode($postcode[1]) . ' ' . CHtml::encode($data->woonplats); ?></li>
			<li><?php echo CHtml::encode($data->aantalkamers) . ' kamers - ' . CHtml::encode($data->woonoppervlakte) . ' m²'; ?></li>
			<li><?php echo '€ ' . CHtml::encode($data->koopprijstot); ?></li>
			<li><?php echo CHtml::encode($data->makelaarnaam); ?></li>
			</ul>
		</div>
		<div class="functions-btn">
		<?php echo CHtml::link('kaart', '', array('class' => 'map-btn', 
												'center' => $data->wgs84_y . ',' . $data->wgs84_x,
												'adres'=>$data->adres . ', ' . $data->postcode . ' ' . $data->woonplats
												)); ?>
		<?php echo CHtml::link('Delete', 'index.php?r=house/delete&id='.$data->id, array('class' => 'btn')); ?>
		</div>
</div>
