<?php Yii::app()->clientScript->registerScript('listines-jquery', "
    $('#Pago_pag_mon').click(function(e){
        alert('Hola');
    });
	$('#DocumentoForm_documento_0').click(function(e){
        alert('Hola');
    });
	$('#DocumentoForm_numeroControl_L').click(function(e){
        alert('Hola');
    });
");
?>

<div class="row">


	<div class="col-xs-12 col-sm-12 col-ms-6 col-lg-6">
		<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
			'id'=>'histPago-form',
			'enableAjaxValidation'=>true,
			'type' => 'horizontal',
			'htmlOptions' => array('class' => 'well'),
		)); ?>
			
		<h2 class="text-center">Historial de Pagos</h2>

		<?php echo $form->errorSummary(array($model, $modelDV)); ?>

		<?php echo $form->radioButtonListGroup(
			$modelDV,
			'documento',
			array(
				'widgetOptions' => array(
					'data' => array(
						'M' => 'Mensualidades', 
						'L' => 'Listines',
						'U' => 'Uniformes',
						'C' => 'Carnet',
						'P' => 'Publicidad',
						'R' => 'Recolectas',
					)
				),
			)
		); ?>

		<?php echo $form->dropDownListGroup($modelDV,'numeroControl',array('widgetOptions'=>
			array('data' => Vehiculo::getListaDocVencidos(),'htmlOptions'=>array('empty' => 'Seleccione...')
		))); ?>

		<?php echo $form->dropDownListGroup($modelDV,'nomConductor',array('widgetOptions'=>
		    array('data' => Vehiculo::getListaDocVencidos(),'htmlOptions'=>array('empty' => 'Seleccione...')
		))); ?>

		<?php echo $form->datePickerGroup($modelDV,'fechaInicio',array('widgetOptions'=>
		    array('options'=>array('languaje' => 'es'),'htmlOptions'=>array('class'=>'span5')), 
		    'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>')
		); ?>

		<?php echo $form->datePickerGroup($modelDV,'fechaFin',array('widgetOptions'=>
		    array('options'=>array('languaje' => 'es'),'htmlOptions'=>array('class'=>'span5')), 
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

	</div>
	

<!-- ############################################################################################# -->
<!--                                                                                               -->
<!-- ############################################################################################# -->

	<div class="col-xs-12 col-sm-12 col-ms-6 col-lg-6">
		<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
			'id'=>'listines-form',
			'enableAjaxValidation'=>true,
			'type' => 'horizontal',
			'htmlOptions' => array('class' => 'well'),
		)); ?>
			
		<h2 class="text-center">Listines</h2>

		<?php echo $form->errorSummary(array($model, $modelDV)); ?>


		<?php echo $form->radioButtonListGroup(
			$modelDV,
			'documento',
			array(
				'widgetOptions' => array(
					'data' => array(
						'TotalListines' => 'Total Listines', 
						'ListinesNC' => 'Listines Entregados a N# Control',
					)
				),
				'label' => 'Opciones'
			)
		); ?>

		<div class="numeroControl" style="display:block">
			<?php echo $form->dropDownListGroup($modelDV,'numeroControl',array('widgetOptions'=>
				array('data' => Vehiculo::getListaDocVencidos(),'htmlOptions'=>array('empty' => 'Seleccione...',
					'id' => 'numeroControl_L')
			))); ?>
		</div>
		<?php /* ?>

		<?php echo $form->datePickerGroup($modelDV,'fechaInicio',array('widgetOptions'=>
		    array('options'=>array('languaje' => 'es'),'htmlOptions'=>array('class'=>'span5')), 
		    'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>')
		); ?>

		<?php echo $form->datePickerGroup($modelDV,'fechaFin',array('widgetOptions'=>
		    array('options'=>array('languaje' => 'es'),'htmlOptions'=>array('class'=>'span5')), 
		    'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>')
		); ?>

		*/?>


		<?php echo $form->textFieldGroup($model,'pag_mon',array('widgetOptions'=>array(
		'htmlOptions'=>array('class'=>'span5')))); ?>

		<div class="form-actions text-right">
			<?php $this->widget('booster.widgets.TbButton', array(
				'buttonType'  	=> 'submit',
				'context'		=> 'primary',
				'label'			=> 'Exportar Informe',
			)); ?>
		</div>

		<?php $this->endWidget(); ?>
	</div>
</div>