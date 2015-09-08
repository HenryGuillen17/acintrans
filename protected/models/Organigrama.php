<?php

/**
 * This is the model class for table "actr_organigramas".
 *
 * The followings are the available columns in table 'actr_organigramas':
 * @property string $id
 * @property string $org_ano_elecc
 * @property string $org_pre
 * @property string $org_vpr
 * @property string $org_sec
 * @property string $org_tes
 * @property string $org_td1
 * @property string $org_td2
 * @property string $org_td3
 * @property string $org_rf1
 * @property string $org_rf2
 *
 * The followings are the available model relations:
 * @property Personas $orgPre
 * @property Personas $orgVpr
 * @property Personas $orgSec
 * @property Personas $orgTes
 * @property Personas $orgTd1
 * @property Personas $orgTd2
 * @property Personas $orgTd3
 * @property Personas $orgRf1
 */
class Organigrama extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'actr_organigramas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, org_ano_elecc, org_pre', 'required'),
			array('id, org_pre, org_vpr, org_sec, org_tes, org_td1, org_td2, org_td3, org_rf1, org_rf2', 'length', 'max'=>10),
			array('org_ano_elecc', 'length', 'max'=>4),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, org_ano_elecc, org_pre, org_vpr, org_sec, org_tes, org_td1, org_td2, org_td3, org_rf1, org_rf2', 'safe', 'on'=>'search'),
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
			'orgPre' => array(self::BELONGS_TO, 'Persona', 'org_pre'),
			'orgVpr' => array(self::BELONGS_TO, 'Persona', 'org_vpr'),
			'orgSec' => array(self::BELONGS_TO, 'Persona', 'org_sec'),
			'orgTes' => array(self::BELONGS_TO, 'Persona', 'org_tes'),
			'orgTd1' => array(self::BELONGS_TO, 'Persona', 'org_td1'),
			'orgTd2' => array(self::BELONGS_TO, 'Persona', 'org_td2'),
			'orgTd3' => array(self::BELONGS_TO, 'Persona', 'org_td3'),
			'orgRf1' => array(self::BELONGS_TO, 'Persona', 'org_rf1'),
			'orgRf2' => array(self::BELONGS_TO, 'Persona', 'org_rf2'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'identificador del organigrama',
			'org_ano_elecc' => 'Año de la eleccion',
			'org_pre' => 'Presidente',
			'org_vpr' => 'Vice-Presidente',
			'org_sec' => 'Secretario',
			'org_tes' => 'Tesorero',
			'org_td1' => 'Disciplinario 1',
			'org_td2' => 'Disciplinario 2',
			'org_td3' => 'Disciplinario 3',
			'org_rf1' => 'Revisor Fiscal 1',
			'org_rf2' => 'Revisor Fiscal 2',
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
		$criteria->with = array(
			'orgPre',
			'orgVpr',
			'orgSec',
			'orgTes',
			'orgTd1',
			'orgTd2',
			'orgTd3',
			'orgRf1',
			'orgRf2',
		);


		$criteria->compare('id',$this->id,true);
		$criteria->compare('org_ano_elecc',$this->org_ano_elecc,true);
		$criteria->compare('org_pre',$this->org_pre,true);
		$criteria->compare('org_vpr',$this->org_vpr,true);
		$criteria->compare('org_sec',$this->org_sec,true);
		$criteria->compare('org_tes',$this->org_tes,true);
		$criteria->compare('org_td1',$this->org_td1,true);
		$criteria->compare('org_td2',$this->org_td2,true);
		$criteria->compare('org_td3',$this->org_td3,true);
		$criteria->compare('org_rf1',$this->org_rf1,true);
		$criteria->compare('org_rf2',$this->org_rf2,true);

		$criteria->compare('orgPre.per_nom',$this->orgPre->per_nom,true);
		$criteria->compare('orgVpr.per_nom',$this->orgVpr->per_nom,true);
		$criteria->compare('orgSec.per_nom',$this->orgSec->per_nom,true);
		$criteria->compare('orgTes.per_nom',$this->orgTes->per_nom,true);
		$criteria->compare('orgTd1.per_nom',$this->orgTd1->per_nom,true);
		$criteria->compare('orgTd2.per_nom',$this->orgTd2->per_nom,true);
		$criteria->compare('orgTd3.per_nom',$this->orgTd3->per_nom,true);
		$criteria->compare('orgRf1.per_nom',$this->orgRf1->per_nom,true);
		$criteria->compare('orgRf2.per_nom',$this->orgRf2->per_nom,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
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
		$rs = self::model()->findBySql("SELECT id FROM actr_organigramas ORDER BY id DESC");
		
		if ($rs == null) {
			$this->id = "ORG";
		} else {
			$this->id = $rs->id;
		}

		$this->id = Yii::app()->CalculoID->getCalculoId($this->id, false);
	}


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Organigrama the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
