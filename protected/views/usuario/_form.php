<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'usuario-form',
	'enableAjaxValidation'=>true,
	'type' => 'horizontal',
    'htmlOptions' => array('class' => 'well'),
)); ?>

<?php
	if ($model->isNewRecord) {
		$user = Yii::app()->getComponent('user');
		$user->setFlash('info','<strong>¡Atento!</strong> Antes de agregar a un <em>Usuario</em>, 
			debes agregarlo a <strong><em>' . CHtml::link('Persona', array('/persona/create')) . 
			'</em></strong>.');

		$this->widget('booster.widgets.TbAlert', array(
		    'fade' => true,
		    'closeText' => '¡ENTENDIDO!', // false equals no close link
		    'userComponentId' => 'user',
		));
	}
?>

<p class="help-block">Campos con (<span class="required">*</span>) son requeridos.</p>

<?php echo $form->errorSummary($model);?>

	<?php echo $form->dropDownListGroup($model,'id_persona', 
		array(
		'widgetOptions'=>array(
			'data' => Usuario::getListaPersonasSinUsuario(),
			'htmlOptions'=>array('empty' => 'Seleccione...')
	))); ?>

	<?php echo $form->textFieldGroup($model,'usu_nom',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>20)))); ?>

	<?php // En actualizar, esto no se debe mostrar. ?>
	<?php if ($model->isNewRecord) : ?>
		<?php echo $form->passwordFieldGroup($model,'usu_cla',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5', 'maxlength'=>20)))); ?>
		
		<?php echo $form->passwordFieldGroup($model,'usu_cla2',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5', 'maxlength'=>20)))); ?>
	<?php endif ?>

<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Agregar' : 'Guardar',
		)); ?>
</div>

<?php $this->endWidget(); ?>
