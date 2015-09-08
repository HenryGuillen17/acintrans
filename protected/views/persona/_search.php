<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type' => 'horizontal',
    'htmlOptions' => array('class' => 'well'),
)); ?>

		<?php echo $form->textFieldGroup($model,'per_nom',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>40)))); ?>

		<?php echo $form->textFieldGroup($model,'per_ape',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>40)))); ?>

		<?php echo $form->textFieldGroup($model,'per_ced',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>20)))); ?>

	<div class="form-actions">
		<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType' => 'submit',
			'context'=>'primary',
			'label'=>'Buscar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
