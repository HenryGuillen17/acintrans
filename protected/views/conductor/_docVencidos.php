<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'docVencidos-form',
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
				'CedVencidas'  		=> 'Cédulas de Identidad Vencidas', 
				'RifVencidas' 		=> 'RIF \'s Vencidos',
				'LicCondVencidas' 	=> 'Licencias de Conducir Vencidas',
				'CerMedVencidas' 	=> 'Certificados Médicos Vencidos',
			)
		)
	)
); ?>

<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'  	=> 'submit',
			'context'		=> 'primary',
			'label'			=> 'Exportar Informe',
		)); ?>
</div>

<?php $this->endWidget(); ?>
