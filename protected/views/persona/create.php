<?php
/* @var $this PersonaController */
/* @var $model Persona */

$this->breadcrumbs=array(
	'Personas'=>array('index'),
	'Agregar Persona',
);
?>

<h1>Agregar Persona</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>