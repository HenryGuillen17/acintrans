<?php

class PagoController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/main';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model                = new Pago;
        $modelListin          = new Listin;
		$modelMensualidadPago = new MensualidadPago;
        $modelMP = array();

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation(array(
            'model'=>$model,
            'modelListin'=>$modelListin,
            'modelMensualidadPago'=>$modelMensualidadPago,
        ));

        if(isset($_POST['Pago']))
        {
            $model->attributes=$_POST['Pago'];
            // Identificamos el pago con un código.
            $model->getCodigo();
            // Colocamos el pago activo
            $model->pag_anu = 0;
            // Fecha de hoy
            $model->pag_fec_ing = date('Y-m-d');
            
            // GuardarMensualidades
            if(isset($_POST['MensualidadPago']) && $model->pag_con == "M"){   
                $modelMensualidadPago->attributes = $_POST['MensualidadPago'];
                foreach ($modelMensualidadPago->men_pag_mes_can as $key => $value) {
                    $modelMP[] = new MensualidadPago;
                    $fechaExtraida = substr($value, 2, 4) . "-" . substr($value, 0, 2) . "-01";
                    $modelMP[$key]->getCodigo();
                    $modelMP[$key]->id_pago = $model->id;
                    $modelMP[$key]->men_pag_mes_can = $fechaExtraida;
                    $modelMP[$key]->men_pag_mon = $model->pag_mon / count($modelMensualidadPago->men_pag_mes_can);
                }
            } elseif (!isset($_POST['MensualidadPago']) && $model->pag_con == "M") {
                $model->addError($model->pag_men_pagos, 
                    'Seleccione al Menos un Mes Deudor');
            }

            // Guardar Listín
            if(isset($_POST['Listin']) && $model->pag_con == "L") {   
                $modelListin->attributes = $_POST['Listin'];
                $modelListin->id_pago = $model->id;
                if (!$modelListin->validate()) {
                    $model->addError($model->pag_listin, 
                    'Error al ingresar Listines');
                }
            } elseif (!isset($_POST['Listin']) && $model->pag_con == "L") {
                $model->addError($model->pag_listin, 
                    'Error al ingresar Listines');
            }

            if(!$model->hasErrors()) 
            {
                $model->save();
                if ($modelListin)
                    $modelListin->save();
                if ($modelMP)
                    foreach ($modelMP as $key => $value)
                        $value->save();

                $this->redirect(array('view','id'=>$model->id));
            }
        }

        //$prueba = Pago::getListaMesesPagados('0000-00-00', date('Y-m-d'), 'CON0000003');

        $this->render('create',array(
            'model'=>$model,
            'modelListin'=>$modelListin,
            'modelMensualidadPago'=>$modelMensualidadPago,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if(isset($_POST['Pago']))
        {
            $model->attributes=$_POST['Pago'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('update',array(
            'model'=>$model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $model=new Pago('search');
        $modelDV = new DocumentoForm;

        // Código para redireccionar a ver los *.pdf
        if (isset($_POST['DocumentoForm'])) {
            $modelDV->attributes = $_POST['DocumentoForm'];
            if (!$b = MensualidadPago::getValidarIntervaloFecha($modelDV->fechaInicio, 
                $modelDV->fechaFin, $modelDV->fechaInicio))
                throw new CHttpException(404,'Rango Fechas No Válido.');
            $this->actionDeudaCon($modelDV);
        }

        $modelDV->unsetAttributes();  // clear any default values
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Pago']))
            $model->attributes=$_GET['Pago'];
		$this->render('index',array(
			'model'     => $model,
            'modelDV'   => $modelDV,
		));
	}

    public function actionDeudaCon($modelDV)
    {
        $this->layout = "//layouts/pdf";
        $mPDF1 = Yii::app()->ePdf->mpdf('c', 'Letter-L');

        $model = Pago::getDeudaMeses($modelDV->fechaInicio, $modelDV->fechaFin, $modelDV->documento);

        $mPDF1->WriteHtml(
            $this->render('pdf/_deudoresMensuales',array(
                'model' => $model,
                'modelDV'=>$modelDV,
        ), true));

        $mPDF1->Output('DeudMensuales_' . $modelDV->documento . '.pdf', 'I');

    }

    /**
     * Lista todos los reportes con Historial de Pagos.
     */
    public function actionHistPago()
    {
        $model      = new Pago('search');
        $modelDV    = new DocumentoForm;
        $resultado  = array();

        // Código para redireccionar a ver los *.pdf
        if (isset($_POST['DocumentoForm'])) 
        {
            $modelDV->attributes = $_POST['DocumentoForm'];

            // 1.- Validar rango Fechas
            $fechaIng = Conductor::model()->findByPk($modelDV->nomConductor)->con_fec_ing;
            if (!$b = MensualidadPago::getValidarIntervaloFecha($modelDV->fechaInicio, 
                $modelDV->fechaFin, $fechaIng))
                throw new CHttpException(404,'Rango Fechas No Válido.');

            if ($modelDV->documento == "M")
                $resultado = Pago::getInformacionMesesPagados($modelDV);
            /*
            elseif ($modelDV->documento == "P")
                $resultado = Pago::getInformacionPublicidadPagada($modelDV);
            elseif ($modelDV->documento == "R")
                $resultado = Pago::getInformacionMesesPagados($modelDV);
            */
            
            $this->actionViewPagoPdf($resultado, $modelDV);
        }

        $this->render('hist_pago',array(
            'model'     => $model,
            'modelDV'   => $modelDV,
        ));
    }

    /**
     * Lista todos los reportes con Listines Pagados.
     */
    public function actionListines()
    {
        $model=new Pago('search');
        $modelDV = new DocumentoForm;

        // Código para redireccionar a ver los *.pdf
        if (isset($_POST['DocumentoForm'])) {
            
            $modelDV->attributes = $_POST['DocumentoForm'];
            if (!$b = MensualidadPago::getValidarIntervaloFecha($modelDV->fechaInicio, 
                $modelDV->fechaFin, $modelDV->fechaInicio))
                throw new CHttpException(404,'Rango Fechas No Válido.');
            // Proceso
            $model = Pago::getTotalListines($modelDV->fechaInicio, $modelDV->fechaFin);
            // PDF
            $this->layout = "//layouts/pdf";
            $mPDF1 = Yii::app()->ePdf->mpdf('c', 'Letter-L');
            $mPDF1->WriteHtml(
                $this->render('pdf/_totListines',array(
                    'model'     => $model,
                    'modelDV'   => $modelDV,
            ), true));
            $mPDF1->Output($modelDV->documento . '.pdf', 'I');
        }

        $this->render('listines',array(
            'model'     => $model,
            'modelDV'   => $modelDV,
        ));
    }

    /**
     * actionViewPdf
     * 
     * Exporta todos los PDF relacionados con el modelo <em>Conductor</em>.
     * @param Char Valor Recibe una letra, y según esa letra, se decide cuál 
     * PDF se debe exportar.
     * 
     * */
    public function actionViewPagoPdf($resultado, $modelDV)
    {
        $this->layout = "//layouts/pdf";
        $mPDF1 = Yii::app()->ePdf->mpdf('c', 'Letter-L');

        if ($modelDV->documento == 'M') {

            $mPDF1->WriteHtml(
                $this->render('pdf/_hisMensual',array(
                    'model'     => $resultado,
                    'modelDV'   => $modelDV,
            ), true));
        }

        $mPDF1->Output($modelDV->documento . '.pdf', 'I');
    }

    /**
     * actionViewPdf
     * 
     * Exporta todos los PDF relacionados con el modelo <em>Conductor</em>.
     * @param Char Valor Recibe una letra, y según esa letra, se decide cuál 
     * PDF se debe exportar.
     * 
     * */
    public function actionViewPdf($id)
    {
        $this->layout = "//layouts/pdf";
        $mPDF1 = Yii::app()->ePdf->mpdf('c', 'Letter-P', '', '', '10', '10', '15', '10', '0');

        $mPDF1->WriteHtml(
            $this->render('pdf/view_pag_pdf',array(
                'model'     => $this->loadModel($id),
        ), true));

        $mPDF1->Output($modelDV->documento . '.pdf', 'I');
    }

	/**
	 * actionAjaxActivador()
	 * 
	 * Se encarga de activar o anular un pago mediante el uso de Ajax.
	 *
	 * @param String id Envía el ID del pago para ser anulado o activado.
	 *
	 **/
	public function actionAjaxActivador($id)
    {
		// activara al usuario en la sesion de ejemplo, pudimos haber dicho aqui:
		//   "por favor activa este usuario en la nomina seleccionada"
		//$listado = Yii::app()->user->getState("usuarios_activados");
		$etiqueta = "";

		$model = Pago::model()->findByPk($id);

		if(isset($model->pag_anu) && ($model->pag_anu == 0)){
			$model->pag_anu = 1;
			$etiqueta = "ANULADO";
            $model->save(); // Iba afuera del condicional.
            echo $etiqueta; // Iba afuera del condicional.
        } 
        /*
        else{
            $model->pag_anu = 0;
            $etiqueta = "Anular";
        }
        */
        //Yii::app()->user->setState("usuarios_activados",$listado);
	}

	/**
	 * actionCargarConductores()
	 * Se encarga de llenar el ComboBox de los conductores asociados a un numero
	 * de control.
	 **/
	public function actionCargarConductores()
	{
        if (isset($_POST['Pago']['id_vehiculo']))
            $idv = $_POST['Pago']['id_vehiculo'];
        if (isset($_POST['DocumentoForm']['numeroControl']))
            $idv = $_POST['DocumentoForm']['numeroControl'];

		if (isset($idv))
		{
			$model = Pago::getListaPersonasPorVehiculo($idv);
			echo CHtml::tag('option', array('value'=>''), CHtml::encode('Seleccione'), true);
            foreach($model as $value=>$name)
				echo CHtml::tag('option', array('value'=>$value), CHtml::encode($name), true);
		} 
	}

    /**
     * actionCargarMesesPagados()
     *
     * Se encarga de llenar el ComboBox de las mensualidades, todos los meses 
     * deudores que tiene el conductor.
     *
     * @param String fechaInicio Se encarga de proporcionar la fecha de inicio 
     * para una búsqueda limitada. Fecha de inicio debe ser mayor o igual a la 
     * fecha de ingreso del conductor.
     * @param String fechaFin Se encarga de proporcionar la fecha final 
     * para una búsqueda limitada.
     * @param Boolean deudor Se encarga de decidir si se va a exportar los 
     * pagos realizados mensualmente por un conductor, o los pagos que debe.
     * <strong>true</strong> para exportar meses deudores.
     *
     **/
    public function actionCargarMesesPagados($fechaInicio, $fechaFin, $deudor)
    {

        $concepto   = $_POST['Pago']['pag_con'];
        $conductor  = $_POST['Pago']['id_conductor'];   

        if (isset($concepto, $conductor) && $concepto == 'M')
        {
            // Busca la fecha de ingreso del conductor
            $modelConductor = Conductor::model()->findByPk($conductor);
            $fechaIng   = $modelConductor->con_fec_ing;
            // Validar en función aparte las fechas que se ingrese como intérvalo.
            $b = MensualidadPago::getValidarIntervaloFecha($fechaInicio, $fechaFin, $fechaIng);
            if (!$b) {
                echo CHtml::tag('option', array('value'=>'ERROR FECHAS'), CHtml::encode('Seleccione'), true);
                break;
            }
            // Extraer pagos mensuales del conductor (pago y mensualidades)
            $model  = Pago::getListaMesesPagados($fechaInicio, $fechaFin, $conductor);
            // Extrae los datos necesitados (Los deudores)
            $model  = Pago::getResultadoDeuda($model, $deudor);
            // Lo exporta en un ListData
            $model = CHtml::listData($model, 'id', 'fechaMensual');
            if ($model) {
                foreach($model as $value=>$name)
                    echo CHtml::tag('option', array('value'=>$value), CHtml::encode($name), true);
            } else {
                echo CHtml::tag('option', array('value'=>''), CHtml::encode('Seleccione'), true);
            }
            // CVarDumper::dump($model);
            // Yii::app()->end();
        } 
    }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Pago the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Pago::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Pago $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='pago-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}