<?php
/* @var $this OrganigramaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Organigramas',
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

<h1>Organigramas</h1>

<?php echo CHtml::link('Búsqueda Avanzada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('booster.widgets.TbGridView', array(
	'id'=>'organigrama-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'org_ano_elecc',
		'org_pre',
		'org_vpr',
		'org_sec',
		'org_tes',
		array('name' => 'org_pre', 'value' => '$data->orgPre->per_nom'),
		array(
			'htmlOptions' => array('nowrap'=>'nowrap'),
			'class'=>'booster.widgets.TbButtonColumn',
		),
	),
)); ?>

