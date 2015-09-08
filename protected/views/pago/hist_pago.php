<?php Yii::app()->clientScript->registerScript('listines-jquery', "
	$('#DocumentoForm_numeroControl').change(function(e){
		setConductor();
	});
	function setConductor() {
		if ($('#DocumentoForm_numeroControl').val() == '') {
			$('#DocumentoForm_nomControl').val('');
			$('.nomConductor').hide('slow');
		} else {
			$('.nomConductor').show('slow');
		}
	}
");
?>

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'histPago-form',
	'enableAjaxValidation'=>false,
	'type' => 'horizontal',
    'htmlOptions' => array('class' => 'well'),
    'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
))); ?>

<h1 class="text-center">Historial de Pagos</h1>
	
<?php echo $form->errorSummary(array($model, $modelDV)); ?>

<?php echo $form->radioButtonListGroup(
	$modelDV,
	'documento',
	array(
		'widgetOptions' => array(
			'data' => array(
				'M' => 'Mensualidades',
				// 'U' => 'Uniformes',
				// 'C' => 'Carnet',
				// 'P' => 'Publicidad',
				// 'R' => 'Recolectas',
			)
		)
	)
); ?>

<?php echo $form->dropDownListGroup($modelDV,'numeroControl',array('widgetOptions'=>
	array('data' => Vehiculo::getNumeroControl(),'htmlOptions'=>array('empty' => 'Seleccione...',
		'ajax' => array('type' => 'POST',
			'url'=>Yii::app()->createUrl('/pago/CargarConductores'),
			'update' => '#DocumentoForm_nomConductor',
))))); ?>

<div class="nomConductor" style="display:none">
	<?php echo $form->dropDownListGroup($modelDV,'nomConductor',array('widgetOptions'=>
	    array('htmlOptions'=>array('empty' => 'Seleccione...')
	))); ?>
</div>

<?php echo $form->datePickerGroup($modelDV,'fechaInicio',array('widgetOptions'=>
    array('options'=>array('language' => 'es', 'format'=>'dd-mm-yyyy'),'htmlOptions'=>array('class'=>'span5')), 
    'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>')
); ?>

<?php echo $form->datePickerGroup($modelDV,'fechaFin',array('widgetOptions'=>
    array('options'=>array('language' => 'es', 'format'=>'dd-mm-yyyy'),'htmlOptions'=>array('class'=>'span5')), 
    'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>')
); ?>

<div class="form-actions text-right">
	<?php $this->widget('booster.widgets.TbButton', array(
		'buttonType'  	=> 'submit',
		'context'		=> 'primary',
		'label'			=> 'Exportar Informe',
	)); ?>
</div>

<?php $this->endWidget(); ?>
