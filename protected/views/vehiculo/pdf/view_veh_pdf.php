<?php
/**
 * view_veh_pdf.php
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
    <sethtmlpageheader name="headerSinNumPaginas" page="O" value="on" show-this-page="1" />
mpdf-->
<h1 class="text-center">Invormación del Vehiculo <em><?php echo $model->id; ?></em></h1>
<br />
<div class="container text-center">
	<div class="row">
		<div class="col-xs-offset-3 col-xs-10 col-sm-offset-2 col-sm-10 col-md-10 col-md-offset-2 col-lg-9 col-lg-offset-3">
			<?php $this->widget('booster.widgets.TbDetailView',array(
				'data'=>$model,
				'attributes'=>array(
					//'id',
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

<table class="table vAlignBottom condensed" align="center">
    <tr align="center">
        <td width="40%" align="center">
            <br /><br />____________________________
        </td>
        <td width="19%" align="center">
            <br /><br /><br /><br /><br /><br /><br /><br />
        </td>
        <td width="40%" align="center">
            <br /><br />____________________________
        </td>
    </tr>
    <tr align="center">
        <td width="40%" align="center">Firma del Presidente</td>
        <td width="19%" align="center"></td>
        <td width="40%" align="center">Firma del Conductor</td>
    </tr>
</table>