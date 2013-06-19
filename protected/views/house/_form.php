<?php
/* @var $this HouseController */
/* @var $model House */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'house-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'adres'); ?>
		<?php echo $form->textField($model,'adres',array('size'=>60,'maxlength'=>88)); ?>
		<?php echo $form->error($model,'adres'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'aantalkamers'); ?>
		<?php echo $form->textField($model,'aantalkamers'); ?>
		<?php echo $form->error($model,'aantalkamers'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'foto'); ?>
		<?php echo $form->textField($model,'foto',array('size'=>60,'maxlength'=>88)); ?>
		<?php echo $form->error($model,'foto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'koopprijstot'); ?>
		<?php echo $form->textField($model,'koopprijstot'); ?>
		<?php echo $form->error($model,'koopprijstot'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'makelaarnaam'); ?>
		<?php echo $form->textField($model,'makelaarnaam',array('size'=>60,'maxlength'=>88)); ?>
		<?php echo $form->error($model,'makelaarnaam'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'postcode'); ?>
		<?php echo $form->textField($model,'postcode',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'postcode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>88)); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'create_time'); ?>
		<?php echo $form->textField($model,'create_time'); ?>
		<?php echo $form->error($model,'create_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'woonoppervlakte'); ?>
		<?php echo $form->textField($model,'woonoppervlakte',array('size'=>60,'maxlength'=>88)); ?>
		<?php echo $form->error($model,'woonoppervlakte'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'woonplats'); ?>
		<?php echo $form->textField($model,'woonplats',array('size'=>60,'maxlength'=>88)); ?>
		<?php echo $form->error($model,'woonplats'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'wgs84_y'); ?>
		<?php echo $form->textField($model,'wgs84_y',array('size'=>60,'maxlength'=>88)); ?>
		<?php echo $form->error($model,'wgs84_y'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'wgs84_x'); ?>
		<?php echo $form->textField($model,'wgs84_x',array('size'=>60,'maxlength'=>88)); ?>
		<?php echo $form->error($model,'wgs84_x'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->