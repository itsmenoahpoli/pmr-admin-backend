<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\BaseRepository;

class PaymentsRepository extends BaseRepository
{
    public function __construct(
        Model $model,
        array $relationships = []
    )
    {
        parent::__construct($model, $relationships);
    }

    public function create($data)
    {
        $data['uid'] = strtoupper('PYMNT'.time());

        return parent::create($data);
    }
}
