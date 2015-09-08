<?php
$this->breadcrumbs=array(
	'Vehiculos'=>array('index'),
	$model->id,
);

?>

<h1>Ver Detalle Vehiculo <em><?php echo $model->id; ?></em></h1>

<div class="container">
	<div class="row" style="padding:20px 0">
		<div class="pull-left">
			<?php $this->widget('booster.widgets.TbButton', array(
				'context'=>'primary',
				'label'=>'Editar Vehículo',
				'buttonType'  => 'link',
				'url'=>array('update', 'id'=>$model->id),
			)); ?>
		</div>
		<div class="pull-right" style="padding-right:30px">
			<?php $this->widget('booster.widgets.TbButton', array(
				'context'=>'info',
				'label'=>'Exportar Informe',
				'buttonType'  => 'link',
				'url'=>array('VerVehiculo', 'id' => $model->id),
			)); ?>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
			<?php $this->widget('booster.widgets.TbDetailView',array(
				'data'=>$model,
				'attributes'=>array(
					'id',
					'veh_num_con',
					'veh_pla',
					'veh_mod',
					'veh_mar',
					'veh_col',
					'veh_anio',
					'veh_ser_car',
					'veh_ser_mot',
					'veh_seg_num_pol1',
					'veh_seg_fec_ven1',
					'veh_seg_num_pol2',
					'veh_seg_fec_ven2',
					'veh_seg_num_pol3',
					'veh_seg_fec_ven3',
				),
			)); ?>
		</div>
	</div>
</div>
<br /><br /><br />
