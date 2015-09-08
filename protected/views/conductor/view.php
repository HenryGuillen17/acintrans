<?php
/* @var $this ConductorController */
/* @var $model Conductor */

$this->breadcrumbs=array(
	'Conductores'=>array('index'),
	$model->id,
);

?>

<h1>Ver Detalle Conductor <em><?php echo $model->id; ?></em></h1>

<div class="container">
	<div class="row" style="padding:20px 0">
		<div class="pull-left">
			<?php $this->widget('booster.widgets.TbButton', array(
				'context'=>'primary',
				'label'=>'Editar Conductor',
				'buttonType'  => 'link',
				'url'=>array('update', 'id'=>$model->id),
			)); ?>
		</div>
		<div class="pull-right" style="padding-right:30px">
			<?php $this->widget('booster.widgets.TbButton', array(
				'context'=>'info',
				'label'=>'Exportar Informe',
				'buttonType'  => 'link',
				'url'=>array('VerConductor', 'id' => $model->id),
			)); ?>
		</div>
	</div>
</div>

<?php /*
	CVarDumper::dump($modelFamiliares); 
	Yii::app()->end(); */
?>

<div class="container">
	<div class="row">
		<div class="col-xs-6col-sm-6 col-md-6 col-lg-6">
			<?php $this->widget('booster.widgets.TbDetailView', array(
				'data'=>$model,
				'attributes'=>array(
					array('name'=>'con_tip_con','value'=>($model->con_tip_con == 0) ? "Asociado":"Avance"),
					'idVehiculo.veh_num_con',
					'idVehiculo.veh_pla',
					'idPersona.per_ced',
					'con_fec_ven_ced',
					'idPersona.per_nom',
					'idPersona.per_ape',
					'idPersona.per_dir',
					'idPersona.per_tel1',
					'idPersona.per_tel2',
					'con_fec_ing',
					'con_rif',
					'con_fec_ven_rif',
					'con_gra_lic',
					'con_fec_ven_lic',
					'con_cer_med',
					'con_fec_cer_med',
					//'id',
					array('name'=>'con_nac','value'=>($model->con_nac == 'V') ? "Venezolano":"Extranjero"),
				),
			)); ?>
		</div>
		<div class="col-xs-6col-sm-6 col-md-6 col-lg-6">
			<?php $this->widget('booster.widgets.TbDetailView', array(
				'data'=>$model,
				'attributes'=>array(
					array('type' => 'raw', 'label' => '', 
						'value' => CHtml::image(Yii::app()->request->baseUrl."/images/uploads/".$model->con_fot,
							"con_fot", array('width'=>200,'height'=>200, 'title'=>$model->con_fot))), //, 
				),
			)); ?>
			<h3>Datos del Familiar:</h3>
			<?php $this->widget('booster.widgets.TbDetailView', array(
				'data'=>$modelFamiliares,
				'attributes'=>array(
					'idPersona2.per_ced',
					'idPersona2.per_nom',
					'idPersona2.per_ape',
					'idPersona2.per_dir',
					'idPersona2.per_tel1',
					'idPersona2.per_tel2',
					'fam_par',
				),
			)); ?>
		</div>
	</div>
</div>
<br /><br /><br />