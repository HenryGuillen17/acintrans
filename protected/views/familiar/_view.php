<?php
/* @var $this FamiliarController */
/* @var $data Familiar */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_persona1')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_persona1), array('view', 'id'=>$data->id_persona1)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_persona2')); ?>:</b>
	<?php echo CHtml::encode($data->id_persona2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fam_par')); ?>:</b>
	<?php echo CHtml::encode($data->fam_par); ?>
	<br />


</div>