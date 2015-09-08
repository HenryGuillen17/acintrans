<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	'Agregar Usuario',
);

?>

<h1>Agregar Usuario</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>