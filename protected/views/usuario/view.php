<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	$model->id,
);

?>

<h1>Detalle Usuario <em><?php echo $model->usu_nom; ?></em></h1>

<?php $this->widget('booster.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_persona',
		'idPersona.per_nom',
		'idPersona.per_ape',
		'usu_nom',
	),
)); ?>
