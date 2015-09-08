<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class DocumentoForm extends CFormModel
{
	public $documento;
	public $numeroControl;
	public $nomConductor;
	public $fechaInicio;
	public $fechaFin;
	public $vista;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('documento, numeroControl, nomConductor, fechaInicio, fechaFin', 'required'),
			array('fechaInicio, fechaFin', 'date', 'format' => 'dd-mm-yyyy'),
			// validar que fechaInicio sea menor a fechaFin
			//array('fechaFin', 'getDistanciaFecha'),
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'documento' 	=> 'Documentos',
			'numeroControl' => 'Número de Control',
			'nomConductor'  => 'Nombre Conductor',
			'fechaInicio' 	=> 'Fecha de Inicio',
			'fechaFin' 		=> 'Fecha Final',
		);
	}
}