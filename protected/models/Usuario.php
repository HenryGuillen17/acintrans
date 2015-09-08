<?php

/**
 * This is the model class for table "actr_usuarios".
 *
 * The followings are the available columns in table 'actr_usuarios':
 * @property string $id
 * @property string $id_persona
 * @property string $usu_nom
 * @property string $usu_cla
 *
 * The followings are the available model relations:
 * @property Personas $idPersona
 */
class Usuario extends CActiveRecord
{
	
	public $usu_cla2;
	public $per_nom;
	public $per_ape;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'actr_usuarios';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, id_persona, usu_nom, usu_cla, usu_cla2', 'required', 'on' => 'create'),
			array('id, id_persona, usu_nom', 'required', 'on' => 'update'),
			array('id, id_persona', 'length', 'max'=>10),
			array('usu_nom', 'length', 'min' => 5, 'max'=>20),
			array('usu_cla, usu_cla2', 'length', 'min' => 5, 'max'=>255),
			array('id_persona', 'unique'),
			array('usu_nom', 'unique'),
			array('usu_cla2', 'compare', 'compareAttribute'=>'usu_cla', 'on'=>'create'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_persona, usu_nom, usu_cla, per_nom, per_ape', 'safe', 'on'=>'search'),
		);
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' 			=> 'ID',
			'id_persona' 	=> 'Id Persona',
			'usu_nom' 		=> 'Nombre Usuario',
			'usu_cla' 		=> 'Contraseña',
			'usu_cla2' 		=> 'Repita Contraseña',
			'per_nom'       => 'Nombres',
			'per_ape'       => 'Apellidos',
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

		$criteria->with = array('idPersona');

		$criteria->compare('id',$this->id,true);
		$criteria->compare('id_persona',$this->id_persona,true);
		$criteria->compare('usu_nom',$this->usu_nom,true);
		$criteria->compare('usu_cla',$this->usu_cla,true);

		$criteria->compare('per_nom',$this->per_nom, true);
		$criteria->compare('per_ape',$this->per_ape, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
	          'attributes'=>array(
	            'per_nom'=>array(
	                 'asc'=>'idPersona.per_nom ASC',
	                 'desc'=>'idPersona.per_nom DESC',
	            ),
	            'per_ape'=>array(
	                 'asc'=>'idPersona.per_ape ASC',
	                 'desc'=>'idPersona.per_ape DESC',
	            ),
	             '*',
	        	),
	        	'defaultOrder'=>'t.id, idPersona.per_nom ASC',
	     	),
		));
	}

	/**
	 * getCodigo()
	 * Se encarga de generar el código para la base de datos
	 * En este caso lo generará para el Usuario.
	 *
	 */
	public function getCodigo()
	{
		$rs = self::model()->findBySql("SELECT id FROM actr_usuarios ORDER BY id DESC");
		
		if ($rs == null) {
			$this->id = "USU";
		} else {
			$this->id = $rs->id;
		}

		$this->id = Yii::app()->CalculoID->getCalculoId($this->id, false);
	}

	/**
	 * toList()
	 * Se encarga de arrojar una lista de nombre de usuarios para ser
	 * desplegados en un comboBox.
	 * @return listData lista para mostrar en un comboBox
	 */
	public static function toList()
	{
		$model = self::model()->findAll();
		return CHtml::listData($model, 'id', 'usu_nom');
	}

	/**
	 * getListaPersonasSinUsuario()
	 * Se encarga de arrojar una lista de personas que no tengan usuarios para ser
	 * desplegados en un comboBox.
	 * @return listData lista para mostrar en un comboBox
	 */
	public static function getListaPersonasSinUsuario()
	{
		// Hacemos un join para recuperar datos de las personas que no están en los usuarios
		$model = Yii::app()->db->createCommand()
				->select(array('actr_personas.id', 'actr_personas.per_nom'))
				->from('actr_personas')
				->leftJoin('actr_usuarios', 'actr_personas.id = actr_usuarios.id_persona')
				->where('actr_usuarios.id_persona IS NULL')
				->queryAll();

		// Retornamos el listData
		return CHtml::listData($model, 'id', 'per_nom');
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Usuario the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
