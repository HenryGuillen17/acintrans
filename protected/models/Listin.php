<?php

/**
 * This is the model class for table "actr_listines".
 *
 * The followings are the available columns in table 'actr_listines':
 * @property string $id_pago
 * @property integer $lis_num1
 * @property integer $lis_num2
 * @property integer $lis_num3
 * @property integer $lis_num4
 * @property integer $lis_num5
 * @property integer $lis_num6
 *
 * The followings are the available model relations:
 * @property Pagos $idPago
 */
class Listin extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'actr_listines';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_pago, lis_num1, lis_num2, lis_num3, lis_num4, lis_num5, lis_num6', 'required'),
			array('lis_num1, lis_num2, lis_num3, lis_num4, lis_num5, lis_num6', 'numerical', 'integerOnly'=>true),
			array('lis_num1, lis_num2, lis_num3, lis_num4, lis_num5, lis_num6', 'length', 'max'=>10),
			array('id_pago', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_pago, lis_num1, lis_num2, lis_num3, lis_num4, lis_num5, lis_num6', 'safe', 'on'=>'search'),
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
			'idPago' => array(self::BELONGS_TO, 'Pago', 'id_pago'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_pago' => 'Id Pago',
			'lis_num1' => 'Listin #1',
			'lis_num2' => 'Listin #2',
			'lis_num3' => 'Listin #3',
			'lis_num4' => 'Listin #4',
			'lis_num5' => 'Listin #5',
			'lis_num6' => 'Listin #6',
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

		$criteria->compare('id_pago',$this->id_pago,true);
		$criteria->compare('lis_num1',$this->lis_num1);
		$criteria->compare('lis_num2',$this->lis_num2);
		$criteria->compare('lis_num3',$this->lis_num3);
		$criteria->compare('lis_num4',$this->lis_num4);
		$criteria->compare('lis_num5',$this->lis_num5);
		$criteria->compare('lis_num6',$this->lis_num6);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
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
		$this->lis_num1 = str_pad($this->lis_num1, 10, "0", STR_PAD_LEFT);
		$this->lis_num2 = str_pad($this->lis_num2, 10, "0", STR_PAD_LEFT);
		$this->lis_num3 = str_pad($this->lis_num3, 10, "0", STR_PAD_LEFT);
		$this->lis_num4 = str_pad($this->lis_num4, 10, "0", STR_PAD_LEFT);
		$this->lis_num5 = str_pad($this->lis_num5, 10, "0", STR_PAD_LEFT);
		$this->lis_num6 = str_pad($this->lis_num6, 10, "0", STR_PAD_LEFT);
		$this->lis_num7 = str_pad($this->lis_num7, 10, "0", STR_PAD_LEFT);

		return parent::beforeSave();
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Listin the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
