<?php

/**
 * This is the model class for table "actr_conductores".
 *
 * The followings are the available columns in table 'actr_conductores':
 * @property string $id
 * @property string $con_fec_ing
 * @property string $con_tip_con
 * @property string $con_nac
 * @property string $con_fec_ven_ced
 * @property string $con_rif
 * @property string $con_fec_ven_rif
 * @property string $con_gra_lic
 * @property string $con_fec_ven_lic
 * @property string $con_cer_med
 * @property string $con_fec_cer_med
 * @property string $con_fot
 * @property string $id_vehiculo
 * @property string $id_persona
 *
 * The followings are the available model relations:
 * @property Personas $idPersona
 * @property Vehiculos $idVehiculo
 * @property Pagos[] $pagos
 */
class Conductor extends CActiveRecord
{
	public $veh_num_con;
	public $per_nom;
	public $per_ape;
	public $per_ced;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'actr_conductores';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, con_fec_ing, con_tip_con, con_nac, con_fec_ven_ced, 
				con_rif, con_fec_ven_rif, con_gra_lic, con_fec_ven_lic, con_cer_med, 
				con_fec_cer_med, id_persona, id_vehiculo', 'required'),
			array('id, id_vehiculo, id_persona', 'length', 'max'=>10),
			array('con_tip_con, con_nac, con_gra_lic', 'length', 'max'=>1),
			array('con_rif, con_cer_med', 'length', 'max'=>20),
			array('con_rif', 'unique'),
			array('id_persona', 'unique'),
			array('con_fot', 'file', 'types'=>'jpg, gif, png', 'maxSize'=>1024*1024*3, 
				'tooLarge'=>'El archivo no puede exceder los 3MB.', 'allowEmpty'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('con_fec_ing, con_tip_con, con_nac, con_fec_ven_ced, 
				con_rif, con_fec_ven_rif, con_gra_lic, con_fec_ven_lic, con_cer_med, 
				con_fec_cer_med, id_vehiculo, id_persona, veh_num_con, 
				per_nom, per_ape, per_ced', 'safe', 'on'=>'search'),
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
			'idPersona' => array(self::BELONGS_TO, 'Persona', 'id_persona'),
			'idVehiculo' => array(self::BELONGS_TO, 'Vehiculo', 'id_vehiculo'),
			'pagos' => array(self::HAS_MANY, 'Pagos', 'id_conductor'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' 			     => 'ID',
			'con_fec_ing'        => 'Fecha Ingreso',
			'con_tip_con'        => 'Tipo de Conductor',
			'con_nac'            => 'Nacionalidad',
			'con_fec_ven_ced'    => 'F/V Cédula',
			'con_rif'            => 'R.I.F.',
			'con_fec_ven_rif'    => 'F/V RIF',
			'con_gra_lic'        => 'Grado Licencia',
			'con_fec_ven_lic'    => 'F/V Licencia',
			'con_cer_med'        => 'Cert. Médico',
			'con_fec_cer_med'    => 'F/V Cert. Médico',
			'con_fot'            => 'Fotografía',
			'id_vehiculo'        => 'Número de Control',
			'id_persona'         => 'Nombre del Conductor',
			'veh_num_con'        => 'Núm. Control',
			'per_nom'            => 'Nombres',
			'per_ape'            => 'Apellidos',
			'per_ced'            => 'Cédula',
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
		$criteria->with = array('idVehiculo', 'idPersona');

		//$criteria->compare('id',$this->id,true);
		$criteria->compare('con_fec_ing',$this->con_fec_ing,true);
		$criteria->compare('con_tip_con',$this->con_tip_con,true);
		$criteria->compare('con_nac',$this->con_nac,true);
		$criteria->compare('con_fec_ven_ced',$this->con_fec_ven_ced,true);
		$criteria->compare('con_rif',$this->con_rif,true);
		$criteria->compare('con_fec_ven_rif',$this->con_fec_ven_rif,true);
		$criteria->compare('con_gra_lic',$this->con_gra_lic,true);
		$criteria->compare('con_fec_ven_lic',$this->con_fec_ven_lic,true);
		$criteria->compare('con_cer_med',$this->con_cer_med,true);
		$criteria->compare('con_fec_cer_med',$this->con_fec_cer_med,true);
		$criteria->compare('con_fot',$this->con_fot,false);
		// Búsqueda de datos compartidos
		$criteria->compare('veh_num_con',$this->veh_num_con, true);
		$criteria->compare('per_nom',$this->per_nom, true);
		$criteria->compare('per_ape',$this->per_ape, true);
		$criteria->compare('per_ced',$this->per_ced, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
	          'attributes'=>array(
	            'veh_num_con'=>array(
	                 'asc'=>'idVehiculo.veh_num_con ASC',
	                 'desc'=>'idVehiculo.veh_num_con DESC',
	            ),
	            'per_nom'=>array(
	                 'asc'=>'idPersona.per_nom ASC',
	                 'desc'=>'idPersona.per_nom DESC',
	            ),
	            'per_ape'=>array(
	                 'asc'=>'idPersona.per_ape ASC',
	                 'desc'=>'idPersona.per_ape DESC',
	            ),
	            'per_ced'=>array(
	                 'asc'=>'idPersona.per_ced ASC',
	                 'desc'=>'idPersona.per_ced DESC',
	            ),
	             '*',
	        	),
	        	'defaultOrder'=>'idVehiculo.veh_num_con ASC',
	     	),
	   ));
	}

