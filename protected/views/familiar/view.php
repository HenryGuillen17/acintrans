<?php
/* @var $this FamiliarController */
/* @var $model Familiar */

$this->breadcrumbs=array(
	'Familiars'=>array('index'),
	$model->id_persona1,
);

$this->menu=array(
	array('label'=>'List Familiar', 'url'=>array('index')),
	array('label'=>'Create Familiar', 'url'=>array('create')),
	array('label'=>'Update Familiar', 'url'=>array('update', 'id'=>$model->id_persona1)),
	array('label'=>'Delete Familiar', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_persona1),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Familiar', 'url'=>array('admin')),
);
?>

<h1>View Familiar #<?php echo $model->id_persona1; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_persona1',
		'id_persona2',
		'fam_par',
	),
)); ?>
