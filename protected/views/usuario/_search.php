<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type' => 'horizontal',
    'htmlOptions' => array('class' => 'well'),
)); ?>

<?php echo $form->textFieldGroup($model,'usu_nom',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>20)))); ?>

<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
		'buttonType' => 'submit',
		'context'=>'primary',
		'label'=>'Búsqueda',
	)); ?>
</div>

<?php $this->endWidget(); ?>