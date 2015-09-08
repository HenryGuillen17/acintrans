<?php
/* @var $this OrganigramaController */
/* @var $model Organigrama */

$this->breadcrumbs=array(
	'Organigramas'=>array('index'),
	$model->id,
);
?>

<h1>Ver Organigrama <?php echo $model->org_ano_elecc; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'org_ano_elecc',
		'org_nom_pr',
		'org_nom_vp',
		'org_nom_tes',
		'org_nom_d1',
		'org_nom_d2',
		'org_nom_d3',
		'org_nom_r1',
		'org_nom_r2',
	),
)); ?>
