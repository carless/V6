<?php
namespace Cesi\Core;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

trait CesiCrudTrait
{
    public static function hasCesiCrudTrait()
    {
        return true;
    }

    public static function isColumnNullable($column_name)
    {
        // create an instance of the model to be able to get the table name
        $instance = new static();

        $conn = DB::connection($instance->getConnectionName());
        $table = Config::get('database.connections.'.Config::get('database.default').'.prefix').$instance->getTable();

        // MongoDB columns are alway nullable
        if ($conn->getConfig()['driver'] === 'mongodb') {
            return true;
        }

        // register the enum, json and jsonb column type, because Doctrine doesn't support it
        $conn->getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
        $conn->getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('json', 'json_array');
        $conn->getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('jsonb', 'json_array');

        return ! $conn->getDoctrineColumn($table, $column_name)->getNotnull();
    }
}