<?php
/* @var $this HouseController */
/* @var $model House */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'adres'); ?>
		<?php echo $form->textField($model,'adres',array('size'=>60,'maxlength'=>88)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'aantalkamers'); ?>
		<?php echo $form->textField($model,'aantalkamers'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'foto'); ?>
		<?php echo $form->textField($model,'foto',array('size'=>60,'maxlength'=>88)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'koopprijstot'); ?>
		<?php echo $form->textField($model,'koopprijstot'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'makelaarnaam'); ?>
		<?php echo $form->textField($model,'makelaarnaam',array('size'=>60,'maxlength'=>88)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'postcode'); ?>
		<?php echo $form->textField($model,'postcode',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>88)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'create_time'); ?>
		<?php echo $form->textField($model,'create_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'woonoppervlakte'); ?>
		<?php echo $form->textField($model,'woonoppervlakte',array('size'=>60,'maxlength'=>88)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'woonplats'); ?>
		<?php echo $form->textField($model,'woonplats',array('size'=>60,'maxlength'=>88)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'wgs84_y'); ?>
		<?php echo $form->textField($model,'wgs84_y',array('size'=>60,'maxlength'=>88)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'wgs84_x'); ?>
		<?php echo $form->textField($model,'wgs84_x',array('size'=>60,'maxlength'=>88)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->