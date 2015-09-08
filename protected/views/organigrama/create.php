<?php
/* @var $this OrganigramaController */
/* @var $model Organigrama */

$this->breadcrumbs=array(
	'Organigramas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Organigrama', 'url'=>array('index')),
	array('label'=>'Manage Organigrama', 'url'=>array('admin')),
);
?>

<h1>Create Organigrama</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>