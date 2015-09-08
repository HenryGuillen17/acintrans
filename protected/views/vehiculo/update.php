<?php
/* @var $this VehiculoController */
/* @var $model Vehiculo */

$this->breadcrumbs=array(
	'Vehiculos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

?>

<h1>Actualizar Vehiculo <em><?php echo $model->id; ?></em></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>