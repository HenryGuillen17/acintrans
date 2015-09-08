<?php 
/**
 * 
 * - id Pago
 * - Mes con año
 * - Monto
 * - Fecha de Pago
 * - pag_tip
 * 
 * 
 **/
?>

<!--mpdf
    <sethtmlpageheader name="headerNumPaginas" page="O" value="on" show-this-page="1" />
mpdf-->

 <div class="container">
	<div class="row">
		<h1 class="text-center">Deudores Mensuales 
        <?php echo $modelDV->documento == '0' ? "Asociados" : "Avances" ?></h1>
	</div>
    <?php if (!empty($model)): ?>
    <div class="row">
        <h4 class="text-right">Total de
        <?php echo count($model);?>
        <?php echo count($model) > '1' ? "resultados" : "resultado" ?></h4>
        <table class="items table table-striped table-hover" border="1" bordercolor="red">
            <thead>
                <tr align="center">
                    <th>Mensualidad</th>
                    <th>Número de Control</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    foreach ($model as $key => $value) {
                        echo "<tr>";
                        foreach ($value as $key => $value1) {
                            echo '<td width="200">';
                            echo "{$value1}";
                            echo '</td>';
                        }
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>

    </div>
    <?php endif ?>
    <?php if (empty($model)): ?>
        <h2 class="text-center">NO HAY RESULTADOS</h2>
    <?php endif ?>
</div>