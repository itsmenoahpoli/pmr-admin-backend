<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

use App\Repositories\BaseRepository;

class StaffsRepository extends BaseRepository
{
    public function __construct(
        Model $model,
        array $relationships = []
    )
    {
        parent::__construct($model, $relationships);
    }
}
