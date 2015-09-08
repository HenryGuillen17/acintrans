<?php
/* @var $this PagoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pagos',
);

Yii::app()->clientScript->registerScript('search', "
	$('.search-button').click(function(){
		$('.search-form').toggle();
		return false;
	});
	$('.search-form form').submit(function(){
		$('#pago-grid').yiiGridView('update', {
			data: $(this).serialize()
		});
		return false;
	});
");
?>

<?php
Yii::app()->getClientScript()->registerScript("activador_script", "
    $(document).on('click','[rel=link_activador]',function(e) {
        e.preventDefault();
        var a = $(this).find('a');
        if (a.html() == 'Anular') {
            var b = confirm('¿Estás Seguro de Anular la Factura?');
            if (b) {
                $.ajax({ url: a.attr('href'), type: 'post', 
                    success: function(newlabel){
                    a.html(newlabel);
                    $.fn.yiiGridView.update('conductor-grid');
                }, error: function(e){ alert('error:'+e.responseText); }});
            }
        } else
            alert('¡¡¡Pago Anulado!!!');
     });
",CClientScript::POS_HEAD);
?>

<h1>Pagos</h1>

<?php /*
echo CHtml::link('Búsqueda Avanzada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); */?>
<!-- </div><!-- search-form -->

<!-- ##################################################################################### -->

<?php $this->beginWidget('booster.widgets.TbModal',array('id' => 'deudaCon')); ?>
 
    <div class="modal-header"> <!-- Cabecera -->
        <a class="close" data-dismiss="modal">&times;</a>
        <h4>Deudores Mensuales</h4>
    </div>
 
    <div class="modal-body"> <!-- Cuerpo -->
        <?php echo $this->renderPartial('_deudaCon', array('modelDV'=>$modelDV)); ?>
    </div>
 
    <div class="modal-footer"> <!-- Pie de página --> <!-- Botones -->
        <?php $this->widget(
            'booster.widgets.TbButton',
            array(
                'label' => 'Cerrar',
                'url' => '#',
                'htmlOptions' => array('data-dismiss' => 'modal'),
            )
        ); ?>
    </div>
 
<?php $this->endWidget(); ?> <!-- Fin Ventana Modal -->

<!-- ##################################################################################### -->

<div class="container"> 
    <div class="row" style="padding-top:20px">
        <div class="pull-left">
            <?php $this->widget('booster.widgets.TbButton', array(
                'context'=>'primary',
                'label'=>'Agregar Pago',
                'buttonType'  => 'link',
                'url'=>array('pago/create'),
            )); ?>
        </div>
        <div class="pull-right" style="padding-right:30px">
            <?php $this->widget('booster.widgets.TbButton', array(
                'context'=>'primary',
                'label'=>'Historial de Pagos',
                'buttonType'  => 'link',
                'url'=>array('pago/histpago'),
            )); ?>
            <?php $this->widget('booster.widgets.TbButton', array(
                'context'=>'success',
                'label'=>'Listines',
                'buttonType'  => 'link',
                'url'=>array('pago/listines'),
            )); ?>
            <?php $this->widget('booster.widgets.TbButton', array(
                'context'=>'warning',
                'label'=>'Deuda Conductores',
                'htmlOptions' => array(
                    'data-toggle' => 'modal',
                    'data-target' => '#deudaCon',
                ),
        )); ?>
        </div> <!-- Fin pull-right -->
    </div> <!-- Fin Row -->
</div> <!-- Fin Container -->

<div class="table-responsive">
<?php $this->widget('booster.widgets.TbGridView', array(
	'id'=>'conductor-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'type' => 'striped hover',
    'rowCssClassExpression' => function($row, $data) {
    	if ($data->pag_anu == "1") 
    		return "danger";
    },
    'columns'=>array(
		'id',
		array('name' => 'veh_num_con', 'htmlOptions'=>array('width'=>'110'), 
            'value' => '$data->idConductor->idVehiculo->veh_num_con'), 
		array('name' => 'per_nom', 'value' => '$data->idConductor->idPersona->per_nom'),
		array('name' => 'pag_con', 'value' => '$data->pag_con == "M" ? "Mensualidad" : 
			($data->pag_con == "L" ? "Listines" : ($data->pag_con == "U" ? "Uniformes" : 
				($data->pag_con == "C" ? "Carnet" : ($data->pag_con == "P" ? "Publicidad" : 
				($data->pag_con == "R" ? "Recolectas" : "(none)")))))', 
        'filter' => $model->conceptoPago()),
		array('name' => 'pag_fec_ing', 'htmlOptions'=>array('width'=>'130'), 
            'value' => '$data->pag_fec_ing'),
		'pag_mon',
		array('name' => 'pag_anu', 'htmlOptions'=>array('width'=>'150', 'class' => 'pagAnu'), 
            'value' => '($data->pag_anu == 0) ? "Activo":"ANULADO"', 
			'filter' => $model->estadoPago(),
		),
    	array(
			'class'=>'CLinkColumn',
			'header'=>'Activador',
			'labelExpression'=> '$data->obtenerEtiqueta($data)',
			'urlExpression'=>'CHtml::normalizeUrl(array("AjaxActivador","id"=>$data->id))',
			'htmlOptions'=>array('rel'=>'link_activador'),
		),
		array(
			'htmlOptions' => array('nowrap'=>'nowrap'),
            'class'=>'booster.widgets.TbButtonColumn',
            'template'=>'{view}',
		),
	),
)); 
//CVarDumper::dump($model);
//Yii::app()->end();
?>
</div>