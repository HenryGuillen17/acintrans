<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'deudaCon-form',
	'enableAjaxValidation'=>false,
	'type' => 'horizontal',
    'htmlOptions' => array('class' => 'well'),
    'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
))); ?>
	
<?php echo $form->errorSummary($modelDV); ?>

<?php echo $form->radioButtonListGroup(
	$modelDV,
	'documento',
	array(
		'widgetOptions' => array(
			'data' => array(
				'0' => 'Asociados', 
				'1' => 'Avance',
			)
		)
	)
); ?>

<?php echo $form->datePickerGroup($modelDV,'fechaInicio',array('widgetOptions'=>
    array('options'=>array('languaje' => 'es', 'format' => 'dd-mm-yyyy'),'htmlOptions'=>array('class'=>'span5')), 
    'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>')
); ?>

<?php echo $form->datePickerGroup($modelDV,'fechaFin',array('widgetOptions'=>
    array('options'=>array('languaje' => 'es', 'format' => 'dd-mm-yyyy'),'htmlOptions'=>array('class'=>'span5')), 
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
