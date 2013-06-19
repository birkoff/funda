<?php 
/* Manualy load Jquery, it will automaticaly load with ajaxLink but not with link */
Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/pagination.js"></script>
<?php
/* @var $this SiteController */
$this->pageTitle=Yii::app()->name;
$i=0;
?>
<div class="filters">
	<table>
		<tr>
			<td>
				Aanwezigheid van:<br />
				<?php echo CHtml::checkBox('Tuin'); ?>Tuin<br />
				<?php echo CHtml::checkBox('Balkon'); ?>Balkon<br />
				<?php echo CHtml::checkBox('Lift'); ?>Lift<br />
			</td>
			<td>
				Sorteer op...<br />
				<?php echo CHtml::radioButtonList('sorteer', 'sorteer', array('makelaar'=>'makelaar', 'adres'=>'adres')); ?>
			</td>
			<td>
				<?php  echo CHtml::link('Verversen','',array('class' => 'btn', 'id' => 'verversen')); ?> 	
    		</td>
    	</tr>
	</table>
</div>

<div id="objects-nav">
<?php  
	// CHtml::ajaxLink
	echo CHtml::link('< Vorige','', array('id' => 'prev', 'class' => 'btn'));
	echo CHtml::textField("currentPage",1,array('size'=>5));
    echo CHtml::link('Volgende >','',array('id' => 'next', 'class' => 'btn'));
?>
</div>

<div id="loading"></div>
<div id="objects"></div><!-- This will be render with AJAX -->
