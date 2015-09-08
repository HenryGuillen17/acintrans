<?php
/* @var $this UsuarioController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Usuarios',
);
?>

<h1>Usuarios</h1>

<div class="container">
    
    <div class="row" style="padding-top:20px">
        <div class="pull-left">
            <?php $this->widget('booster.widgets.TbButton', array(
                'context'=>'primary',
                'label'=>'Agregar Usuario',
                'buttonType'  => 'link',
                'url'=>array('create'),
            )); ?>
        </div>
    </div>
</div>

<?php $this->widget('booster.widgets.TbGridView', array(
	'id'=>'usuario-grid',
	'dataProvider'=>$model->search(),
	'type' => 'striped hover',
	'filter'=>$model,
	'columns'=>array(
		'id',
		'id_persona',
		array('name'=>'per_nom','value'=>'$data->idPersona->per_nom','type'=>'text',),
        array('name'=>'per_ape','value'=>'$data->idPersona->per_ape','type'=>'text',),
		'usu_nom',
		/*
		'usu_cla',
		*/
		array(
			'class'=>'booster.widgets.TbButtonColumn',
			'htmlOptions' => array('nowrap'=>'nowrap'),
		),
	),
)); ?>
