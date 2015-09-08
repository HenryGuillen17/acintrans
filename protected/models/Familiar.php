<?php

/**
 * This is the model class for table "actr_familiares".
 *
 * The followings are the available columns in table 'actr_familiares':
 * @property string $id_persona1
 * @property string $id_persona2
 * @property string $fam_par
 *
 * The followings are the available model relations:
 * @property Personas $idPersona1
 * @property Personas $idPersona2
 */
class Familiar extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'actr_familiares';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_persona1, id_persona2, fam_par', 'required'),
			array('id_persona1, id_persona2', 'length', 'max'=>10),
			array('fam_par', 'length', 'max'=>30),
			array('id_persona1', 'unique'),
			array('id_persona2', 'compare', 'compareAttribute'=>'id_persona1', 'operator'=>'!=', 
				'message'=>'No se puede colocar la misma persona como familiar'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_persona1, id_persona2, fam_par', 'safe', 'on'=>'search'),
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
			'idPersona1' => array(self::BELONGS_TO, 'Persona', 'id_persona1'),
			'idPersona2' => array(self::BELONGS_TO, 'Persona', 'id_persona2'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_persona1' => 'Id Persona1',
			'id_persona2' => 'Familiar Inmediato',
			'fam_par' => 'Parentesco',
		);
	}

	/**
	 * getListaFamiliares
	 * 
	 * Retorna un ListData con Todos los lazos familiares posibles
	 * @return listData array con lazos familiares
	 * 
	 **/
	public static function getListaFamiliares()
	{

		$model = array(
			array('nexo' => 'Padre'),
			array('nexo' => 'Madre'),
			array('nexo' => 'Hermano'),
			array('nexo' => 'Tio'),
			array('nexo' => 'Esposo(a)'),
			array('nexo' => 'Hijo(a)'),
		);

		return CHtml::listData($model, 'nexo', 'nexo');
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

		$criteria->compare('id_persona1',$this->id_persona1,true);
		$criteria->compare('id_persona2',$this->id_persona2,true);
		$criteria->compare('fam_par',$this->fam_par,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Familiar the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}