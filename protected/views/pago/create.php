<?php
/* @var $this PagoController */
/* @var $model Pago */

$this->breadcrumbs=array(
	'Pagos'=>array('index'),
	'Agregar',
);

?>

<h1>Agregar Pago</h1>

<?php $this->renderPartial('_form', array(
	'model'=>$model,
	'modelListin'=>$modelListin,
	'modelMensualidadPago'=>$modelMensualidadPago,
)); ?>