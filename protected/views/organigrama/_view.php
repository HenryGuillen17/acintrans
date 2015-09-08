<?php
/* @var $this OrganigramaController */
/* @var $data Organigrama */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('org_ano_elecc')); ?>:</b>
	<?php echo CHtml::encode($data->org_ano_elecc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('org_nom_pr')); ?>:</b>
	<?php echo CHtml::encode($data->org_nom_pr); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('org_nom_vp')); ?>:</b>
	<?php echo CHtml::encode($data->org_nom_vp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('org_nom_tes')); ?>:</b>
	<?php echo CHtml::encode($data->org_nom_tes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('org_nom_d1')); ?>:</b>
	<?php echo CHtml::encode($data->org_nom_d1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('org_nom_d2')); ?>:</b>
	<?php echo CHtml::encode($data->org_nom_d2); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('org_nom_d3')); ?>:</b>
	<?php echo CHtml::encode($data->org_nom_d3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('org_nom_r1')); ?>:</b>
	<?php echo CHtml::encode($data->org_nom_r1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('org_nom_r2')); ?>:</b>
	<?php echo CHtml::encode($data->org_nom_r2); ?>
	<br />

	*/ ?>

</div>