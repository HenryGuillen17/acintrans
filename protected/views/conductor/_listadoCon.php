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
				'ListaConductores'	=> 'Listado de Conductores', 
				'ListaConAsoc' 		=> 'Listado de Conductores Asociados',
				'ListaConAvan' 		=> 'Listado de Conductores Avance',
				//'ListCondConVehic' 	=> 'Listado de Conductores Con su Vehículo',
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
