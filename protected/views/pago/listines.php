<?php Yii::app()->clientScript->registerScript('listines-jquery', "
	$('#DocumentoForm_documento_1').click(function(e){
        $('.numeroControl').show('slow');
    });
	$('#DocumentoForm_documento_0').click(function(e){
        $('.numeroControl').hide('slow');
        $('#DocumentoForm_numeroControl').val('');
    });
");
?>

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'listines-form',
	'enableAjaxValidation'=>false,
	'type' => 'horizontal',
    'htmlOptions' => array('class' => 'well'),
    'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
))); ?>

<h1 class="text-center">Listines</h1>

<?php echo $form->errorSummary(array($model, $modelDV)); ?>

<?php echo $form->radioButtonListGroup(
	$modelDV,
	'documento',
	array(
		'widgetOptions' => array(
			'data' => array(
				'TotalListines' => 'Total Listines', 
				//'ListinesNC' => 'Listines Entregados a N# Control',
			)
		),
		'label' => 'Opciones'
	)
); ?>

<?php /* ?>

<div class="numeroControl" style="display:none">
	<?php echo $form->dropDownListGroup($modelDV,'numeroControl',array('widgetOptions'=>
		array('data' => Vehiculo::getNumeroControl(),'htmlOptions'=>array('empty' => 'Seleccione...')
	))); ?>
</div>

*/ ?>

<?php echo $form->datePickerGroup($modelDV,'fechaInicio',array('widgetOptions'=>
    array('options'=>array('language' => 'es', 'format'=>'dd-mm-yyyy'),'htmlOptions'=>array('class'=>'span5')), 
    'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>')
); ?>

<?php echo $form->datePickerGroup($modelDV,'fechaFin',array('widgetOptions'=>
    array('options'=>array('language' => 'es', 'format'=>'dd-mm-yyyy'),'htmlOptions'=>array('class'=>'span5')), 
    'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>')
); ?>

<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
		'buttonType'  	=> 'submit',
		'context'		=> 'primary',
		'label'			=> 'Exportar Informe',
	)); ?>
</div>

<?php $this->endWidget(); ?>
