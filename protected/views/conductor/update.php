<?php
/* @var $this ConductorController */
/* @var $model Conductor */
/* @var $modelFamiliares Familiar */

$this->breadcrumbs=array(
	'Conductores'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar Conductor',
);
?>

<h1>Actualizar Conductor <em><?php echo $model->id; ?></em></h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'modelFamiliares' => $modelFamiliares)); ?>