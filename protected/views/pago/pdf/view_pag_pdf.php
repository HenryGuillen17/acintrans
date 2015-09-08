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
<?php
	$conceptoPago = $model->pag_con == "M" ? "Mensualidad" : 
		($model->pag_con == "L" ? "Listines" : ($model->pag_con == "U" ? "Uniformes" : 
		($model->pag_con == "C" ? "Carnet" : ($model->pag_con == "P" ? "Publicidad" : 
		($model->pag_con == "R" ? "Recolectas" : "(none)")
	))));

	$tipoPago = $model->pag_tip == "E" ? "Efectivo" : ($model->pag_tip == "D" ? "Depósito" :
		($model->pag_tip == "T" ? "Transferencia" : ($model->pag_tip == "C" ? "Cheque" : "(none)")));

	$descripcion = Pago::getConceptoPago($model->id, $model->pag_con);

	$banco = $model->pag_ban == '' ? "en {$tipoPago}" : "por {$tipoPago} en el Banco {$model->pag_ban}";

	$pago = "por {$tipoPago} {$banco}.";

?>

<table width="100%">
	<tr width"100%">
		<td colspan="3" align="center">
			<div class="text-center">
				<?php echo CHtml::image(Yii::app()->request->baseUrl."/images/sistema/membrete.jpg", 'Membrete', array("width"=>450)) ?>
			</div>
		</td>
	</tr>
	<tr>
		<td colspan="3" align="center">
			<h2>Recibo de Pago</h2>
		</td>
	</tr>
	<tr>
		<td>
			<span class="tituloPequenio">Fecha:</span> 
			<u><?php echo $model->pag_fec_ing ?></u>
		</td>
		<td></td>
		<td align="right">
			<span class="tituloPequenio">Recibo Ingreso:</span> 
			<span class="codigo"><?php echo $model->pag_anu == 0 ? $model->id : "ANULADO" ?></span>
			</td>
	</tr>
	<?php if (strlen($descripcion) <= 2): ?>
	<tr>
		<td colspan="3">
			&nbsp;
		</td>
	</tr>
	<?php endif ?>
	<tr>
		<td colspan="2">
			<span class="tituloPequenio">Hemos Recibido de:</span> 
			<u><?php echo $model->idConductor->idPersona->per_nom ?> 
			<?php echo $model->idConductor->idPersona->per_ape ?></u>
		</td>
		<td>
			<span class="tituloPequenio">RIF:</span> 
			<?php echo $model->idConductor->con_rif ?>
		</td>
	</tr>
	<tr>
		<td>
			<span class="tituloPequenio">La Cantidad de: </span>
			<u><?php echo $model->pag_mon ?> Bs.</u>
		</td>
		<td></td>
		<td>
			<span class="tituloPequenio">Por Concepto de:</span> 
			<u><?php echo $conceptoPago ?></u>
		</td>
	</tr>
	<?php if ($descripcion != ''): ?>
	<tr>
		<td colspan="3">
			<span class="tituloPequenio">Detalle del Pago:</span> 
			<?php echo $descripcion ?>
		</td>
	</tr>
	<?php endif ?>
	<tr>
		<td>
			<span class="tituloPequenio">Tipo de Pago:</span> 
			<u><?php echo $tipoPago ?></u>
		</td>
		<td></td>
		<td>
			<?php if ($model->pag_ban): ?>
				<span class="tituloPequenio">Banco:</span> 
				<u><?php echo $model->pag_ban ?></u>
			<?php endif ?>
		</td>
	</tr>
</table>
<table class="table vAlignBottom condensed" align="center">
    <tr align="center">
        <td width="40%" align="center">
            <br /><br />____________________________
        </td>
        <td width="19%" align="center">
            <br /><br /><br />
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
    <tr>
    	<td align="right" colspan="3"><span style="color:red;">Original</span></td>
    </tr>
</table>
<hr>
<!-- ########################################################################################################################################################################################################################### -->
<table width="100%" style="margin-top:20px">
	<tr width"100%">
		<td colspan="3" align="center">
			<div class="text-center">
				<?php echo CHtml::image(Yii::app()->request->baseUrl."/images/sistema/membrete.jpg", 'Membrete', array("width"=>450)) ?>
			</div>
		</td>
	</tr>
	<tr>
		<td colspan="3" align="center">
			<h2>Recibo de Pago</h2>
		</td>
	</tr>
	<tr>
		<td>
			<span class="tituloPequenio">Fecha:</span> 
			<u><?php echo $model->pag_fec_ing ?></u>
		</td>
		<td></td>
		<td align="right">
			<span class="tituloPequenio">Recibo Ingreso:</span> 
			<span class="codigo"><?php echo $model->pag_anu == 0 ? $model->id : "ANULADO" ?></span>
			</td>
	</tr>
	<?php if (strlen($descripcion) <= 200): ?>
	<tr>
		<td colspan="3">
			&nbsp;
		</td>
	</tr>
	<?php endif ?>
	<tr>
		<td colspan="2">
			<span class="tituloPequenio">Hemos Recibido de:</span> 
			<u><?php echo $model->idConductor->idPersona->per_nom ?> 
			<?php echo $model->idConductor->idPersona->per_ape ?></u>
		</td>
		<td>
			<span class="tituloPequenio">RIF:</span> 
			<?php echo $model->idConductor->con_rif ?>
		</td>
	</tr>
	<tr>
		<td>
			<span class="tituloPequenio">La Cantidad de: </span>
			<u><?php echo $model->pag_mon ?> Bs.</u>
		</td>
		<td></td>
		<td>
			<span class="tituloPequenio">Por Concepto de:</span> 
			<u><?php echo $conceptoPago ?></u>
		</td>
	</tr>
	<?php if ($descripcion != ''): ?>
	<tr>
		<td colspan="3">
			<span class="tituloPequenio">Detalle del Pago:</span> 
			<?php echo $descripcion ?>
		</td>
	</tr>
	<?php endif ?>
	<tr>
		<td>
			<span class="tituloPequenio">Tipo de Pago:</span> 
			<u><?php echo $tipoPago ?></u>
		</td>
		<td></td>
		<td>
			<?php if ($model->pag_ban): ?>
				<span class="tituloPequenio">Banco:</span> 
				<u><?php echo $model->pag_ban ?></u>
			<?php endif ?>
		</td>
	</tr>
</table>
<table class="table vAlignBottom condensed" align="center">
    <tr align="center">
        <td width="40%" align="center">
            <br /><br />____________________________
        </td>
        <td width="19%" align="center">
            <br /><br /><br />
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
    <tr>
    	<td align="right" colspan="3"><strong>Copia</strong></td>
    </tr>
</table>