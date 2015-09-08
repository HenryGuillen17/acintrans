<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - Acerca de';
$this->breadcrumbs=array(
	'Acerca de',
);
?>
<h1>Acerca de</h1>

<div class="container">
	<div class="row">
	    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	        <p class="text-muted credit text-center">
	            Sistema<a class="glyphicon glyphicon-adjust" href="http://acintrans.com.ve/perla">PERLA</a>
	        </p>
	    </div>
	    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	        <p class="text-muted credit text-center">
	            Copyright © <?php echo date('Y')?>
	            <a href="http://www.acintrans.com.ve">ACINTRANS</a>. Hecho por 
	            <a href="#">Henry Guillen</a> y 
	            <a href="#">Ruddy Rodríguez</a>.
	        </p>
	    </div>
	</div>
</div>
