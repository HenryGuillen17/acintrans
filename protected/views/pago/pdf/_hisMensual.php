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
		<h1 class="text-center">Historial Pago Mensual</h1>
	</div>
    <div class="row text-center">

        <h4><span class="tituloPequenio">Número de Control:</span>
        <u><?php echo $modelDV->numeroControl?></u>,
        <span class="tituloPequenio">Nombres y Apellidos:</span>
        <u><?php echo $modelDV->nomConductor ?></u></h4>

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
                array('name'=>'id_pago',            'htmlOptions' => array('width'=>'100'),
                 'value' => '$data->id_pago', 'header' => 'Recibo de Ingreso'),
                array('name'=>'men_pag_mes_can',    'htmlOptions' => array('width'=>'100'), 
                    'value'=> 'Yii::app()->FuncionesImportantes->getMesNumeroALetra(date("m",
                     strtotime($data->men_pag_mes_can))) ." de " . 
                    date("Y", strtotime($data->men_pag_mes_can))'),
                array('name'=>'men_pag_mon',        'htmlOptions' => array('width'=>'100'), 
                    'value' => '$data->men_pag_mon . " Bs"'),
                array('name' => 'pag_con',          'htmlOptions' => array('width'=>'100'), 
                    'value' => '$data->idPago->pag_con == "M" ? "Mensualidad" : 
                    ($data->pag_con == "L" ? "Listines" : ($data->pag_con == "U" ? "Uniformes" : 
                    ($data->pag_con == "C" ? "Carnet" : ($data->pag_con == "P" ? "Publicidad" : 
                    ($data->pag_con == "R" ? "Recolectas" : "(none)")))))', 'header' => 'Concepto de Pago'),
                array('name'=>'pag_tip',            'htmlOptions' => array('width'=>'100'),
                    'value' => '$data->idPago->pag_tip == "E" ? "Efectivo" : ($data->idPago->pag_tip == "D" ? 
                        "Depósito" : ($data->idPago->pag_tip == "T" ? "Transferencia" : ($data->idPago->pag_tip 
                            == "C" ? "Cheque" : "(none)")))', 'header' => 'Tipo de Pago'),
                array('name'=>'pag_fec_ing',        'htmlOptions' => array('width'=>'100'),  
                    'value'=>'$data->idPago->pag_fec_ing',
                    'header' => 'Fecha de Pago'),
                
            ),
        )); ?>
    </div>
    <?php endif ?>
    <?php if (!isset($model[0])): ?>
        <h2 class="text-center">NO HAY RESULTADOS</h2>
    <?php endif ?>
</div>