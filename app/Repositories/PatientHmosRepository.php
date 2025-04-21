<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\BaseRepository;

class PatientHmosRepository extends BaseRepository
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
        $data['hmo_dependents'] = json_encode($data['hmo_dependents']);

        return parent::create($data);
    }

    public function getById($id)
    {
        $result = parent::getById($id);
        $result->hmo_dependents = json_decode($result->hmo_dependents);

        return $result;
    }
}
