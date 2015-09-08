<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type' => 'horizontal',
    'htmlOptions' => array('class' => 'well'),
)); ?>

		<?php echo $form->dropDownListGroup($model,'con_tip_con',array('widgetOptions'=>
			array('data' => Conductor::tipoConductor(),'htmlOptions'=>array('empty' => 'Seleccione...')
		))); ?>

		<?php echo $form->textFieldGroup($model,'con_rif',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>20)))); ?>
		
		<!-- Debería aparecer los Números de control aqui, pero decidí que no (Falta Modificar) -->
		<?php echo $form->textFieldGroup($model,'id_vehiculo',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>10)))); ?>

		<!-- Debería buscar aquí por nombre de persona, pero decidí que no :D (Falta Modificar) -->
		<?php echo $form->textFieldGroup($model,'id_persona',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>10)))); ?>

	<div class="form-actions">
		<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType' => 'submit',
			'context'=>'primary',
			'label'=>'Búsqueda',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
