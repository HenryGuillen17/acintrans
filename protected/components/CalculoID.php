<?php

/**
* @author HenryGuillen17
* @package components
*/
class CalculoID extends CApplicationComponent
{
	
	/**
     * getDecimal()
     * 
     * Se encarga de convertir un número Hexadecimal a Decimal.
     * 
     * @param $hexadecimal String que contiene el número hexadecimal.
     * 
     * @return $decimal String que contiene el número decimal ya calculado.
     * 
     **/
    public function getDecimal($hexadecimal)
    {
        // // Convertimos el número Hexadecimal en decimal
        $decimal = hexdec($hexadecimal);

        return $decimal;
    }

    /**
     * getHexadecimal()
     * 
     * Se encarga de convertir un número Hexadecimal a Decimal.
     * 
     * @param $decimal String que contiene el número decimal.
     * 
     * @return $hexadecimal String que contiene el número hexadecimal ya calculado.
     * 
     **/
    public function getHexadecimal($decimal)
    {
        // Convertimos el número decimal en hexadecimal
        $hexadecimal = dechex($decimal);

        // Rellena de Ceros a la izquierda, hasta que sean 7 dígitos
        $hexadecimal = str_pad($hexadecimal, 7, "0", STR_PAD_LEFT);

        // Si la variable hexadecimal es: 10000000 (Decimal es 268.435.456)
        // Sobreescribe la variable con "Overflow"
        if (strcmp($hexadecimal, "10000000") == 0) {
            $hexadecimal = "00OVERFLOW";
        }

        return $hexadecimal;
    }

    /**
     * getCalculoId()
     * 
     * Se encarga de agarrar un ID y aumentarle un dígito más.
     * Primero, lo convierte de Hexadecimal a Decimal, luego le suma un dígito más,
     * y por último lo convierte deDecimal a Hexaecimal.
     * En caso de no conseguir el código ID, lo forma desde "1", ya que $id va a contener
     * el prefijo correcto para formarlo.
     * 
     * @param $id String que contiene el codigo ID relacionado con alguna tabla, 
     * o sólo el prefijo respectivo.
     * 
     * @return $idCalculado String que contiene el codigo ID ya calculado y transformado.
     * 
     **/
    public function getCalculoId($id, $tipo)
    {
        // Verificamos si realmente existe un código ID
        // Si no existe, formamos un nuevo código ID evaluando si $id tiene 3 letras.
        if (strlen($id) == 3 ) {
            $idCalculado = $id . "0000001";
        } else {
            // Extraemos el código ID para procesar
            $idCalculado    = $id;
            // Sacamos el prefijo del código ID a procesar
            $prefijo        = substr($id, 0, 3);
            // Sacamos el número en hexadecimal del código ID
            $numero         = substr($id, 3, 7);
            // Se decide si se va a transformar en hexadecimal o no
            if ($tipo) {
                // Se incrementa el número dado
                $numero         += 1;
                // Se da el formato para código
                $numero         = str_pad($numero, 7, "0", STR_PAD_LEFT);
            } else {
                // Se envía a convertir en decimal
                $numero         = $this->getDecimal($numero);
                // Se incrementa el número dado
                $numero         += 1;
                // Se transforma a hexadecimal de nuevo
                $numero         = $this->getHexadecimal($numero);
                // Mayúsculas al código
                $numero         = strtoupper($numero);
            }
            // Se une con el prefijo anteriormente sacado
            $idCalculado    = $prefijo . $numero;
        }


        return $idCalculado;
    }


}