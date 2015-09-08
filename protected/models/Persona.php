<?php

/**
 * This is the model class for table "actr_personas".
 *
 * The followings are the available columns in table 'actr_personas':
 * @property string $id
 * @property string $per_nom
 * @property string $per_ape
 * @property string $per_dir
 * @property string $per_tel1
 * @property string $per_tel2
 * @property string $per_ced
 *
 * The followings are the available model relations:
 * @property Conductores[] $conductores
 * @property Familiares[] $familiares
 * @property Familiares[] $familiares1
 * @property Usuarios[] $usuarioses
 */
class Persona extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'actr_personas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, per_nom, per_ape, per_dir, per_tel1, per_tel2, per_ced', 'required'),
			array('id', 'length', 'max'=>10),
			array('per_nom, per_ape', 'length', 'min'=>3, 'max'=>40),
			array('per_tel1, per_tel2, per_ced', 'length', 'min'=>3, 'max'=>20),
			array('per_ced', 'unique'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, per_nom, per_ape, per_dir, per_tel1, per_tel2, per_ced', 'safe', 'on'=>'search'),
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
			'conductores' => array(self::HAS_MANY, 'Conductores', 'id_persona'),
			'familiares' => array(self::HAS_MANY, 'Familiares', 'id_persona1'),
			'familiares1' => array(self::HAS_MANY, 'Familiares', 'id_persona2'),
			'usuarios' => array(self::HAS_MANY, 'Usuarios', 'id_persona'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'per_nom' => 'Nombres',
			'per_ape' => 'Apellidos',
			'per_dir' => 'Dirección',
			'per_tel1' => 'Teléfono Celular',
			'per_tel2' => 'Teléfono Residencial',
			'per_ced' => 'Cédula',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('per_nom',$this->per_nom,true);
		$criteria->compare('per_ape',$this->per_ape,true);
		$criteria->compare('per_dir',$this->per_dir,true);
		$criteria->compare('per_tel1',$this->per_tel1,true);
		$criteria->compare('per_tel2',$this->per_tel2,true);
		$criteria->compare('per_ced',$this->per_ced,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * getCodigo()
	 * Se encarga de generar el código para la base de datos
	 * En este caso lo generará para la Persona.
	 *
	 */
	public function getCodigo()
	{
		$rs = self::model()->findBySql("SELECT id FROM actr_personas ORDER BY id DESC");
		
		if ($rs == null) {
			$this->id = "PER";
		} else {
			$this->id = $rs->id;
		}

		$this->id = Yii::app()->CalculoID->getCalculoId($this->id, false);
	}

	/**
	 * toList()
	 * Se encarga de arrojar una lista de nombre de personas para ser
	 * desplegados en un comboBox.
	 * @return listData lista para mostrar en un comboBox
	 */
	public static function toList()
	{
		$model = self::model()->findAll();
		return CHtml::listData($model, 'id', 'per_nom');
	}

	/**
	 * toList()
	 * Se encarga de arrojar una lista de nombre de personas para ser
	 * desplegados en un comboBox.
	 * @return listData lista para mostrar en un comboBox
	 */
	public static function getListaPersonas()
	{
		$model = self::model()->findAll();
		return CHtml::listData($model, 'id', 'per_nom');
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Persona the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
