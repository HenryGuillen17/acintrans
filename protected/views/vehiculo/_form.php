<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'vehiculo-form',
	'enableAjaxValidation'=>true,
	'type' => 'horizontal',
    'htmlOptions' => array('class' => 'well'),
)); ?>

<p class="help-block">Campos con (<span class="required">*</span>) son requeridos.</p>

<?php echo $form->errorSummary($model); ?>

	<!-- Generarlo según con lo que no son agregados, El sistema detecta automáticamente si ya alguien lo posee -->
	<?php if ($model->isNewRecord): ?>
		<?php echo $form->textFieldGroup($model,'veh_num_con',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>2)))); ?>
	<?php endif ?>

	<?php echo $form->textFieldGroup($model,'veh_pla',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>20)))); ?>

	<?php echo $form->textFieldGroup($model,'veh_mar',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>30)))); ?>

	<?php echo $form->textFieldGroup($model,'veh_mod',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>30)))); ?>

	<?php echo $form->textFieldGroup($model,'veh_col',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>20)))); ?>

	<!-- Año del vehículo -->
	<?php echo $form->dropDownListGroup($model,'veh_anio', array('widgetOptions'=>
		array('data' => $model->getAnioVehiculo(),'htmlOptions'=>array('empty' => 'Seleccione...')
	))); ?>

	<!-- No me acuerdo de que era este campo -->
	<?php //echo $form->textFieldGroup($model,'veh_tipo',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>30)))); ?>

	<?php echo $form->textFieldGroup($model,'veh_ser_car',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>30)))); ?>

	<?php echo $form->textFieldGroup($model,'veh_ser_mot',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>30)))); ?>

	<div class="row">
		<div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-2">
			<p><?php $this->widget('booster.widgets.TbLabel',array('context' => 'info','label' => 'Seguro Venezolano',)); ?></p>
		</div>
	</div>

	<?php echo $form->textFieldGroup($model,'veh_seg_num_pol1',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>20)))); ?>

	<?php echo $form->datePickerGroup($model,'veh_seg_fec_ven1',array('widgetOptions'=>
		array('options'=>array('language' => 'es', 'format'=>'dd-mm-yyyy'),'htmlOptions'=>array('class'=>'span5')), 
		'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>', 
		'append'=>'Haga clic en Mes/Año para seleccionar un diferente Mes/Año.')); ?>

	<div class="row">
		<div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-2">
			<p><?php $this->widget('booster.widgets.TbLabel',array('context' => 'info','label' => 'Seguro Colombiano- SOAT',)); ?></p>
		</div>
	</div>

	<?php echo $form->textFieldGroup($model,'veh_seg_num_pol2',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>20)))); ?>

	<?php echo $form->datePickerGroup($model,'veh_seg_fec_ven2',array('widgetOptions'=>
		array('options'=>array('language' => 'es', 'format'=>'dd-mm-yyyy'),'htmlOptions'=>array('class'=>'span5')), 
		'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>', 
		'append'=>'Haga clic en Mes/Año para seleccionar un diferente Mes/Año.')); ?>

	<div class="row">
		<div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-2">
			<p><?php $this->widget('booster.widgets.TbLabel',array('context' => 'info','label' => 'Revisión Tecno Mecánica - GASES',)); ?></p>
		</div>
	</div>

	<?php echo $form->textFieldGroup($model,'veh_seg_num_pol3',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>20)))); ?>

	<?php echo $form->datePickerGroup($model,'veh_seg_fec_ven3',array('widgetOptions'=>
		array('options'=>array('language' => 'es', 'format'=>'dd-mm-yyyy'),'htmlOptions'=>array('class'=>'span5')), 
		'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>', 
		'append'=>'Haga clic en Mes/Año para seleccionar un diferente Mes/Año.')); ?>

<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Agregar' : 'Guardar',
		)); ?>
</div>

<?php $this->endWidget(); ?>
