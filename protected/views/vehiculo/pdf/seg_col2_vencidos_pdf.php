<?php
/**
 * seg_ven_vencidos.php
 * 
 *     Se encarga de renderizar una vista, disponible para imprimir en PDF.
 * Aquí se plasma todo en <em>html</em> y directamente se envía a través de un
 * <em>action</em> en el controlador para imprimir en PDF.
 * 
 * @author Henry Guillén
 * @since 10.07.2015
 * 
 * 
 * */
?>

<!--mpdf
    <sethtmlpageheader name="headerNumPaginas" page="O" value="on" show-this-page="1" />
mpdf-->

<div class="container">
	<div class="row">
		<h1 class="text-center">Revisión Tecno Mecánica - GASES Vencidos</h1>
	</div>
	<?php if (isset($model[0])): ?>
	<div class="row">
		<?php
			$dataProvider = $model[0]->search();
			$dataProvider->setData($model);
			$dataProvider->pagination = false;
		?>
		<?php $this->widget('booster.widgets.TbGridView', array(
			'id'=>'listaVehiculos-grid',
			'dataProvider'=>$dataProvider,
			'type' => 'striped hover bordered condensed',
			'columns'=>array(
				array('name'=>'id',	'htmlOptions'=>array('width'=>'100'), 'value'=>'$data->id'),
				array('name'=>'veh_num_con', 'htmlOptions'=>array('width'=> '60'), 'value'=>'$data->veh_num_con'),
				array('name'=>'veh_pla', 'htmlOptions'=>array('width'=>'100'), 'value'=>'$data->veh_pla'),
				array('name'=>'veh_seg_num_pol3', 'htmlOptions'=>array('width'=>'100'), 
					'value'=>'$data->veh_seg_num_pol3', 'header' => 'Póliza Seg. Colombiano 2'),
				array('name'=>'veh_seg_fec_ven3', 'htmlOptions'=>array('width'=>'100'), 
					'value'=>'$data->veh_seg_fec_ven3', 'header' => 'Fech. Ven. Seg. Colombiano 2'),
			),
		)); ?>
	</div>
	<?php endif ?>
	<?php if (!isset($model[0])): ?>
        <h2 class="text-center">NO HAY RESULTADOS</h2>
    <?php endif ?>
</div>

<?php 
/*
'cssClassExpression' => function($row, $data) { 
	$intervalo = Yii::app()->FuncionesImportantes->getDistanciaFecha($data->veh_seg_fec_ven1, 
	date('d-m-Y', strtotime(date('d-m-Y') . '+ 1 month')), 'm');
	if ($intervalo > 0) 
	return "danger"; 
}*/