<?php
/* @var $this ConductorController */
/* @var $model Conductor */
/* @var $modelFamiliares Familiar */

$this->breadcrumbs=array(
	'Conductores'=>array('index'),
	'Agregar',
);

?>

<h1>Agregar Conductor</h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'modelFamiliares' => $modelFamiliares)); ?>