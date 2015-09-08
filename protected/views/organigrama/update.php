<?php
/* @var $this OrganigramaController */
/* @var $model Organigrama */

$this->breadcrumbs=array(
	'Organigramas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);
?>

<h1>Actualizar Organigrama <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>