<?php
/**
 * This is the model class for table "actr_mensualidad_pagos".
 *
 * The followings are the available columns in table 'actr_mensualidad_pagos':
 * @property string $id_pago
 * @property string $men_pag_mes_can
 *
 * The followings are the available model relations:
 * @property Pagos $idPago
 */
class MensualidadPago extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'actr_mensualidad_pagos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, id_pago, men_pag_mes_can, men_pag_mon', 'required'),
			array('id, id_pago', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_pago, men_pag_mes_can, men_pag_mon', 'safe', 'on'=>'search'),
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
			'id' 				=> 'ID Mensualidad',
			'id_pago' 			=> 'Id Pago',
			'men_pag_mes_can' 	=> 'Mes Cancelado',
			'men_pag_mon' 		=> 'Monto Cancelado',
		);
	}

	/**
	 * getCodigo()
	 * Se encarga de generar el código para la base de datos
	 * En este caso lo generará para cualquier MensualidadPago.
	 *
	 */
	public function getCodigo()
	{
		$rs = self::model()->findBySql("SELECT id FROM actr_mensualidad_pagos ORDER BY id DESC");

		if ($rs == null) {
			$this->id = "MNP";
		} else {
			$this->id = $rs->id;
		}

		$this->id = Yii::app()->CalculoID->getCalculoId($this->id, false);
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

		$criteria->with = array('idPago', 'idPago.idConductor', 'idPago.idConductor.idPersona', 
			'idPago.idConductor.idVehiculo', 'idPago.listin');

		$criteria->compare('id',$this->id,true);
		$criteria->compare('id_pago',$this->id_pago,true);
		$criteria->compare('men_pag_mes_can',$this->men_pag_mes_can,true);
		$criteria->compare('men_pag_mon',$this->men_pag_mon,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * getValidarIntervaloFecha
	 * 
	 * Se encarga de validar que la <em>fechaInicio</em> y <em>fechaFin</em> sea correctas.
	 * @param String fechaInicio Es la fecha de inicio del intérvalo el cual 
	 * se va a evaluar. (Se pasa por referencia para modificar).
	 * @param String fechaFin Es la fecha final del intérvalo el cual se va a
	 * evaluar. (Se pasa por referencia para modificar).
	 * @param String fechaIng Fecha de ingreso a la asociación del conductor.
	 * @return boolean true En caso de  estar todo correcto.
	 * 
	 * */
	public static function getValidarIntervaloFecha(&$fechaInicio, &$fechaFin, $fechaIngCond)
	{
		
		/* 	Valida si fecha de inicio es menor a la fecha que el conductor se 
			asoció, se cambie por la misma. Si es '0000-00-00', se cambia por 
			la fecha de ingreso del conductor.
		*/
		if ($fechaInicio == '0000-00-00') {
            $fechaInicio = $fechaIngCond;
        } else {
            $f = Yii::app()->FuncionesImportantes->getDistanciaFecha($fechaInicio, $fechaIngCond, "d");
            if ($f > 0)
                $fechaInicio = $fechaIngCond;
        }
        /* 	Si la <em>fechaFin</em> es más de dos meses mayor que la fecha actual más dos meses,
        	se cambie por la fecha de hoy más dos meses más.
        */
        $f = Yii::app()->FuncionesImportantes->getDistanciaFecha(
            date('d-m-Y'), $fechaFin, "m");
        if ($f > 2)
            $fechaFin = date('d-m-Y', strtotime(date('Y-m-d') . '+2 month'));
        /* 	Si la <em>fechaFin</em> es menor a la <em>fechaInicio</em>, se retornará falso para
        	detener la ejecución de las instrucciones.
        */
        $f = Yii::app()->FuncionesImportantes->getDistanciaFecha($fechaInicio, $fechaFin, "d");
        if ($f < 0)
            return false;

        // Retornará verdadero cuando todo esté correcto
        return true;
	}

	/**
	 * getMesesPagados
	 * 
	 * Lista de Meses Pagados por cada ID de Pago
	 * @return Objeto $model Objeto <em>MensualidadPago</em> con todos los
	 * meses.
	 * 
	 * */
	public static function getMesesPagados($idPago)
	{
		$model = self::model()->findAllByAttributes(
			array('id_pago' => $idPago)
		);

		return $model;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MensualidadPago the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
