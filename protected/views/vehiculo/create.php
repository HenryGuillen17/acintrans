<?php
/* @var $this VehiculoController */
/* @var $model Vehiculo */

$this->breadcrumbs=array(
	'Vehiculos'=>array('index'),
	'Agregar',
);

?>

<h1>Agregar Vehiculo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>