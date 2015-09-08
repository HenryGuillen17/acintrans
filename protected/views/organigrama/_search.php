<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

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
			'buttonType' => 'submit',
			'context'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
