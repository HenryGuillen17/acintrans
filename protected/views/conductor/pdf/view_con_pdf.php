<?php
/**
 * view_con_pdf.php
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

<h1 class="text-center">Información del Conductor</em></h1>
<br />
<table class="table" width="100%">
	<tr>
		<td width="50%" align="center">
      <h3 class="text-center">Datos del Conductor:</h3>
      <br />
			<?php $this->widget('booster.widgets.TbDetailView', array(
				'data'=>$model,
				'attributes'=>array(
					array('name'=>'con_tip_con','value'=>($model->con_tip_con == 0) ? "Asociado":"Avance"),
					'idVehiculo.veh_num_con',
					'idVehiculo.veh_pla',
                    array('name'=>'idPersona.per_ced','value'=>$model->con_nac . "-" . $model->idPersona->per_ced),
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
				),
			)); ?>
		</td>
		<td class="vAlignTop" width="50%" align="center" style="padding-top:0px;">
            <?php echo CHtml::image(
                Yii::app()->request->baseUrl."/images/uploads/" . $model->con_fot, 
                $model->idPersona->per_nom, 
                array("width"=> 200, "height" => 200, 'class' => 'img-thumbnail')); 
            ?>
			<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
			<h3 class="text-center">Datos del Familiar:</h3>
            <div>
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
		</td>
	</tr>
</table>

<table class="table vAlignBottom condensed" align="center">
    <tr align="center">
        <td width="40%" align="center">
            <br /><br />____________________________
        </td>
        <td width="19%" align="center">
            <br /><br /><br /><br />
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