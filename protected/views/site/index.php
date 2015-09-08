<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h2 class="text-center">Bienvenido al</h2>
<h1 class="text-center" style="font-size:50px;">Sistema<span class="tituloPequenio glyphicon glyphicon-adjust">PERLA</span></h1>
<div class="text-center">
<?php echo CHtml::image(Yii::app()->request->baseUrl."/images/sistema/InicioIndex.jpg", "foto", array("width"=>400, 'title'=>"Foto", 'class' => 'img-thumbnail')); ?>
</div>