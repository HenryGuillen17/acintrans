<?php
/* @var $this OrganigramaController */
/* @var $model Organigrama */

$this->breadcrumbs=array(
	'Organigramas'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Organigrama', 'url'=>array('index')),
	array('label'=>'Create Organigrama', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#organigrama-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Organigramas</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'organigrama-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'org_ano_elecc',
		'org_nom_pr',
		'org_nom_vp',
		'org_nom_tes',
		'org_nom_d1',
		/*
		'org_nom_d2',
		'org_nom_d3',
		'org_nom_r1',
		'org_nom_r2',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
