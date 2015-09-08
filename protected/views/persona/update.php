<?php
/* @var $this PersonaController */
/* @var $model Persona */

$this->breadcrumbs=array(
	'Personas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar Persona',
);
?>

<h1>Actualizar Persona <em><?php echo $model->per_nom; ?></em></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>