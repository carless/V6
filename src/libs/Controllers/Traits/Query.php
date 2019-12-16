<?php
namespace Cesi\Core\libs\Controllers\Traits;

trait Query
{
    public $query = null;

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getQuery()
    {
        if ($this->query == null) {
            $this->query = $this->getModel()::query();
        }

        return $this->query;
    }

    // ----------------
    // ADVANCED QUERIES
    // ----------------

    /**
     * Add another clause to the query (for ex, a WHERE clause).
     *
     * Examples:
     * $this->crud->addClause('active');
     * $this->crud->addClause('type', 'car');
     * $this->crud->addClause('where', 'name', '==', 'car');
     * $this->crud->addClause('whereName', 'car');
     * $this->crud->addClause('whereHas', 'posts', function($query) {
     *     $query->activePosts();
     * });
     *
     * @param callable $function
     *
     * @return mixed
     */
    public function addClause($function)
    {
        return call_user_func_array([$this->getQuery(), $function], array_slice(func_get_args(), 1));
    }

    /**
     * Use eager loading to reduce the number of queries on the table view.
     *
     * @param array|string $entities
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function with($entities)
    {
        return $this->getQuery()->with($entities);
    }

    /**
     * Order the results of the query in a certain way.
     *
     * @param string $field
     * @param string $order
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function orderBy($field, $order = 'asc')
    {
        if ($this->getRequest()->has('order')) {
            return $this->getQuery();
        }

        return $this->getQuery()->orderBy($field, $order);
    }

    /**
     * Order results of the query in a custom way.
     *
     * @param  array $column           Column array with all attributes
     * @param  string $column_direction ASC or DESC
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function customOrderBy($column, $columnDirection = 'asc')
    {
        if (! isset($column['orderLogic'])) {
            return $this->getQuery();
        }

        $this->getQuery()->getQuery()->orders = null;

        $orderLogic = $column['orderLogic'];

        if (is_callable($orderLogic)) {
            return $orderLogic($this->query, $column, $columnDirection);
        }

        return $this->getQuery();
    }

    /**
     * Group the results of the query in a certain way.
     *
     * @param string $field
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function groupBy($field)
    {
        return $this->getQuery()->groupBy($field);
    }

    /**
     * Limit the number of results in the query.
     *
     * @param int $number
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function limit($number)
    {
        return $this->getQuery()->limit($number);
    }

    /**
     * Take a certain number of results from the query.
     *
     * @param int $number
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function take($number)
    {
        return $this->getQuery()->take($number);
    }

    /**
     * Start the result set from a certain number.
     *
     * @param int $number
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function skip($number)
    {
        return $this->getQuery()->skip($number);
    }

    /**
     * Count the number of results.
     * @return int
     */
    public function count()
    {
        return $this->getQuery()->count();
    }
}