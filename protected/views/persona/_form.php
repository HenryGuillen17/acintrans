<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'persona-form',
	'enableAjaxValidation'=>true,
	'type' => 'horizontal',
    'htmlOptions' => array('class' => 'well'),
)); ?>

<p class="help-block">Campos con (<span class="required">*</span>) son requeridos.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldGroup($model,'per_nom',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>40)))); ?>

	<?php echo $form->textFieldGroup($model,'per_ape',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>40)))); ?>

	<?php // En actualizar, esto no se debe mostrar. ?>
	<?php if ($model->isNewRecord==true) : ?>
		<?php echo $form->textFieldGroup($model,'per_ced',
			array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>20)))); ?>
	<?php endif ?>

	<?php echo $form->textAreaGroup($model,'per_dir', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>2, 'cols'=>50, 'class'=>'span8')))); ?>

	<?php echo $form->textFieldGroup($model,'per_tel1',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>20)))); ?>

	<?php echo $form->textFieldGroup($model,'per_tel2',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>20)))); ?>

<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Agregar' : 'Guardar',
		)); ?>
</div>

<?php $this->endWidget(); ?>
