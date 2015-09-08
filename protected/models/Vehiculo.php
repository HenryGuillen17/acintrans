<?php

/**
 * This is the model class for table "actr_vehiculos".
 *
 * The followings are the available columns in table 'actr_vehiculos':
 * @property string $id
 * @property string $veh_num_con
 * @property string $veh_pla
 * @property string $veh_mod
 * @property string $veh_mar
 * @property string $veh_col
 * @property string $veh_anio
 * @property string $veh_tipo
 * @property string $veh_ser_car
 * @property string $veh_ser_mot
 * @property string $veh_seg_num_pol1
 * @property string $veh_seg_fec_ven1
 * @property string $veh_seg_num_pol2
 * @property string $veh_seg_fec_ven2
 * @property string $veh_seg_num_pol3
 * @property string $veh_seg_fec_ven3
 *
 * The followings are the available model relations:
 * @property Conductores[] $conductores
 */
class Vehiculo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'actr_vehiculos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, veh_num_con, veh_pla, veh_mod, veh_mar, veh_col, veh_anio, 
				veh_ser_car, veh_ser_mot, veh_seg_num_pol1, veh_seg_fec_ven1, 
				veh_seg_num_pol2, veh_seg_fec_ven2, veh_seg_num_pol3, veh_seg_fec_ven3', 'required'),
			array('id', 'length', 'max'=>10),
			array('veh_seg_fec_ven1, veh_seg_fec_ven2, veh_seg_fec_ven3', 'date', 'format'=>'dd-MM-y'),
			// Dichas fechas deben ser mayores a la actual
			array('veh_seg_fec_ven1, veh_seg_fec_ven2, veh_seg_fec_ven3', 'compararConFechaActual'),
			array('veh_num_con', 'length', 'max'=>3),
			array('veh_pla, veh_col, veh_seg_num_pol1, veh_seg_num_pol2, veh_seg_num_pol3', 'length', 'max'=>20),
			array('veh_mod, veh_mar, veh_ser_car, veh_ser_mot', 'length', 'max'=>30),
			array('veh_anio', 'length', 'max'=>4),
			array('veh_num_con, veh_pla, veh_ser_mot, veh_ser_car', 'unique'),
			array('veh_num_con','numerical','integerOnly'=>true,'min'=>1,'max'=>250,
			    'tooSmall'=>'El número debe ser mayor a "1"',
			    'tooBig'=>'El número debe ser menor a "250"',),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, veh_num_con, veh_pla, veh_mod, veh_mar, veh_col, veh_anio, veh_ser_car, 
				veh_ser_mot, veh_seg_num_pol1, veh_seg_fec_ven1, veh_seg_num_pol2, 
				veh_seg_fec_ven2, veh_seg_num_pol3, veh_seg_fec_ven3', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * compararConFechaActual
	 *
	 * Se encarga de validar que la fecha ingresada sea mayor a la fecha actual.
	 *
	 */
	public function compararConFechaActual($attribute, $params)
	{
    	if (Yii::app()->FuncionesImportantes->getDistanciaFecha($this->$attribute, date('d-m-Y'), 'd') > 0)
    	    $this->addError($attribute, 'Esta fecha debe ser mayor a la fecha actual');
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'conductores' => array(self::HAS_MANY, 'Conductor', 'id_vehiculo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'veh_num_con' => 'Núm. Control',
			'veh_pla' => 'Placa',
			'veh_mod' => 'Modelo',
			'veh_mar' => 'Marca',
			'veh_col' => 'Color',
			'veh_anio' => 'Año',
			//'veh_tipo' => 'Tipo',
			'veh_ser_car' => 'Serial de Carroceria',
			'veh_ser_mot' => 'Serial del Motor',
			'veh_seg_num_pol1' => 'Número de Póliza 1',
			'veh_seg_fec_ven1' => 'Fecha Vencimiento Seguro 1',
			'veh_seg_num_pol2' => 'Número de Póliza 2',
			'veh_seg_fec_ven2' => 'Fecha Vencimiento Seguro 2',
			'veh_seg_num_pol3' => 'Número de Póliza 3',
			'veh_seg_fec_ven3' => 'Fecha Vencimiento Seguro 3',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->with = array('conductores', 'conductores.idPersona');

		$criteria->compare('id',$this->id,true);
		$criteria->compare('veh_num_con',$this->veh_num_con,true);
		$criteria->compare('veh_pla',$this->veh_pla,true);
		$criteria->compare('veh_mod',$this->veh_mod,true);
		$criteria->compare('veh_mar',$this->veh_mar,true);
		$criteria->compare('veh_col',$this->veh_col,true);
		$criteria->compare('veh_anio',$this->veh_anio,true);
		//$criteria->compare('veh_tipo',$this->veh_tipo,true);
		$criteria->compare('veh_ser_car',$this->veh_ser_car,true);
		$criteria->compare('veh_ser_mot',$this->veh_ser_mot,true);
		$criteria->compare('veh_seg_num_pol1',$this->veh_seg_num_pol1,true);
		$criteria->compare('veh_seg_fec_ven1',$this->veh_seg_fec_ven1,true);
		$criteria->compare('veh_seg_num_pol2',$this->veh_seg_num_pol2,true);
		$criteria->compare('veh_seg_fec_ven2',$this->veh_seg_fec_ven2,true);
		$criteria->compare('veh_seg_num_pol3',$this->veh_seg_num_pol3,true);
		$criteria->compare('veh_seg_fec_ven3',$this->veh_seg_fec_ven3,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
	        	'attributes'=>array(
	            	'*',
	        	),
	        	'defaultOrder'=>'t.veh_num_con ASC',
	     	),
	   ));
	}
	
	/**
	 * getCodigo()
	 * Se encarga de generar el código para la base de datos
	 * En este caso lo generará para el Vehículo.
	 *
	 */
	public function getCodigo()
	{
		$rs = self::model()->findBySql("SELECT id FROM actr_vehiculos ORDER BY id DESC");
		
		if ($rs == null) {
			$this->id = "VEH";
		} else {
			$this->id = $rs->id;
		}

		$this->id = Yii::app()->CalculoID->getCalculoId($this->id, false);
	}

	/**
	 * getAnioVehiculo
	 * 
	 * Retorna un ListData con 40 opciones disponibles de años
	 * @return listData fechas desde Date("Y",time()) hasta (Date("Y",time()) - 40)
	 * 
	 **/
	public static function getAnioVehiculo()
	{
		$model = array();

		for ($i = Date("Y",time()); $i > (Date("Y",time()) - 40); $i--) { 
			$model[] = array('anio' => $i);
		}

		return CHtml::listData($model, 'anio', 'anio');
	}

	/**
	 * getNumeroControl()
	 * Se encarga de arrojar una lista de Números de Control
	 * desplegados en un comboBox.
	 * @return listData lista para mostrar en un comboBox
	 */
	public static function getNumeroControl() 
	{ 
		$model = self::model()->findAll(array('order'=>'veh_num_con ASC'));

		// Retornamos el listData
		return CHtml::listData($model, 'id', 'veh_num_con');
	}

	/**
	 * afterFind()
	 *
	 * Ejecuta esta función después de extraer los datos del modelo y los transforma
	 *
	 * @return parent::afterFind() Llama a su clase padre para invocar esa función.
	 */
	protected function afterFind() 
	{

		$this->veh_seg_fec_ven1 = date('d-m-Y',strtotime($this->veh_seg_fec_ven1));
		$this->veh_seg_fec_ven2 = date('d-m-Y',strtotime($this->veh_seg_fec_ven2));
		$this->veh_seg_fec_ven3 = date('d-m-Y',strtotime($this->veh_seg_fec_ven3));
		
		return parent::afterFind();
	}

	/**
	 * beforeSave()
	 *
	 * Ejecuta esta función antes de guardar los datos en la base de datos
	 *
	 * @return parent::beforeSave() Llama a su clase padre para invocar esa función.
	 */
	public function beforeSave() 
	{	
		$this->veh_seg_fec_ven1 = date('Y-m-d',strtotime($this->veh_seg_fec_ven1));
		$this->veh_seg_fec_ven2 = date('Y-m-d',strtotime($this->veh_seg_fec_ven2));
		$this->veh_seg_fec_ven3 = date('Y-m-d',strtotime($this->veh_seg_fec_ven3));

		if (strlen($this->veh_num_con) == 1) {
			$this->veh_num_con = "0".$this->veh_num_con;
		}

		return parent::beforeSave();
	}

	public static function getListaDocVencidos()
	{
		$model = array(
			array('valor' => 'SegVenVencidos', 'label' => 'Seguros Venezolanos Vencidos'),
			array('valor' => 'SegCol1Vencidos', 'label' => 'Seguros Colombianos Vencidos 1'),
			array('valor' => 'SegCol2Vencidos', 'label' => 'Seguros Colombianos Vencidos 2'),
		);

		return CHtml::listData($model, 'valor', 'label');
	}


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Vehiculo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
