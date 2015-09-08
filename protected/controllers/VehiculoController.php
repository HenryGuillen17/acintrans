<?php

class VehiculoController extends Controller
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
		$model=new Vehiculo;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Vehiculo']))
		{
			$model->attributes=$_POST['Vehiculo'];
			$model->getCodigo();
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
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

		if(isset($_POST['Vehiculo']))
		{
			$model->attributes=$_POST['Vehiculo'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via index grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model 	 = new Vehiculo('search');
		$modelDV = new DocumentoForm;

		// Código para redireccionar a ver los *.pdf
		if (isset($_POST['DocumentoForm'])) {
			$modelDV->attributes = $_POST['DocumentoForm'];
			$this->actionViewPdf($modelDV->documento);
		}

		$model->unsetAttributes();  // clear any default values
		$modelDV->unsetAttributes();  // clear any default values
		if(isset($_GET['Vehiculo']))
			$model->attributes=$_GET['Vehiculo'];
		$this->render('index',array(
			'model'		=> $model,
			'modelDV'	=> $modelDV,
		));
	}

	/**
	 * actionViewPdf
	 * 
	 * Exporta todos los PDF relacionados con el modelo <em>Vehiculo</em>.
	 * @param Char Valor Recibe una letra, y según esa letra, se decide cuál 
	 * PDF se debe exportar.
	 * 
	 * */
	public function actionViewPdf($valor = 'ListaVehiculos')
	{
		$this->layout = "//layouts/pdf";
		$mPDF1 = Yii::app()->ePdf->mpdf();
		$fechaLimite = date('Y-m-d', strtotime(date('Y-m-d') . '+ 1 month'));
		
		if ($valor == 'ListaVehiculos') {
			$mPDF1 = Yii::app()->ePdf->mpdf('c', 'LETTER-L');
			$model = new Vehiculo('search');
			$mPDF1->WriteHtml($this->render('pdf/view_pdf', array('model'=>$model), true));
		}
		if ($valor == 'SegVenVencidos') {
			$model = Vehiculo::model()->findAll('veh_seg_fec_ven1 < :fechaLimite', 
				array(':fechaLimite' => $fechaLimite));
			$mPDF1->WriteHtml($this->render('pdf/seg_ven_vencidos_pdf', array('model'=>$model), true));
		}
		if ($valor == 'SegCol1Vencidos') {
			$model = Vehiculo::model()->findAll('veh_seg_fec_ven2 < :fechaLimite', 
				array(':fechaLimite' => $fechaLimite));
			$mPDF1->WriteHtml($this->render('pdf/seg_col1_vencidos_pdf',array('model'=>$model), true));
		}
		if ($valor == 'SegCol2Vencidos') {
			$model = Vehiculo::model()->findAll('veh_seg_fec_ven3 < :fechaLimite', 
				array(':fechaLimite' => $fechaLimite));
			$mPDF1->WriteHtml($this->render('pdf/seg_col2_vencidos_pdf',array('model'=>$model), true));
		}
		$mPDF1->Output($valor.".pdf",'I');
		exit;

		/*
		$this->render('pdf/view_pdf',array(
			'model'=>$model,
		));
		*/
	}

	/**
	 * Muestra el PDF de el Detalle de Vehículo.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionVerVehiculo($id)
	{
		$this->layout = "//layouts/pdf";
		$mPDF1 = Yii::app()->ePdf->mpdf('c', 'LETTER-P');
		$model = $this->loadModel($id);
		$mPDF1->WriteHtml($this->render('pdf/view_veh_pdf',array('model'=>$model), true));
		$mPDF1->Output($model->id . ".pdf",'I');
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Vehiculo the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Vehiculo::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'La página solicitada no existe.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Vehiculo $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='vehiculo-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
