<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar Usuario',
);

?>

<h1>Actualizar Usuario <em><?php echo $model->usu_nom; ?></em></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>