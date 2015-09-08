<?php

/**
* @author HenryGuillen17
* @package components
*/
class FuncionesImportantes extends CApplicationComponent
{
	
	/**
	 * getMesNumeroALetra
	 * 
	 * Se encarga de transformar los meses de Números a Letras.
	 * @return String mes Se devuelve el mes en formato de palabra.
	 * 
	 **/
	public function getMesNumeroALetra($mes)
	{
		switch ($mes) {
			case 1:
				$mes = "Enero";
				break;

			case 2:
				$mes = "Febrero";
				break;

			case 3:
				$mes = "Marzo";
				break;

			case 4:
				$mes = "Abril";
				break;

			case 5:
				$mes = "Mayo";
				break;

			case 6:
				$mes = "Junio";
				break;

			case 7:
				$mes = "Julio";
				break;

			case 8:
				$mes = "Agosto";
				break;

			case 9:
				$mes = "Septiembre";
				break;

			case 10:
				$mes = "Octubre";
				break;

			case 11:
				$mes = "Noviembre";
				break;

			case 12:
				$mes = "Diciembre";
				break;

		}
		return $mes;
	}

	/**
	 * getMesLetraANumero
	 * 
	 * Se encarga de transformar los meses de Letras a Números.
	 * @return String mes Se devuelve el mes en formato numérico.
	 * 
	 **/
	public function getMesLetraANumero($mes)
	{
		switch ($mes) {
			case "Enero":
				$mes = "01";
				break;

			case "Febrero":
				$mes = "02";
				break;

			case "Marzo":
				$mes = "03";
				break;

			case "Abril":
				$mes = "04";
				break;

			case "Mayo":
				$mes = "05" ;
				break;

			case "Junio":
				$mes = "06";
				break;

			case "Julio":
				$mes = "07";
				break;

			case "Agosto":
				$mes = "08";
				break;

			case "Septiembre":
				$mes = "09";
				break;

			case "Octubre":
				$mes = "10";
				break;

			case "Noviembre":
				$mes = "11";
				break;

			case "Diciembre":
				$mes = "12";
				break;

		}
		return $mes;
	}

	/**
	 * getDistanciaFecha
	 * 
	 * Se encarga de cuantificar la distancia entre dos fechas, dado un
	 * intérvalo de paso.
	 * @param String fecha1 Es la fecha de inicio del intérvalo el cual 
	 * se va a evaluar.
	 * @param String fecha2 Es la fecha final del intérvalo el cual se va a
	 * evaluar.
	 * @param String step Intérvalo de paso el cual se va a medir.
	 * @return Integer r Medida del tiempo. Mayor a 0, Fecha 2 es mayor que fecha 1.
	 * 
	 * */
	public function getDistanciaFecha($fecha1, $fecha2, $step)
	{
		$datetime1 = new DateTime($fecha1 . " 02:00:00");
		$datetime2 = new DateTime($fecha2 . " 02:00:00");
		$intervalo = $datetime1->diff($datetime2);

		if ($step == "d") {
			$r = $intervalo->format('%R%d');
		}
		if ($step == "m") {
			$r = $intervalo->format('%R%m');
		}

		return $r;
		
	}


}