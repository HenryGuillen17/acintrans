<?php

class ConductorController extends Controller
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
			'modelFamiliares' => Familiar::model()->findByPk($this->loadModel($id)->id_persona)
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Conductor;
		$modelFamiliares = new Familiar;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation(array('model'=>$model, 'modelFamiliares' => $modelFamiliares));

		// Ruta de la imagen
		$path_picture = Yii::getPathOfAlias('webroot')."/images/uploads/";

		if(isset($_POST['Conductor'], $_POST['Familiar']))
		{
			$model->attributes=$_POST['Conductor'];
			$modelFamiliares->attributes=$_POST['Familiar'];
			
			$model->getCodigo();

			// Agregar fecha de ingreso.
			$model->con_fec_ing = date('Y-m-d');

			// Se agrega el conductor para unirse con un familiar.
			$modelFamiliares->id_persona1 = $model->id_persona;

			// Instancia a un objeto para subir archivos
			$uploadedFile = CUploadedFile::getInstance($model,'con_fot');
			// Fija el nombre del archivo
			$fileName = "{$model->id_persona}-".date('Ymd');

			if(!empty($uploadedFile))  // Verifica si se está subiendo un archivo
            {
                // Guardar Imagen
                $uploadedFile->saveAs($path_picture.$fileName);
                $model->con_fot = $fileName;
            }

			if($model->save() && $modelFamiliares->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model, 'modelFamiliares' => $modelFamiliares
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
		$modelFamiliares=new Familiar;

		// Ruta de la imagen
		$path_picture = Yii::getPathOfAlias('webroot')."/images/uploads/";

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation(array('model'=>$model, 'modelFamiliares' => $modelFamiliares));

		if(isset($_POST['Conductor'], $_POST['Familiar']))
		{
			$model->attributes=$_POST['Conductor'];
			$modelFamiliares->attributes=$_POST['Familiar'];

			$modelFamiliares->id_persona1 = $model->id_persona;

			$modelFamiliares->setIsNewRecord(false);

			// Instancia a un objeto para subir archivos
			$uploadedFile = CUploadedFile::getInstance($model,'con_fot');

			//si el campo de la imagen está vacio o es null
			if ($model->con_fot == '' || $model->con_fot == null ) { 
				// Fija el nombre del archivo
				$fileName = "{$model->id_persona}-".date('Ymd');
			} else { // Ya tenemos una imagen registrada
				$fileName = $model->con_fot;
			}

			if(!empty($uploadedFile))  // Verifica si se está subiendo un archivo
            {
                // Guardar Imagen
                $uploadedFile->saveAs($path_picture.$fileName);
                $model->con_fot = $fileName;
            }

			if($model->save() && $modelFamiliares->update())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model, 'modelFamiliares' => $modelFamiliares
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
		// Eliminar familiar relacionado
		Familiar::model()->findByPk($this->loadModel($id)->id_persona)->delete;

		// if AJAX request (triggered by deletion via index grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model = new Conductor('search');
		$modelDV = new DocumentoForm;

		// Código para redireccionar a ver los *.pdf
		if (isset($_POST['DocumentoForm'])) {
			$modelDV->attributes = $_POST['DocumentoForm'];
			$this->actionViewPdf($modelDV->documento);
		}

		$modelDV->unsetAttributes();  // clear any default values
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Conductor']))
			$model->attributes=$_GET['Conductor'];  

		$this->render('index',array(
			'model'		=> $model,
			'modelDV'	=> $modelDV,
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
	public function actionViewPdf($valor = 'ListaConductores')
	{
		$this->layout = "//layouts/pdf";
		$mPDF1 = Yii::app()->ePdf->mpdf('c', 'LETTER-L');
		
		if ($valor == 'ListaConAsoc') {
			$mPDF1 = Yii::app()->ePdf->mpdf();
			$model = Conductor::busqTipoConductor(0);
			$mPDF1->WriteHtml($this->render('pdf/view_aso_pdf',array('model'=>$model), true));
		}
		if ($valor == 'ListaConAvan') {
			$mPDF1 = Yii::app()->ePdf->mpdf();
			$model = Conductor::busqTipoConductor(1);
			$mPDF1->WriteHtml($this->render('pdf/view_ava_pdf',array('model'=>$model), true));
		}
		if ($valor == 'ListaConductores') {
			$model = new Conductor('search');
			$mPDF1->WriteHtml($this->render('pdf/view_pdf',array('model'=>$model), true));
		}
		if ($valor == 'CedVencidas') {
			$model = Conductor::getDocVencidos('con_fec_ven_ced');
			$mPDF1->WriteHtml($this->render('pdf/ced_ven_pdf',array('model'=>$model), true));
		}
		if ($valor == 'RifVencidas') {
			$model = Conductor::getDocVencidos('con_fec_ven_rif');
			$mPDF1->WriteHtml($this->render('pdf/rif_ven_pdf',array('model'=>$model), true));
		}
		if ($valor == 'LicCondVencidas') {
			$model = Conductor::getDocVencidos('con_fec_ven_lic');
			$mPDF1->WriteHtml($this->render('pdf/lic_ven_pdf',array('model'=>$model), true));
		}
		if ($valor == 'CerMedVencidas') {
			$model = Conductor::getDocVencidos('con_fec_cer_med');
			$mPDF1->WriteHtml($this->render('pdf/cer_med_ven_pdf',array('model'=>$model), true));
		}

		$mPDF1->Output($valor.".pdf",'I');
		
		exit;
	}

	/**
	 * Muestra el PDF de el Detalle de Conductor.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionVerConductor($id)
	{
		$this->layout = "//layouts/pdf";
		$mPDF1 = Yii::app()->ePdf->mpdf('c', 'LETTER-P');
		$model = $this->loadModel($id);
		$modelFamiliares = Familiar::model()->findByPk($this->loadModel($id)->id_persona);
		$mPDF1->WriteHtml(
			$this->render('pdf/view_con_pdf',array(
				'model'=>$model, 
				'modelFamiliares' => $modelFamiliares), true));
		$mPDF1->Output($model->id . ".pdf",'I');
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Conductor the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Conductor::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Conductor $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='conductor-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
