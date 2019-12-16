<?php
namespace Cesi\Core\libs\Controllers\Traits;

trait AutoSet
{
    // ------------------------------------------------------
    // AUTO-SET-FIELDS-AND-COLUMNS FUNCTIONALITY
    // ------------------------------------------------------
    public $labeller = false;
    public $db_column_types = [];

    /**
     * Turn a database column name or PHP variable into a pretty label to be shown to the user.
     *
     * @param  string $value The value.
     *
     * @return string The transformed value.
     */
    public function makeLabel($value)
    {
        if ($this->labeller) {
            return ($this->labeller)($value);
        }

        return trim(preg_replace('/(id|at|\[\])$/i', '', mb_ucfirst(str_replace('_', ' ', $value))));
    }

    /**
     * Alias to the makeLabel method.
     */
    public function getLabel($value)
    {
        return $this->makeLabel($value);
    }

    /**
     * Change the way labels are made.
     *
     * @param callable $labeller A function that receives a string and returns the formatted string, after stripping down useless characters.
     *
     * @return self
     */
    public function setLabeller(callable $labeller)
    {
        $this->labeller = $labeller;

        return $this;
    }


    /**
     * Get all columns in the database table.
     *
     * @return array
     */
    public function getDbTableColumns()
    {
        if (isset($this->table_columns) && $this->table_columns) {
            return $this->table_columns;
        }

        $conn = $this->getModel()->getConnection();
        $table = $conn->getTablePrefix().$this->getModel()->getTable();
        $columns = $conn->getDoctrineSchemaManager()->listTableColumns($table);

        $this->table_columns = $columns;

        return $this->table_columns;
    }

    /**
     * Intuit a field type, judging from the database column type.
     *
     * @param  string $field Field name.
     *
     * @return string Field type.
     */
    public function getFieldTypeFromDbColumnType($field)
    {
        if (! array_key_exists($field, $this->db_column_types)) {
            return 'text';
        }

        if ($field == 'password') {
            return 'password';
        }

        if ($field == 'email') {
            return 'email';
        }

        switch ($this->db_column_types[$field]['type']) {
            case 'int':
            case 'integer':
            case 'smallint':
            case 'mediumint':
            case 'longint':
                return 'number';
                break;

            case 'string':
            case 'varchar':
            case 'set':
                return 'text';
                break;

            // case 'enum':
            //     return 'enum';
            // break;

            case 'tinyint':
                return 'active';
                break;

            case 'text':
            case 'mediumtext':
            case 'longtext':
                return 'textarea';
                break;

            case 'date':
                return 'date';
                break;

            case 'datetime':
            case 'timestamp':
                return 'datetime';
                break;

            case 'time':
                return 'time';
                break;

            default:
                return 'text';
                break;
        }
    }
}