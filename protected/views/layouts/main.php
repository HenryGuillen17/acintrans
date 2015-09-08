<!DOCTYPE html>
<html lang="es">
<head>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta charset="ISO-8859-1"> -->
    <meta charset="utf-8">
    <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
    <style type="text/css">
        html, body {
            height:100%;
        }
        #wrap {
            height:auto;
            margin:0 auto -60px;
            min-height:100%;
            padding:0 0 60px;
        }
        footer {
            background-color:#3E3E3E;
            height:60px;
        }
        .container .credit {
            margin:20px 0;
        }
        .codigo {
            font-size:25px; color: red;
        }
        .tituloPequenio { 
            color: #428BCA;
        }
    </style>
</head>
<body>
    <div id="wrap">
        <?php $this->widget('booster.widgets.TbNavbar', array(
            //'brand' => 'Title',
            'fixed' => false,
            //'fluid' => true,
            'type'=>'inverse',
            'items'=>array(
                array(
                    'class'=>'booster.widgets.TbMenu',
                    'type' => 'navbar',
                    //'htmlOptions' => array('class' => 'pull-right'),
                    'items'=>array(
                        array('label'=>'Vehículos', 'url'=>array('/vehiculo/index'), 'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'Conductores', 'url'=>array('/conductor/index'), 'visible'=>!Yii::app()->user->isGuest),
                        // array('label'=>'Organigrama', 'url'=>array('/organigrama/index'), 'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'Organigrama', 'url'=>'#', 'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'Pagos', 'url'=>array('/pago/index'), 'visible'=>!Yii::app()->user->isGuest),
                    ),
                ),
                array(
                    'class'=>'booster.widgets.TbMenu',
                    'type' => 'navbar',
                    'htmlOptions' => array('class' => 'pull-right'),
                    'items'=>array(
                        array(
                            'label'=>'Gestión Usuarios', 
                            'htmlOptions' => array('class' => 'pull-right'),
                            'visible'=>!Yii::app()->user->isGuest,
                            'items' => array(
                                array('label'=>'Personas', 'url'=>array('/persona/index'), 'visible'=>!Yii::app()->user->isGuest),
                                array('label'=>'Usuarios', 'url'=>array('/usuario/index'), 'visible'=>!Yii::app()->user->isGuest),
                                '-',
                                array('label'=>'Cambiar Contraseña', 'url'=>array('/site/change'), 'visible'=>!Yii::app()->user->isGuest),
                            ),
                        ),
                        array('label'=>'Login','url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                        array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'Acerca', 'url'=>array('/site/page', 'view'=>'about'), 'visible'=>Yii::app()->user->isGuest),
                    ),
                ),
            ),
        )); ?>

        <div class="container">
            <?php if(isset($this->breadcrumbs)):?>
                <?php $this->widget('booster.widgets.TbBreadcrumbs', array(
                    'links'=>$this->breadcrumbs,
                )); ?><!-- breadcrumbs -->
            <?php endif?>
            
            <!-- Contenido -->
            <?php echo $content; ?>

        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <p class="text-muted credit">
                        Sistema<a class="glyphicon glyphicon-adjust" href="http://acintrans.com.ve/perla">PERLA</a>
                    </p>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <p class="text-muted credit pull-right">
                        Copyright © <?php echo date('Y')?>
                        <a href="http://www.acintrans.com.ve">ACINTRANS</a>. Hecho por 
                        <a href="#">Henry Guillen</a> y 
                        <a href="#">R.R.</a>.
                    </p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
