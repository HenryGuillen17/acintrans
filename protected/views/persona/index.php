<?php
/* @var $this PersonaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Personas',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#persona-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Personas</h1>

<?php echo CHtml::link('Búsqueda Avanzada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<div class="pull-right">
	<?php $this->widget('booster.widgets.TbButton', array(
		'context'=>'primary',
		'label'=>'Agregar Nuevo',
		'buttonType'  => 'link',
		'url'=>array('create'),
	)); ?>
</div>

<?php $this->widget('booster.widgets.TbGridView', array(
	'id'=>'persona-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'per_nom',
		'per_ape',
		'per_dir',
		'per_tel1',
		/*
		'per_tel2',
		*/
		'per_ced',
		array(
			'class'=>'booster.widgets.TbButtonColumn',
		),
	),
)); ?>

