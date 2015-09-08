<!DOCTYPE html>
<html lang="es">
<head>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta charset="ISO-8859-1"> -->
    <meta charset="utf-8">
    <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
    <style type="text/css">
        th, .tituloPequenio { color: #428BCA;}
        .peligro { background-color: red;}
        .vAlignTop {vertical-align: top;}
        .vAlignBottom {vertical-align: bottom; margin-bottom: 0px;}
        .codigo {font-size:25px; color: red;}
    </style>
</head>
<body>

    <!--mpdf
    <htmlpageheader name="headerNumPaginas" style="display:none">
        <div class="container">
            <div class="row">
                <table width="100%" >
                    <tr>
                        <td width="15%" align="center">
                        </td>
                        <td width="60%" align="center">
                            <?php echo CHtml::image(
                            Yii::app()->request->baseUrl."/images/sistema/membrete.jpg", 
                            'Membrete', 
                            array("width"=>450)) ?>
                        </td>
                        <td width="25%" align="center">
                            <br /> <br /><br />
                            <h4>{PAGENO} de {nbpg} páginas</h4>
                        </td>
                    </tr>
                </table>                
            </div>
        </div>
    </htmlpageheader>
    mpdf-->

    <!--mpdf
    <htmlpageheader name="headerSinNumPaginas" style="display:none">
        <div class="container">
            <div class="row">
                <table width="100%" >
                    <tr>
                        <td width="20%" align="center">
                        </td>
                        <td width="60%" align="center">
                            <?php echo CHtml::image(
                            Yii::app()->request->baseUrl."/images/sistema/membrete.jpg", 
                            'Membrete', 
                            array("width"=>450)) ?>
                        </td>
                        <td width="20%" align="center">
                        </td>
                    </tr>
                </table>                
            </div>
        </div>
    </htmlpageheader>
    mpdf-->

    <div class="container">
        <?php echo $content; ?>
    </div>

</body>
</html>
