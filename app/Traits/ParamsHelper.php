<?php

namespace App\Traits;

trait ParamsHelper
{
    public function createPaginationParams($query)
    {
        return (object) [
            'paginated' => isset($query['paginated']) ? filter_var($query['paginated'], FILTER_VALIDATE_BOOLEAN) : false,
            'pageSize'  => isset($query['pageSize']) ? intval($query['pageSize']) : 25,
            'orderBy'   => isset($query['orderBy']) ? $query['orderBy'] : 'id',
            'sortBy'    => isset($query['sortBy']) ? $query['sortBy'] : 'desc',
            'search'    => isset($query['search']) ? $query['search'] : null,
            'fields'    => isset($query['fields']) ? $query['fields'] : '*',
        ];
    }
}
