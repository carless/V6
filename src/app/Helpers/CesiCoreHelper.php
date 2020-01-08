<?php
/**
 * Created by PhpStorm.
 * User: Carless
 * Date: 13/12/2019
 * Time: 10:00
 */
namespace Cesi\Core\app\App\Helpers;

class CesiCoreHelper
{

    public static function getDashboardAreas()
    {
        return [
            'top'   => 'Superior',
            'left'  => 'Izquierda',
            'right' => 'Derecha',
            'center'=> 'Central',
            'bottom'=> 'Inferior',
        ];
    }

    public static function getTiposDashboardItems()
    {
        return [
            'small-box' => 'Caja pequeña',
            'info-box'  => 'Caja Información',
        ];
    }

    public static function getTiposMenus()
    {
        return [
            'root'      => 'Raiz Principal',
            'separator' => 'Separador',
            'link'      => 'Link a URL',
            'route'     => 'route',
        ];
    }

    /**
     * quita el formato de moneda
     *
     * @param $input
     * @return float
     */
    public static function removeNumberFormat($input)
    {
        /* split input in 3 parts: integer, separator, decimals */
        // $number = preg_replace('/[^\d]/', '', $input);
        // $number = substr($number, 0,-2) . "." . substr($number,-2);
        $number = str_replace(",", "", $input);
        $number = str_replace("$", "", $number);
        $number = str_replace("€", "", $number);
        $number = str_replace("%", "", $number);
        $number = str_replace(" ", "", $number);

        // $number = preg_replace('/[\$,]/', '', $input);
        // $number = preg_replace('/[\€,]/', '', $number);
        // $number = preg_replace('/[\%,]/', '', $number);

        return floatval($number);
    }

    public static function removeSymbols($input)
    {
        $result = str_replace(",", "", $input);
        $result = str_replace(".", "", $result);
        $result = str_replace("-", "", $result);
        $result = str_replace("_", "", $result);

        return $result;
    }
}