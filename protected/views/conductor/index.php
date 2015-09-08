<?php
/* @var $this ConductorController */
/* @var $dataProvider CActiveDataProvider */
$this->breadcrumbs=array(
	'Conductores',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#conductor-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Conductores</h1>

<?php /*
echo CHtml::link('Búsqueda Avanzada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
    'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php */ ?>

<!-- #######################################################################-->

<?php $this->beginWidget(       // Ventana Modal
    'booster.widgets.TbModal',
    array('id' => 'listadoCon')
); ?>

    <div class="modal-header"> <!-- Cabecera -->
        <a class="close" data-dismiss="modal">&times;</a>
        <h4>Documentos Vencidos</h4>
    </div>
 
    <div class="modal-body"> <!-- Cuerpo -->
        <?php echo $this->renderPartial('_listadoCon',array('modelDV'=>$modelDV)); ?>
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

<?php $this->beginWidget(       // Ventana Modal
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
                'label'=>'Agregar Conductor',
                'buttonType'  => 'link',
                'url'=>array('create'),
            )); ?>
            <?php $this->widget('booster.widgets.TbButton', array(
                
                'label'=>'Agregar Persona',
                'buttonType'  => 'link',
                'url'=>array('persona/create'),
            )); ?>
        </div>
        <div class="pull-right" style="padding-right:30px">
            <?php $this->widget('booster.widgets.TbButton', array(
                'context'=>'success',
                'label'=>'Listado Conductores',
                'htmlOptions' => array(
                    'data-toggle' => 'modal',
                    'data-target' => '#listadoCon',
                ),
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
    'id'=>'conductor-grid',
    'dataProvider'=>$model->search(),
    'type' => 'striped hover',
    'filter'=>$model,
    'columns'=>array(
        //'id',
        array('name'=>'veh_num_con', 'htmlOptions'=>array('width'=>'110'), 
            'value'=>'$data->idVehiculo->veh_num_con','type'=>'text',),
        array('name'=>'per_nom','value'=>'$data->idPersona->per_nom','type'=>'text',),
        array('name'=>'per_ape','value'=>'$data->idPersona->per_ape','type'=>'text',),
        array('name'=>'per_ced','value'=>'$data->idPersona->per_ced','type'=>'text',),
        array('name'=>'con_tip_con','value'=>'($data->con_tip_con == 0) ? "Asociado":"Avance" ',
            'filter'=>$model->tipoConductor()),
        'con_rif',
        array(
            'htmlOptions' => array('nowrap'=>'nowrap'),
            'class'=>'booster.widgets.TbButtonColumn',
        ),
    ),
)); ?>

<?php 
//CVarDumper::dump($model);
//Yii::app()->end();
