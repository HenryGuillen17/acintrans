<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Inicio de Sesión',
);
?>

<h1>Inicio de Sesión</h1>


<div class="container">
	<p>Por favor complete el siguiente formulario con sus datos de acceso:</p>
	<div class="row">
		<div class="col-sm-6">
		<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
			'id'=>'login-form',
			'enableClientValidation'=>true,
			//'type' => 'horizontal',
			'clientOptions'=>array(
				'validateOnSubmit'=>true,
			),
		)); ?>

		<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

		<?php echo $form->textFieldGroup($model,'username',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>20)))); ?>

		<?php echo $form->passwordFieldGroup($model,'password',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5', 'maxlength'=>20)))); ?>

		<?php echo $form->checkBoxGroup($model,'rememberMe'); ?>

		<div class="form-actions">
			<?php $this->widget('booster.widgets.TbButton', array(
				'buttonType'=>'submit',
				'context'=>'primary',
				'label'=>'Iniciar Sesión',
			)); ?>
		</div>

		<?php $this->endWidget(); ?>
		</div>
	</div>
</div><!-- form -->
