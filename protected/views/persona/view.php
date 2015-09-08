<?php
/* @var $this PersonaController */
/* @var $model Persona */

$this->breadcrumbs=array(
	'Personas'=>array('index'),
	$model->id,
);
?>

<h1>Ver Detalle Persona <em><?php echo $model->per_nom; ?></em></h1>

<?php $this->widget('booster.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'per_nom',
		'per_ape',
		'per_dir',
		'per_tel1',
		'per_tel2',
		'per_ced',
	),
)); ?>
