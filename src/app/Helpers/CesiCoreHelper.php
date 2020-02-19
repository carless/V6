<?php
namespace Cesi\Core\app\App\Helpers;

use Cesi\Core\app\Models\CesiUser;
use Cesi\Core\app\Models\CoreSettings;
use Cesi\Core\app\Models\TaskStatus;

class CesiCoreHelper
{
    private static $cacheTaskStatus = array();
    private static $cacheSettings = array();

    public static function getConfiguracion($keyName, $defaultValue = null)
    {
        if (isset(self::$cacheSettings[$keyName])) {
            return self::$cacheSettings[$keyName];
        } else {
            $mySetting = CoreSettings::where('key', $keyName)->first();

            if ($mySetting === null) {
                // No exite
                $mySetting = new CoreSettings([
                    'key' => $keyName,
                    'description' => 'Descripcion para ' . $keyName,
                    'value' => $defaultValue
                ]);
                $mySetting->save();
            }

            self::$cacheSettings[$keyName] = $mySetting->value;

            return $mySetting->value;
        }
    }

    /**
     * Devuelve un array con los tipos de prioridad para las tareas
     *
     * @return array
     */
    public static function getEmailTmplTheme()
    {
        return [
            'cesi::core.mail.standart.mailtemplate' => 'Standart',
        ];
    }

    public static function getTaskStatus($keyId)
    {
        if (isset(self::$cacheTaskStatus[$keyId])) {

        } else {
            $myTaskStatus = TaskStatus::find($keyId);
            self::$cacheTaskStatus[$keyId] = $myTaskStatus;
        }

        return self::$cacheTaskStatus[$keyId];
    }

    /**
     * Devuelve un array con los tipos de prioridad para las tareas
     *
     * @return array
     */
    public static function getTaskPrioridad()
    {
        return [
            '1' => 'Baja',
            '2' => 'Media',
            '3' => 'Alta',
            '4' => 'Crítica',
        ];
    }

    public static function getSelectTaskPrioridad()
    {
        return [
            '0' => '- Todos -',
            '1' => 'Baja',
            '2' => 'Media',
            '3' => 'Alta',
            '4' => 'Crítica',
        ];
    }

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
            'mytask'    => 'Lista Tareas',
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

    public static function getTiposPreImpresos()
    {
        return [
            '0' => '- Sin -',
            '1' => 'ISP Carta de dominio',
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

    public static function getUserName($userId)
    {
        $user = CesiUser::find($userId);
        if ($user) {
            return $user->name;
        }
        return null;
    }

    public static function getUserEmail($userId)
    {
        $user = CesiUser::find($userId);
        if ($user) {
            return $user->email;
        }
        return null;
    }

    public static function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '_', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '_');

        // remove duplicate -
        $text = preg_replace('~-+~', '_', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}
