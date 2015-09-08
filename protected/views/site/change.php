<?php
/* @var $this SiteController */
/* @var $model ChangeForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Cambiar Contraseña';
$this->breadcrumbs=array(
	'Cambiar Contraseña',
);
?>

<div class="container">

	<h1>Cambiar Contraseña</h1>

	<?php if (Yii::app()->user->hasFlash('success')): ?>
		<div class="alert alert-success">
			<?php echo Yii::app()->user->getFlash('success') ?>
		</div>
	<?php endif ?>
	<?php if (Yii::app()->user->hasFlash('error')): ?>
		<div class="alert alert-danger">
			<?php echo Yii::app()->user->getFlash('error') ?>
		</div>
	<?php endif ?>

	<div class="form-horizontal">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'login-form',
			'enableClientValidation'=>true,
			'clientOptions'=>array(
				'validateOnSubmit'=>true,
			),
		)); ?>

	    <div class="form-group">
	        <?php echo $form->labelEx($model,'password', array('class'=>'control-label col-sm-2')); ?>
	        <div class="col-sm-2">
	            <?php echo $form->passwordField($model,'password'); ?>
	            <?php echo $form->error($model,'password'); ?>
	        </div>
	    </div>

	    <div class="form-group">
	        <?php echo $form->labelEx($model,'password_new', array('class'=>'control-label col-sm-2')); ?>
	        <div class="col-sm-2">
	            <?php echo $form->passwordField($model,'password_new'); ?>
	            <?php echo $form->error($model,'password_new'); ?>
	        </div>
	    </div>

	    <div class="form-group">
	        <?php echo $form->labelEx($model,'password_new_repeat', array('class'=>'control-label col-sm-2')); ?>
	        <div class="col-sm-2">
	            <?php echo $form->passwordField($model,'password_new_repeat'); ?>
	            <?php echo $form->error($model,'password_new_repeat'); ?>
	        </div>
	    </div>

	    <div class="form-group buttons">
	        <div class="col-sm-2 col-sm-offset-2">
	            <?php echo CHtml::submitButton('Cambiar Contraseña', array('class'=>'btn btn-primary ')); ?>
	        </div>
	    </div>

	<?php $this->endWidget(); ?>
	</div><!-- form -->

</div>
