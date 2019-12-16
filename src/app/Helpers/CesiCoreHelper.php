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

    public static function getTiposMenus()
    {
        return [
            'root'      => 'Raiz Principal',
            'separator' => 'Separador',
            'link'      => 'Link a URL',
            'route'     => 'route',
        ];
    }
}