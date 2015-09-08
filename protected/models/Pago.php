<?php

/**
 * This is the model class for table "actr_pagos".
 *
 * The followings are the available columns in table 'actr_pagos':
 * @property string $id
 * @property string $id_conductor
 * @property string $pag_con
 * @property string $pag_tip
 * @property double $pag_mon
 * @property string $pag_ban
 * @property string $pag_fec_ing
 * @property string $pag_anu
 *
 * The followings are the available model relations:
 * @property Listines $listines
 * @property MensualidadPagos[] $mensualidadPagoses
 * @property Conductores $idConductor
 */
class Pago extends CActiveRecord
{
	
	public $veh_num_con;
	public $id_vehiculo;
	public $per_nom;
	public $pag_men_pagos;
	public $pag_listin;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'actr_pagos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, id_conductor, pag_con, pag_tip, pag_mon, pag_fec_ing, pag_anu', 'required'),
			array('pag_mon', 'numerical'),
			array('id, id_conductor', 'length', 'max'=>10),
			array('pag_con, pag_tip, pag_anu', 'length', 'max'=>1),
			array('pag_ban', 'length', 'max'=>250),
			array('veh_num_con', 'length', 'max'=>3),
			//array('pag_men_pagos', 'validarMeses');
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_conductor, pag_con, pag_tip, pag_mon, pag_fec_ing, 
				pag_anu, veh_num_con, per_nom', 'safe', 'on'=>'search'),
		);
	}

	public static function validarMeses($attribute, $params)
	{
		if (!$this->$attribute && $this->pag_con == "M") {
			$this->addError($attribute, 'Seleccione al Menos un Mes Deudor');
		}
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'listin' => array(self::HAS_ONE, 'Listin', 'id_pago'),
			'mensualidadPago' => array(self::HAS_MANY, 'MensualidadPago', 'id_pago'),
			'idConductor' => array(self::BELONGS_TO, 'Conductor', 'id_conductor'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' 			=> 'ID Pago',
			'id_conductor' 	=> 'Nombre Conductor',
			'id_vehiculo'	=> 'Número de Control',
			'pag_con' 		=> 'Descripción',
			'pag_tip' 		=> 'Tipo de Pago',
			'pag_mon' 		=> 'Cantidad',
			'pag_ban' 		=> 'Banco Receptor',
			'pag_fec_ing' 	=> 'Fecha de Pago',
			'pag_anu' 		=> 'Estado',
			'veh_num_con' 	=> 'Núm. Control',
			'per_nom' 		=> 'Nombres',
			'pag_men_pagos' => 'Meses Pagados',
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
		$criteria->with = array('idConductor', 'idConductor.idPersona', 
			'idConductor.idVehiculo', 'listin', 'mensualidadPago');

		//$criteria->compare('id',$this->id,true);
		$criteria->compare('id_conductor',$this->id_conductor,true);
		$criteria->compare('pag_con',$this->pag_con,true);
		$criteria->compare('pag_tip',$this->pag_tip,true);
		$criteria->compare('pag_mon',$this->pag_mon);
		$criteria->compare('pag_ban',$this->pag_ban,true);
		$criteria->compare('pag_fec_ing',$this->pag_fec_ing,true);
		$criteria->compare('pag_anu',$this->pag_anu,true);

		$criteria->compare('idVehiculo.veh_num_con',$this->veh_num_con,true);
		$criteria->compare('idPersona.per_nom',$this->per_nom,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			///*
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
	             '*',
	        	),
	        	'defaultOrder'=>'t.id DESC',
	     	),
	     	//*/
		));
	}

	/**
	 * getCodigo()
	 * Se encarga de generar el código para la base de datos
	 * En este caso lo generará para cualquier Pago.
	 *
	 */
	public function getCodigo()
	{
		$rs = self::model()->findBySql("SELECT id FROM actr_pagos ORDER BY id DESC");
		
		if ($rs == null) {
			$this->id = "PAG";
		} else {
			$this->id = $rs->id;
		}

		$this->id = Yii::app()->CalculoID->getCalculoId($this->id, true);
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
		$this->pag_fec_ing 		= date('d-m-Y',strtotime($this->pag_fec_ing));
		
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
		$this->pag_fec_ing 		= date('Y-m-d',strtotime($this->pag_fec_ing));

		return parent::beforeSave();
	}


	/**
	 * conceptoPago()
	 *
	 * Lista Conceptos de Pagos aceptados
	 *
	 * @return listData lista para mostrar en un comboBox
	 */
	public static function conceptoPago()
	{
		$model = array(
			array('id' => 'M', 'value' => 'Mensualidad'),
			array('id' => 'L', 'value' => 'Listines'),
			array('id' => 'U', 'value' => 'Uniformes'),
			array('id' => 'C', 'value' => 'Carnet'),
			array('id' => 'P', 'value' => 'Publicidad'),
			array('id' => 'R', 'value' => 'Recolectas'),
		);
		return CHtml::listData($model, 'id', 'value');
	}

	/**
	 * tipoPago()
	 *
	 * Lista Tipos de Pagos aceptados
	 *
	 * @return listData lista para mostrar en un comboBox
	 */
	public static function tipoPago()
	{
		$model = array(
			array('id' => 'E', 'value' => 'Efectivo'),
			array('id' => 'D', 'value' => 'Depósito'),
			array('id' => 'T', 'value' => 'Transferencia'),
			array('id' => 'C', 'value' => 'Cheque'),
		);
		return CHtml::listData($model, 'id', 'value');
	}

	/**
	 * estadoPago()
	 *
	 * Lista los estados de los pagos, activos o anulados
	 *
	 * @return listData lista para mostrar en un comboBox
	 */
	public static function estadoPago()
	{
		$model = array(
			array('id' => '0', 'value' => 'Activo'),
			array('id' => '1', 'value' => 'ANULADO'),
		);

		return CHtml::listData($model, 'id', 'value');
	}

	/**
	 * obtenerEtiqueta()
	 * Se encarga de determinar si el pago está activo o anulado
	 * @return String etiqueta.
	 **/
	public static function obtenerEtiqueta($model)
	{
		if(isset($model->pag_anu) && ($model->pag_anu == 0)){
			$etiqueta =  'Anular';
		} else {
			$etiqueta = 'ANULADO';
		}
		return $etiqueta;
	}

	/**
	 * getListaPersonasPorVehiculo()
	 * Se encarga de arrojar una lista de personas que sean asociados a un vehículo
	 * para ser desplegados en un comboBox.
	 * @return listData lista para mostrar en un comboBox
	 */
	public static function getListaPersonasPorVehiculo($idv)
	{
		
		$model = Yii::app()->db->createCommand()
				->select(array('actr_conductores.id', 'per_nom', 'per_ape'))
				->from(array('actr_conductores', 'actr_personas'))
				->where('actr_conductores.id_persona = actr_personas.id')
				->andWhere('actr_conductores.id_vehiculo=:idv', array(':idv' => $idv))
				->queryAll();


		// Concatenamos nombre con apellido
		$aux = array();
		foreach ($model as $key => $value) {
			$aux[] = array(
				'id' => $value['id'], 
				'nom_com' => "{$value['per_nom']} {$value['per_ape']}",
			);
		}
		// Retornamos el listData
		return CHtml::listData($aux, 'id', 'nom_com');
	}

	/**
	 * getListaMesesPagados()
	 *
	 * Se encarga de arrojar una lista de los meses pagados en un conductor.
	 * (para ser desplegados en un comboBox).
	 *
	 * @param String fechaInicio Se encarga de proporcionar la fecha de inicio 
     * para una búsqueda limitada. Fecha de inicio debe ser mayor o igual a la 
     * fecha de ingreso del conductor.
     * @param String fechaFin Se encarga de proporcionar la fecha final 
     * para una búsqueda limitada.
     * @param String $conductor Se encarga de proporcionar el id del conductor
     * a buscar.
	 * @return Array $conjuntoFechas Listado de fechas pagas y no pagas.
	 */
	public static function getListaMesesPagados($fechaInicio, $fechaFin, $conductor)
	{
		// Crear conjunto de fechas para pago.
		$conjuntoFechas = self::getListaMeses($fechaInicio, $fechaFin);

		$fechaInicio 	= date('Y-m', strtotime($fechaInicio));
		$fechaFin		= date('Y-m', strtotime($fechaFin));
		
		// Query para ver mensualidades pagas
		$model = Yii::app()->db->createCommand()
				->select(array('actr_mensualidad_pagos.id', 'men_pag_mes_can'))
				->from(array('actr_pagos', 'actr_mensualidad_pagos'))
				->where("actr_pagos.id = actr_mensualidad_pagos.id_pago 
					AND id_conductor =:conductor 
                    AND actr_pagos.pag_anu = '0'
					AND DATE_FORMAT(men_pag_mes_can, '%Y-%m') >=:fechaInicio 
					AND DATE_FORMAT(men_pag_mes_can, '%Y-%m') <=:fechaFin", 
					array(
						':conductor' => $conductor, 
						':fechaInicio' => $fechaInicio, 
						':fechaFin' => $fechaFin
					))
				->order('men_pag_mes_can ASC')
				->queryAll();

		// Extrae mes y año con su id. Debería estar en una función aparte.
		$mensualidades = array();
		foreach ($model as $key => $value) {
			$mensualidades[] = array(
				'id' => $value['id'], 
				'mes' => date('m', strtotime($value['men_pag_mes_can'])),
				'anio' => date('Y', strtotime($value['men_pag_mes_can']))
			);
		}

		// Revisa qué mensualidades estan pagas, y cuales no.
		foreach ($conjuntoFechas as $key => $value) {
			foreach ($mensualidades as $valor) {
				if ($value['mes'] == $valor['mes'] && $value['anio'] == $valor['anio']) {
					$conjuntoFechas[$key]['id'] = $valor['id'];
					break;
				} 
			}
		}

		return $conjuntoFechas;
	}

	/**
	 * getResultadoDeuda
	 * 
	 * Identifica qué meses son, deudores o no deudores, y los exporta.
	 * El formato es de <em>id</em> que concatena el mes y el año, y 
	 * <em>fechaMensual</em> que forma una frase del mes y el año en español.
	 * Cuando <em>deudor</em> es <em>true</em> devuelve los deudores.
	 * @return Array $resultado Contiene todos los meses
	 * 
	 * */
	public static function getResultadoDeuda($model, $deudor)
	{
		$resultado = array();

		if ($deudor) {
			foreach ($model as $key => $value) {
				if (strlen($value['id']) < 10 ) {
					$mesEnLetra = Yii::app()->FuncionesImportantes->getMesNumeroALetra($value['mes']);
					$resultado[] = array(
						'id' => $value['mes'].$value['anio'], 
						'fechaMensual' => "{$mesEnLetra} de {$value['anio']}"
					);
				}
			}
		} else {
			foreach ($model as $key => $value) {
				if (strlen($value['id']) == 10 ) {
					$mesEnLetra = Yii::app()->FuncionesImportantes->getMesNumeroALetra($value['mes']);
					$resultado[] = array(
						'id' => $value['id'],
						'fechaMensual' => "{$mesEnLetra} de {$value['anio']}"
					);
				}
			}
		}

		return $resultado;
	}

	/**
	 * getListaMeses
	 * 
	 * Crea un Array de fechas Mensuales, desde una <em>fechaInicio</em> hasta
	 * una <em>fechaFin</em>.
	 * @param String fechaInicio Es la fecha de inicio del intérvalo el cual 
	 * se va a evaluar. (Se pasa por referencia para modificar).
	 * @param String fechaFin Es la fecha final del intérvalo el cual se va a
	 * evaluar. (Se pasa por referencia para modificar). 
	 * @return Array conjuntoFechas Todas las fechas mensuales.
	 *
	 * */
	public static function getListaMeses($fechaInicio, $fechaFin)
	{
		$conjuntoFechas = array();
		$mes = array(0 => date('m', strtotime($fechaInicio)), 1 => date('m', strtotime($fechaFin)));
		$anio = array(0 => date('Y', strtotime($fechaInicio)), 1 => date('Y', strtotime($fechaFin)));
		$m = $mes[0];
		$a = $anio[0];
		while ($a <= $anio[1]) {
			while ($m <= 12) {
				$conjuntoFechas[] = array(
					'id' 	=> str_pad($m.$a, 6, "0", STR_PAD_LEFT),
					'mes' 	=> str_pad($m, 2, "0", STR_PAD_LEFT), 
					'anio' 	=> $a
				);
				if ($m == $mes[1] && $a == $anio[1]) {
					break;
				}
				$m++;
			}
			$m = 1;
			$a++;
		}
		return $conjuntoFechas;
	}

	/**
	 * getConceptoPago()
	 * Retorna un concepto de pago para en recibo de pago, de manera 
	 * desglosada y acomodada.
	 * @param $idPago El id del pago realizado.
	 * @param $pagCon El concepto del pago realizado (sólo la palabra).
	 * @return String $concepto Un String que dice de manera 
	 * desglosada el concepto de pago.
	 * */
	public static function getConceptoPago($idPago, $pagCon)
	{
		$concepto = '';
		if ($pagCon == "M") {
			$model = MensualidadPago::getMesesPagados($idPago);
			if (count($model) >= 2) {
				# extrae principio y fin
				$intervalo = array();
				$intervalo[] = array(
					'mes' 	=> Yii::app()->FuncionesImportantes->getMesNumeroALetra(
						date('m', strtotime($model[0]->men_pag_mes_can))),
					'anio'	=> date('Y', strtotime($model[0]->men_pag_mes_can)),
				);
				$intervalo[] = array(
					'mes' 	=> Yii::app()->FuncionesImportantes->getMesNumeroALetra(
						date('m', strtotime($model[(count($model)-1)]->men_pag_mes_can))),
					'anio'	=> date('Y', strtotime($model[(count($model)-1)]->men_pag_mes_can)),
				);
				$concepto = "<u>Desde {$intervalo[0]['mes']} de {$intervalo[0]['anio']} 
					Hasta {$intervalo[1]['mes']} de {$intervalo[1]['anio']}</u>";
			} elseif (count($model == 1)) {
				# extrae el único
				$intervalo = array(
					'mes' 	=> Yii::app()->FuncionesImportantes->getMesNumeroALetra(
						date('m', strtotime($model[0]->men_pag_mes_can))),
					'anio'	=> date('Y', strtotime($model[0]->men_pag_mes_can)),
				);
				$concepto = "<u> Pago de {$intervalo['mes']} de {$intervalo['anio']}</u>";
			}
		} elseif ($pagCon == "L") {
			$model = Listin::model()->findByPk($idPago);
			$concepto = "<u>Pertenecientes a los números: {$model->lis_num1}, {$model->lis_num2}, 
			{$model->lis_num3}, {$model->lis_num4}</u>,<br />
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<u>{$model->lis_num5}, {$model->lis_num6}.</u>";
		}

		return $concepto;
	}

	/**
	 * getNumConYNomApeCond
	 * Obtiene Número de Control y Nombre completo del Conductor
	 * @param $modelDV Objeto que envía la información requerida
     * @return Objeto $modelDV Objeto con los datos llenos.
	 **/
	public static function getNumConYNomApeCond($modelDV)
	{
		$modelDV->numeroControl = Vehiculo::model()->findByPk($modelDV->numeroControl)->veh_num_con;
        $conPer = Conductor::model()->with('idPersona')->together()->findByPk($modelDV->nomConductor);
        $modelDV->nomConductor = $conPer->idPersona->per_nom . " " . $conPer->idPersona->per_ape;

		return $modelDV;
	}

	/**
	 * getInformacionMesesPagados
	 * Obtiene Todos los meses pagados de Un Conductor.
	 * @param $modelDV Objeto DocumentoForm que proporciona información
	 * con respecto al conductor.
     * @return Array $resultado Meses pagos
	 **/
	public static function getInformacionMesesPagados(&$modelDV)
	{
		$resultado = array();
		// 1.- Extraer las fechas
        $mensualidades  = self::getListaMesesPagados($modelDV->fechaInicio, $modelDV->fechaFin, 
            $modelDV->nomConductor);
        // 2.- Extraer fechas no deudoras
        $mensualidades  = self::getResultadoDeuda($mensualidades, false);
        // 3.- Información para encabezado
        $modelDV = self::getNumConYNomApeCond($modelDV);
        // 4.- Crear una matriz que busque los datos necesarios y los integre con los de la matriz
        foreach ($mensualidades as $key => $value)
            $resultado[] = MensualidadPago::model()->with('idPago')->together()->findByPk($value['id']);
        
        return $resultado;
	}



	public static function getDeudaMeses($fechaInicio, $fechaFin, $tipo)
	{
        // 1.- Hacer los intérvalos de fecha en forma de array
        // 2.- Hacer búsquedas de las personas que pagaron un determinado mes
        // 3.- Añadir listado de conductores con numeros de control y anexarlo en los intérvalos
        // 4.- Realizar comparación y determinar quienes no pagaron en cada mes. Añadir los meses y años
        // 5.- Extraer esos listados y concatenarlos.


        $conjuntoFechas = self::getListaMeses($fechaInicio, $fechaFin);
        $fechaInicio    = date('Y-m', strtotime($fechaInicio));
        $fechaFin       = date('Y-m', strtotime($fechaFin));

        $listadoVehiculos = array();
        $deudores = array();

        foreach ($conjuntoFechas as $key => $value) 
        {
            $model = Yii::app()->db->createCommand()
                    ->select(array('men_pag_mes_can', 'veh_num_con', 'per_nom', 'per_ape'))
                    ->from(array('actr_pagos', 'actr_mensualidad_pagos', 'actr_conductores', 
                        'actr_vehiculos', 'actr_personas'))
                    ->where("actr_pagos.id = actr_mensualidad_pagos.id_pago 
                        AND actr_personas.id = actr_conductores.id_persona 
                        AND actr_vehiculos.id = actr_conductores.id_vehiculo 
                        AND actr_conductores.id = actr_pagos.id_conductor 
                        AND actr_pagos.pag_anu = '0' 
                        AND actr_conductores.con_tip_con =:tipo 
                        AND DATE_FORMAT(men_pag_mes_can, '%Y-%m') =:fecha", 
                        array(
                            ':fecha' => $value['anio'] . "-" . $value['mes'],
                            ':tipo'  => $tipo
                        ))
                    ->order('men_pag_mes_can ASC, veh_num_con ASC')
                    ->queryAll();


            // Añadimos en $conjuntoFechas un array con los conductores que cancelaron
            array_push($conjuntoFechas[$key], $model);
            // Matriz con los conductores
            $listadoVehiculos[$key] = Conductor::getConductoresConVehiculo($tipo, 
                "{$value['anio']}-{$value['mes']}");

            foreach ($listadoVehiculos[$key] as $key1 => $value1) 
            {
                if (empty($conjuntoFechas[$key][0]) == false)
                {
                    foreach ($conjuntoFechas[$key][0] as $key2 => $value2) 
                    {
                        if ($value1['veh_num_con'] == $value2['veh_num_con'] && 
                            $value1['per_nom'] == $value2['per_nom'] && 
                            $value1['per_ape'] == $value2['per_ape']) 
                        {
                            $aux = array();
                            break;
                        }
                        // Te acordarás que lloraste sangre aqui por TU CULPA jajajajaja
                        $aux = $value1;
                    }
                    if (!empty($aux)) 
                    {
                        $mesEnLetra = Yii::app()->FuncionesImportantes->getMesNumeroALetra($conjuntoFechas[$key]['mes']);
                        $aux["men_pag_mes_can"] = "{$mesEnLetra} de {$conjuntoFechas[$key]['anio']}";
                        array_push($deudores, $aux);
                    }
                } else {
                    $mesEnLetra = Yii::app()->FuncionesImportantes->getMesNumeroALetra($conjuntoFechas[$key]['mes']);
                    array_push($value1,  "{$mesEnLetra} de {$conjuntoFechas[$key]['anio']}");
                    array_push($deudores, $value1);
                }
            }
        }
        
        return $deudores;   
    }


    public static function getTotalListines($fechaInicio, $fechaFin)
    {
        $fechaInicio    = date('Y-m-d', strtotime($fechaInicio));
        $fechaFin       = date('Y-m-d', strtotime($fechaFin));

        $model = new Pago();
		$model = $model->search();
		$criteria = $model->getCriteria();
		$criteria->condition = 'pag_con = "L" 
            AND pag_fec_ing >=:fechaInicio 
            AND pag_fec_ing <=:fechaFin AND pag_anu = "0"';
        $criteria->params = array(':fechaInicio' => $fechaInicio, ':fechaFin' => $fechaFin);
        $criteria->order = "veh_num_con ASC";
		$model->setCriteria($criteria);

		return $model;

        // CVarDumper::dump($model);
        // Yii::app()->end();
    }
    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Pago the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
