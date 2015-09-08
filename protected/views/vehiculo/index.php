<?php
/* @var $this VehiculoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Vehiculos',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle('slow');
	return false;
});
$('.search-form form').submit(function(){
	$('#vehiculo-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Vehiculos</h1>

<?php echo CHtml::link('Búsqueda Avanzada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<!-- #######################################################################-->

<?php $this->beginWidget(		// Ventana Modal
    'booster.widgets.TbModal',
    array('id' => 'docVencidos')
); ?>

    <div class="modal-header"> <!-- Cabecera -->
        <a class="close" data-dismiss="modal">&times;</a>
        <h4>Documentos Vencidos</h4>
    </div>
 
    <div class="modal-body"> <!-- Cuerpo -->
        <?php echo $this->renderPartial('_docVencidos',array('modelDV'=>$modelDV)); ?>
    </div>
 
    <div class="modal-footer"> <!-- Pie de página --> <!-- Botones -->
        <?php $this->widget('booster.widgets.TbButton',
            array(
                'label' => 'Cerrar',
                'url' => '#',
                'htmlOptions' => array('data-dismiss' => 'modal'),
            )
        ); ?>
    </div>
 
<?php $this->endWidget(); ?> <!-- Fin Ventana Modal -->

<!-- #######################################################################-->

<div class="container">
	<div class="row" style="padding-top:20px">
		<div class="pull-left">
			<?php $this->widget('booster.widgets.TbButton', array(
				'context'=>'primary',
				'label'=>'Agregar Nuevo',
				'buttonType'  => 'link',
				'url'=>array('create'),
			)); ?>
		</div>
		<div class="pull-right" style="padding-right:30px">
			<?php $this->widget('booster.widgets.TbButton', array(
				'context'=>'success',
				'label'=>'Exportar Listado',
				'buttonType'  => 'link',
				'url'=>array('ViewPdf', 'valor'=> 'ListaVehiculos'),
			)); ?>
			<?php $this->widget('booster.widgets.TbButton', array(
				'context'=>'warning',
				'label'=>'Documentos Vencidos',
				'htmlOptions' => array(
		            'data-toggle' => 'modal',
		            'data-target' => '#docVencidos',
		        ),
			)); ?>
		</div>
	</div>
</div>

<?php $this->widget('booster.widgets.TbGridView', array(
	'id'=>'vehiculo-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'type' => 'striped hover',
	'columns'=>array(
		//array('name'=>'id', 		'htmlOptions'=>array('width'=>'100'), 'value'=>'$data->id'),
		array('name'=>'veh_num_con','htmlOptions'=>array('width'=>'60'), 'value'=>'$data->veh_num_con'),
		array('name'=>'veh_pla',	'htmlOptions'=>array('width'=>'100'), 'value'=>'$data->veh_pla'),
		array('name'=>'veh_mod', 	'htmlOptions'=>array('width'=>'100'), 'value'=>'$data->veh_mod'),
		array('name'=>'veh_mar', 	'htmlOptions'=>array('width'=>'100'), 'value'=>'$data->veh_mar'),
		array('name'=>'veh_col', 	'htmlOptions'=>array('width'=>'100'), 'value'=>'$data->veh_col'),
		array('name'=>'veh_ser_car','htmlOptions'=>array('width'=>'100'), 'value'=>'$data->veh_ser_car'),
		array('name'=>'veh_ser_mot','htmlOptions'=>array('width'=>'100'), 'value'=>'$data->veh_ser_mot'),
		/*
		'veh_anio',
		//'veh_tipo',
		'veh_ser_car',
		'veh_ser_mot',
		*/
		array(
			'htmlOptions' => array('nowrap'=>'nowrap'),
			'class'=>'booster.widgets.TbButtonColumn',
		),
	),
)); ?>