	/**
	 *
	 * busqTipoConductor
	 * 
	 *     Se encarga de añadir una condición para buscar un
	 * tipo de conductor (0= Asociado, 1= Avance), utilizando
	 * el objeto <em>CActiveDataProvider</em> y editando su
	 * objeto <em>CDbCriteria</em> para añadirle la condición.
	 *     Cabe destacar que se utiliza el método <em>search()
	 * </em> de este controlador para obtener el objeto 
	 * <em>CActiveDataProvider</em> 
	 * 
	 * @param Char tipoConductor Se encarga de decidir qué tipo
	 * de conductor va a exportar.
	 * 
	 * @return CActiveDataProvider r es el objeto la cual se va
	 * a desplegar en la vista.
	 * 
	 **/
	public static function busqTipoConductor($tipoConductor)
	{
		$r = new Conductor();
		$r = $r->search();
		$criteria = $r->getCriteria();
		$criteria->compare('con_tip_con', $tipoConductor,true);
		$r->setCriteria($criteria);

		return $r;
	}

	/**
	 *
	 * getDocVencidos
	 * 
	 *     Se encarga de añadir una condición para buscar un
	 * un documento vencido de los conductores, utilizando
	 * el objeto <em>CActiveDataProvider</em> y editando su
	 * objeto <em>CDbCriteria</em> para añadirle la condición.
	 *     Cabe destacar que se utiliza el método <em>search()
	 * </em> de este controlador para obtener el objeto 
	 * <em>CActiveDataProvider</em> 
	 * 
	 * @param String documento Se encarga de decidir qué tipo
	 * de documento vencido va a exportar.
	 * 
	 * @return CActiveDataProvider r es el objeto la cual se va
	 * a desplegar en la vista.
	 * 
	 **/
	public static function getDocVencidos($documento)
	{
		$r = new Conductor();
		$fechaLimite = date('Y-m', strtotime(date('Y-m') . '+ 1 month')) . "-01";
		$r = $r->search();
		$criteria = $r->getCriteria();
		$criteria->condition = $documento . "<:fechaLimite" ;
		$criteria->params = array(':fechaLimite' => $fechaLimite);
		$r->setCriteria($criteria);

		return $r;
	}


	/**
	 * getCodigo()
	 * Se encarga de generar el código para la base de datos
	 * En este caso lo generará para el Conductor.
	 *
	 */
	public function getCodigo()
	{
		$rs = self::model()->findBySql("SELECT id FROM actr_conductores ORDER BY id DESC");
		
		if ($rs == null) {
			$this->id = "CON";
		} else {
			$this->id = $rs->id;
		}

		$this->id = Yii::app()->CalculoID->getCalculoId($this->id, false);
	}

