<?php

namespace App\Repositories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

use App\Repositories\BaseRepository;

class PatientHmoProvidersRepository extends BaseRepository
{
    public function __construct(
        Model $model,
        array $relationships = []
    )
    {
        parent::__construct($model, $relationships);
    }

    public function updateById($id, $data)
    {
        $data['name'] = strtoupper($data['name']);
        $data['name_slug'] = Str::slug($data['name']);
        $data['is_enabled'] = isset($data['is_enabled']) && $data['is_enabled'] ? true : false;

        return parent::updateById($id, $data);
    }
}
