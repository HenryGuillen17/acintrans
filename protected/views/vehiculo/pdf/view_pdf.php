<?php
/**
 * viev_pdf.php
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
		<h1 class="text-center">Lista De Vehículos</h1>
	</div>
	<div class="row">
		<?php 
			$dataProvider = $model->search();
			$dataProvider->pagination = false;
		?>
		<?php $this->widget('booster.widgets.TbGridView', array(
			'id'=>'listaVehiculos-grid',
			'dataProvider'=>$dataProvider,
			//'filter'=>$model,
			'type' => 'striped hover bordered condensed',
			'columns'=>array(
				//array('name'=>'id', 		'htmlOptions'=>array('width'=>'100'), 'value'=>'$data->id'),
				array('name'=>'veh_num_con','htmlOptions'=>array('width'=> '60'), 'value'=>'$data->veh_num_con'),
				array('name'=>'veh_pla',	'htmlOptions'=>array('width'=>'100'), 'value'=>'$data->veh_pla'),
				array('name'=>'veh_mod', 	'htmlOptions'=>array('width'=>'100'), 'value'=>'$data->veh_mod'),
				array('name'=>'veh_mar', 	'htmlOptions'=>array('width'=>'100'), 'value'=>'$data->veh_mar'),
				array('name'=>'veh_col', 	'htmlOptions'=>array('width'=>'100'), 'value'=>'$data->veh_col'),
				array('name'=>'veh_anio', 	'htmlOptions'=>array('width'=>'100'), 'value'=>'$data->veh_anio'),
				array('name'=>'veh_ser_car','htmlOptions'=>array('width'=>'100'), 'value'=>'$data->veh_ser_car'),
				array('name'=>'veh_ser_mot','htmlOptions'=>array('width'=>'100'), 'value'=>'$data->veh_ser_mot'),
			),
		)); ?>
	</div>
</div>