	/**
	 * getListaPersonasNoConductor()
	 * Se encarga de arrojar una lista de personas que no sean conductores para ser
	 * desplegados en un comboBox.
	 * @return listData lista para mostrar en un comboBox
	 */
	public static function getListaPersonasNoConductor()
	{
		// Hacemos un join para recuperar datos de las personas que no están en los usuarios
		$model = Yii::app()->db->createCommand()
				->select(array('actr_personas.id', 'actr_personas.per_nom'))
				->from('actr_personas')
				->leftJoin('actr_conductores', 'actr_personas.id = actr_conductores.id_persona')
				->where('actr_conductores.id_persona IS NULL')
				->queryAll();

		// Retornamos el listData
		return CHtml::listData($model, 'id', 'per_nom');
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
		$this->con_fec_ing 		= date('d-m-Y',strtotime($this->con_fec_ing));
		$this->con_fec_ven_ced  = date('d-m-Y',strtotime($this->con_fec_ven_ced));
		$this->con_fec_ven_rif  = date('d-m-Y',strtotime($this->con_fec_ven_rif));
		$this->con_fec_ven_lic  = date('d-m-Y',strtotime($this->con_fec_ven_lic));
		$this->con_fec_cer_med  = date('d-m-Y',strtotime($this->con_fec_cer_med));
		
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
		$this->con_fec_ing 		= date('Y-m-d',strtotime($this->con_fec_ing));
		$this->con_fec_ven_ced 	= date('Y-m-d',strtotime($this->con_fec_ven_ced));
		$this->con_fec_ven_rif  = date('Y-m-d',strtotime($this->con_fec_ven_rif));
		$this->con_fec_ven_lic  = date('Y-m-d',strtotime($this->con_fec_ven_lic));
		$this->con_fec_cer_med  = date('Y-m-d',strtotime($this->con_fec_cer_med));

		return parent::beforeSave();
	}

	/**
	 * tipoConductor()
	 *
	 * Lista una serie disponible de tipos de conductores para manejo de campo en formulario.
	 *
	 * @return listData lista para mostrar en un comboBox
	 */
	public static function tipoConductor()
	{
		$model = array(
			array('id' => '0', 'value' => 'Asociado'),
			array('id' => '1', 'value' => 'Avance'),
		);
		return CHtml::listData($model, 'id', 'value');
	}

	/**
	 * tipoConductor()
	 *
	 * Lista nacionalidad posible de conductores.
	 *
	 * @return listData lista para mostrar en un comboBox
	 */
	public static function nacionalidad()
	{
		$model = array(
			array('id' => 'V', 'value' => 'Venezolano'),
			array('id' => 'E', 'value' => 'Extranjero'),
		);
		return CHtml::listData($model, 'id', 'value');
	}

	/**
	 * gradoLicencia()
	 *
	 * Grado de licencia del conductor
	 *
	 * @return listData lista para mostrar en un comboBox
	 */
	public static function gradoLicencia()
	{
		$model = array(
			array('id' => '3', 'value' => '3er Grado'),
			array('id' => '4', 'value' => '4to Grado'),
			array('id' => '5', 'value' => '5to Grado'),
		);
		return CHtml::listData($model, 'id', 'value');
	}

	/**
	 * getListaPersonasSinConductor()
	 *
	 * Se encarga de arrojar una lista de personas que no tengan conductores para ser
	 * desplegados en un comboBox.
	 *
	 * @return listData lista para mostrar en un comboBox
	 */
	public static function getListaPersonasSinConductor()
	{
		// Hacemos un join para recuperar datos de las personas que no están en los usuarios
		$model = Yii::app()->db->createCommand()
				->select(array('actr_personas.id', 'actr_personas.per_nom', 'actr_personas.per_ape'))
				->from('actr_personas')
				->leftJoin('actr_conductores', 'actr_personas.id = actr_conductores.id_persona')
				->where('actr_conductores.id_persona IS NULL')
				->queryAll();

		// Retornamos el listData
		return CHtml::listData($model, 'id', 'per_nom');
	}

	/**
	 * getConductoresConVehiculo
	 * Retorna una lista de conductores con su numero de control y 
	 * Nombres con Apellidos completos, pero si son Asociados o Avances.
	 * Se cancela a partir del mes que de una entra (en la consulta con la fecha de ingreso)
	 * @param Integer $tipo Si es Asociado o Avance
	 * @return Array $model matriz con la lista de los conductores.
	 * 
	 **/
	public static function getConductoresConVehiculo($tipo, $fecha)
	{
		$model = Yii::app()->db->createCommand()
				->select(array('veh_num_con', 'per_nom', 'per_ape'))
				->from(array('actr_conductores', 'actr_vehiculos', 'actr_personas'))
				->where("actr_personas.id = actr_conductores.id_persona
                    AND actr_vehiculos.id = actr_conductores.id_vehiculo
                    AND DATE_FORMAT(con_fec_ing, '%Y-%m') <=:fecha 
                    AND actr_conductores.con_tip_con =:tipo", 
                    array(
                    	':tipo' 	=> $tipo,
                    	':fecha'	=> $fecha
                    ))
				->order('per_nom ASC')
				->queryAll();

		return $model;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Conductor the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
