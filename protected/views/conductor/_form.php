<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'conductor-form',
	'enableAjaxValidation'=>true,
	'type' => 'horizontal',
    'htmlOptions' => array('class' => 'well', 'enctype' => 'multipart/form-data'),
)); ?>

<?php if (!$model->isNewRecord) {
	$modelFamiliares = Familiar::model()->findByPk($model->id_persona);
}?>

<?php
	if ($model->isNewRecord) {
		$user = Yii::app()->getComponent('user');
		$user->setFlash('info','<strong>¡Atento!</strong> Antes de agregar a un <em>Conductor</em>, 
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

<?php echo $form->errorSummary(array($model, $modelFamiliares)); ?>
	
	<?php if ($model->isNewRecord) : ?>

		<?php echo $form->dropDownListGroup($model,'id_vehiculo',array('widgetOptions'=>
			array('data' => Vehiculo::getNumeroControl(), 'htmlOptions'=>array('empty' => 'Seleccione...')
		))); ?>

		<?php echo $form->dropDownListGroup($model,'id_persona',array('widgetOptions'=>
			array('data' => $model->getListaPersonasSinConductor(),'htmlOptions'=>
				array('empty' => 'Seleccione...')
		))); ?>
		
	<?php endif; ?>

	<?php echo $form->dropDownListGroup($model,'con_tip_con',array('widgetOptions'=>
		array('data' => $model->tipoConductor(),'htmlOptions'=>array('empty' => 'Seleccione...')
	))); ?>

	<?php echo $form->dropDownListGroup($model,'con_nac',array('widgetOptions'=>
		array('data' => $model->nacionalidad(),'htmlOptions'=>array('empty' => 'Seleccione...')
	))); ?>

	<?php echo $form->datePickerGroup($model,'con_fec_ven_ced',array('widgetOptions'=>
		array('options'=>array('language' => 'es', 'format'=>'dd-mm-yyyy'),'htmlOptions'=>array('class'=>'span5')), 
		'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>', 
		'append'=>'Haga clic en Mes/Año para seleccionar un diferente Mes/Año.')); ?>

	<?php echo $form->textFieldGroup($model,'con_rif',array('widgetOptions'=>
	array('htmlOptions'=>array('class'=>'span5','maxlength'=>20)))); ?>

	<?php echo $form->datePickerGroup($model,'con_fec_ven_rif',array('widgetOptions'=>
	array('options'=>array('language' => 'es', 'format'=>'dd-mm-yyyy'),'htmlOptions'=>array('class'=>'span5')), 
	'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>', 
	'append'=>'Haga clic en Mes/Año para seleccionar un diferente Mes/Año.')); ?>

	<?php echo $form->dropDownListGroup($model,'con_gra_lic',array('widgetOptions'=>
		array('data' => $model->gradoLicencia(),'htmlOptions'=>array('empty' => 'Seleccione...')
	))); ?>

	<?php echo $form->datePickerGroup($model,'con_fec_ven_lic',array('widgetOptions'=>
	array('options'=>array('language' => 'es', 'format'=>'dd-mm-yyyy'),'htmlOptions'=>array('class'=>'span5')), 
	'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>', 
	'append'=>'Haga clic en Mes/Año para seleccionar un diferente Mes/Año.')); ?>

	<?php echo $form->textFieldGroup($model,'con_cer_med',array('widgetOptions'=>
	array('htmlOptions'=>array('class'=>'span5','maxlength'=>20)))); ?>

	<?php echo $form->datePickerGroup($model,'con_fec_cer_med',array('widgetOptions'=>
	array('options'=>array('language' => 'es', 'format'=>'dd-mm-yyyy'),'htmlOptions'=>array('class'=>'span5')), 
	'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>', 
	'append'=>'Haga clic en Mes/Año para seleccionar un diferente Mes/Año.')); ?>

	<?php echo $form->fileFieldGroup($model, 'con_fot',array('wrapperHtmlOptions' => 
	array('class' => 'col-sm-5'))); ?>

	<?php if(!$model->isNewRecord) : //mostramos la imagen en actualizar?>
	    <div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-9 col-sm-offset-3 col-md-9 col-md-offset-3 col-lg-9 col-lg-offset-3">
				<?php if ($model->con_fot != ""): ?>
	        		<?php echo CHtml::image(Yii::app()->request->baseUrl."/images/uploads/".
	        		$model->con_fot,"con_fot",array("width"=>200, 'title'=>$model->con_fot)); ?>
	        	<?php endif ?>
				</div>
			</div>
	    </div>
    <?php endif; ?>
	
	<?php echo $form->dropDownListGroup($modelFamiliares,'id_persona2',array('widgetOptions'=>
			array('data' => Persona::toList(),'htmlOptions'=>array('empty' => 'Seleccione...')
	))); ?>

	<?php echo $form->dropDownListGroup($modelFamiliares,'fam_par',array('widgetOptions'=>
			array('data' => $modelFamiliares->getListaFamiliares(),'htmlOptions'=>array('empty' => 'Seleccione...')
	))); ?>


<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Agregar' : 'Guardar',
		)); ?>
</div>

<?php $this->endWidget(); ?>
