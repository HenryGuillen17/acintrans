<?php 
/**
 * 
 * 
 * 
 **/
?>
<!--mpdf
    <sethtmlpageheader name="headerNumPaginas" page="O" value="on" show-this-page="1" />
mpdf-->

 <div class="container">
	<div class="row">
		<h1 class="text-center">Total Listines Entregados</h1>
	</div>
	<div class="row">
		
		<h5 class="text-center"><span class="tituloPequenio">Del día: </span>
        <u><?php echo $modelDV->fechaInicio?></u>,
        <span class="tituloPequenio"> hasta el día: </span>
        <u><?php echo $modelDV->fechaFin ?></u></54>

	</div>

	<?php if (isset($model)): ?>
    <div class="row">
        <?php $model->pagination = false; ?>
        <?php $this->widget('booster.widgets.TbGridView', array(
            'id'=>'listaListines-grid',
            'dataProvider'=>$model,
            'type' => 'striped hover bordered condensed',
            'columns'=>array(
                array('name'=>'veh_num_con', 'htmlOptions' => array('width'=>'120'), 
                	'value' => '$data->idConductor->idVehiculo->veh_num_con', 'header' => 'Num. Control'),
                array('name'=>'id', 'htmlOptions' => array('width'=>'120'), 
                    'value' => '$data->id', 'header' => 'Recibo Pago'),
                array('name'=>'lis_num1', 'htmlOptions' => array('width'=>'120'), 
                    'value' => '$data->listin->lis_num1', 'header' => 'Listín N# 1'),
                array('name'=>'lis_num2', 'htmlOptions' => array('width'=>'120'), 
                    'value' => '$data->listin->lis_num2', 'header' => 'Listín N# 2'),
                array('name'=>'lis_num3', 'htmlOptions' => array('width'=>'120'), 
                    'value' => '$data->listin->lis_num3', 'header' => 'Listín N# 3'),
                array('name'=>'lis_num4', 'htmlOptions' => array('width'=>'120'), 
                    'value' => '$data->listin->lis_num4', 'header' => 'Listín N# 4'),
                array('name'=>'lis_num5', 'htmlOptions' => array('width'=>'120'), 
                    'value' => '$data->listin->lis_num5', 'header' => 'Listín N# 5'),
                array('name'=>'lis_num6', 'htmlOptions' => array('width'=>'120'), 
                    'value' => '$data->listin->lis_num6', 'header' => 'Listín N# 6'),
            ),
        )); ?>

    </div>
    <?php endif ?>
    <?php if (!isset($model)): ?>
        <h2 class="text-center">NO HAY RESULTADOS</h2>
    <?php endif ?>
</div>
