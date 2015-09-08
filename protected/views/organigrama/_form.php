<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'organigrama-form',
	'enableAjaxValidation'=>true,
	'type' => 'horizontal',
    'htmlOptions' => array('class' => 'well'),
)); ?>

<p class="help-block">Campos con (<span class="required">*</span>) son requeridos.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldGroup($model,'id',array('widgetOptions'=>array('htmlOptions'=>
	array('class'=>'span5','maxlength'=>10)))); ?>

	<?php echo $form->textFieldGroup($model,'org_ano_elecc',array('widgetOptions'=>
	array('htmlOptions'=>array('class'=>'span5','maxlength'=>4)))); ?>

	<?php echo $form->dropDownListGroup($model,'org_pre', array('widgetOptions'=>
		array('data' => Persona::getListaPersonas(),'htmlOptions'=>array('empty' => 'Seleccione...')
	))); ?>

	<?php echo $form->dropDownListGroup($model,'org_vpr', array('widgetOptions'=>
		array('data' => Persona::getListaPersonas(),'htmlOptions'=>array('empty' => 'Seleccione...')
	))); ?>

	<?php echo $form->dropDownListGroup($model,'org_sec', array('widgetOptions'=>
		array('data' => Persona::getListaPersonas(),'htmlOptions'=>array('empty' => 'Seleccione...')
	))); ?>

	<?php echo $form->dropDownListGroup($model,'org_tes', array('widgetOptions'=>
		array('data' => Persona::getListaPersonas(),'htmlOptions'=>array('empty' => 'Seleccione...')
	))); ?>

	<?php echo $form->dropDownListGroup($model,'org_td1', array('widgetOptions'=>
		array('data' => Persona::getListaPersonas(),'htmlOptions'=>array('empty' => 'Seleccione...')
	))); ?>

	<?php echo $form->dropDownListGroup($model,'org_td2', array('widgetOptions'=>
		array('data' => Persona::getListaPersonas(),'htmlOptions'=>array('empty' => 'Seleccione...')
	))); ?>

	<?php echo $form->dropDownListGroup($model,'org_td3', array('widgetOptions'=>
		array('data' => Persona::getListaPersonas(),'htmlOptions'=>array('empty' => 'Seleccione...')
	))); ?>

	<?php echo $form->dropDownListGroup($model,'org_rf1', array('widgetOptions'=>
		array('data' => Persona::getListaPersonas(),'htmlOptions'=>array('empty' => 'Seleccione...')
	))); ?>

	<?php echo $form->dropDownListGroup($model,'org_rf2', array('widgetOptions'=>
		array('data' => Persona::getListaPersonas(),'htmlOptions'=>array('empty' => 'Seleccione...')
	))); ?>

<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>
