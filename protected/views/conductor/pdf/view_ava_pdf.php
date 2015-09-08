<?php
/**
 * view_ava_pdf.php
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
		<h1 class="text-center">Lista De Conductores, Avance</h1>
	</div>
	<?php if (isset($model)): ?>
	<div class="row">
		<?php $model->pagination = false; ?>
		<?php $this->widget('booster.widgets.TbGridView', array(
			'id'=>'listaConductores-grid',
			'dataProvider'=>$model,
			//'filter'=>$model,
			'type' => 'striped hover bordered condensed',
			'columns'=>array(
				'idVehiculo.veh_num_con',
				'idPersona.per_ced',
				'idPersona.per_nom',
				'idPersona.per_ape',
				array('name' => 'idPersona.per_tel1', 'header' => 'Celular', 
					'value' => '$data->idPersona->per_tel1'),
				'con_rif',
				array('name'=>'con_nac','value'=>'($data->con_nac == "V") ? "Venezolano":"Extranjero"'),
			),
		)); ?>
	</div>
	<?php endif ?>
	<?php if (!isset($model)): ?>
        <h2 class="text-center">NO HAY RESULTADOS</h2>
    <?php endif ?>
</div>