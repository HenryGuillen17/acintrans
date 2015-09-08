<?php Yii::app()->clientScript->registerScript('concepto', "
	$('#Pago_id_vehiculo').change(function(e){
		setConductor();
		setDescripcionPago();
		setListinesMensualidad();
	});
	$('#Pago_id_conductor').change(function(e){
		setDescripcionPago();
		setListinesMensualidad();
	});
	$('#Pago_pag_con').change(setListinesMensualidad);
	$('#Pago_pag_tip').change(setBancoReceptor);

	function setConductor() {
		if ($('#Pago_id_vehiculo').val() == '') {
			$('#Pago_id_conductor').val('');
		}
	}

	function setDescripcionPago() {
		if ($('#Pago_id_conductor').val() == '') {
			$('.descripcionPago').hide('slow');
			// Resetea el valor principal
			$('#Pago_pag_con').val('');
		} else {
			$('.descripcionPago').show('slow');
		}
	}

	function setListinesMensualidad() {
		if ($('#Pago_pag_con').val() == 'L') {
			$('.listines-text').show('slow');
			$('.mensualidadPago').hide('slow');
		} else
		if ($('#Pago_pag_con').val() == 'M') {
			$('.mensualidadPago').show('slow');
			$('.listines-text').hide('slow');
		} else {
			$('.mensualidadPago').hide('slow');
			$('.listines-text').hide('slow');
		}
	}
	function setBancoReceptor() {
		if ($('#Pago_pag_tip').val() == 'E' || $('#Pago_pag_tip').val() == 'C') {
			$('.bancoReceptor').hide('slow');
		} else {
			$('.bancoReceptor').show('slow');
		}
	}
");
?>

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'pago-form',
	'enableAjaxValidation'=>true,
	'type' => 'horizontal',
    'htmlOptions' => array('class' => 'well'),
)); ?>

<?php
	if ($model->isNewRecord) {
		$user = Yii::app()->getComponent('user');
		$user->setFlash('danger','<strong>¡Atento!</strong> Antes de Facturar un <em>Pago</em>, 
			asegúrese de tener <strong>TODOS</strong> los datos correctos.');

		$this->widget('booster.widgets.TbAlert', array(
		    'fade' => true,
		    'closeText' => '¡ENTENDIDO!', // false equals no close link
		    'userComponentId' => 'user',
		));
	}
?>

<p class="help-block">Campos con (<span class="required">*</span>) son requeridos.</p>

	<?php echo $form->errorSummary(array($model, $modelListin, $modelMensualidadPago)); ?>

	<?php echo $form->dropDownListGroup($model,'id_vehiculo',array('widgetOptions'=>
		array('data' => Vehiculo::getNumeroControl(),'htmlOptions'=>array('empty' => 'Seleccione...', 
			'ajax' => array('type' => 'POST',
			'url'=>Yii::app()->createUrl('/pago/CargarConductores'),
			'update' => '#Pago_id_conductor',
			//'update' => '.prueba',
	))))); ?>

	<?php echo $form->dropDownListGroup($model,'id_conductor',array('widgetOptions'=>
		array('htmlOptions'=>array('empty' => 'Seleccione...',)))); ?>

	<div class="descripcionPago" style="display:none">
		<?php echo $form->dropDownListGroup($model,'pag_con',array('widgetOptions'=>
			array('data' => Pago::conceptoPago(),'htmlOptions'=>array('empty' => 'Seleccione...',
				'ajax' => array('type' => 'POST',
				//'url'=>Yii::app()->createUrl('/pago/CargarMesesPagados'),
				'url'=>CHtml::normalizeUrl(array("CargarMesesPagados", "fechaInicio" => '0000-00-00', 
					"fechaFin" => date('Y-m-d'), "deudor" => true)),
				'update' => '#MensualidadPago_men_pag_mes_can',
				//'update' => '.prueba',
		))))); ?>
	</div>

	<div class="prueba">
		
	</div>

	<div class="listines-text" style="display:none">
		<div class="row">
			<div class="col-lg-offset-2 col-lg-5">
				<?php echo $form->textFieldGroup($modelListin,'lis_num1',array('widgetOptions'=>array(
				'htmlOptions'=>array('class'=>'span5')))); ?>
				<?php echo $form->textFieldGroup($modelListin,'lis_num2',array('widgetOptions'=>array(
				'htmlOptions'=>array('class'=>'span5')))); ?>
				<?php echo $form->textFieldGroup($modelListin,'lis_num3',array('widgetOptions'=>array(
				'htmlOptions'=>array('class'=>'span5')))); ?>
			</div>
			<div class="col-lg-5">
				<?php echo $form->textFieldGroup($modelListin,'lis_num4',array('widgetOptions'=>array(
				'htmlOptions'=>array('class'=>'span5')))); ?>
				<?php echo $form->textFieldGroup($modelListin,'lis_num5',array('widgetOptions'=>array(
				'htmlOptions'=>array('class'=>'span5')))); ?>
				<?php echo $form->textFieldGroup($modelListin,'lis_num6',array('widgetOptions'=>array(
				'htmlOptions'=>array('class'=>'span5')))); ?>
			</div>
		</div>
	</div>

	<div class="mensualidadPago" style="display:none">
		<?php echo $form->dropDownListGroup($modelMensualidadPago,'men_pag_mes_can',array('widgetOptions'=>
			array('data' => Pago::conceptoPago(),'htmlOptions'=>array('multiple' => true)
		))); ?>
	</div>

	<?php echo $form->dropDownListGroup($model,'pag_tip',array('widgetOptions'=>
		array('data' => Pago::tipoPago(),'htmlOptions'=>array('empty' => 'Seleccione...')
	))); ?>

	<?php echo $form->textFieldGroup($model,'pag_mon',array('widgetOptions'=>array(
	'htmlOptions'=>array('class'=>'span5')))); ?>

	<div class="bancoReceptor" style="display:none">
		<?php echo $form->textFieldGroup($model,'pag_ban',array('widgetOptions'=>array(
		'htmlOptions'=>array('class'=>'span5','maxlength'=>250)))); ?>
	</div>

<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Agregar' : 'Guardar',
		)); ?>
</div>

<?php $this->endWidget(); 
//CVarDumper::dump($model);
//Yii::app()->end();
?>
