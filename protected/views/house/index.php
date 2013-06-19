<?php
/* @var $this HouseController */
/* @var $dataProvider CActiveDataProvider */
/*   
 * WE DON'T NEED ANY OF THIS
 * 
//  Home » Houses
$this->breadcrumbs=array(
	'Houses',
);

$this->menu=array(
	array('label'=>'Create House', 'url'=>array('create')),
	array('label'=>'Manage House', 'url'=>array('admin')),
);
 */

foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
    }
?>
<h1>Houses</h1>
<div id="objects">
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
</div>