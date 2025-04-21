<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class BaseRepository
{
    public Model $model;
    public array $relationships;

    public function __construct($model, $relationships)
    {
        $this->model = $model;
        $this->relationships = $relationships;
    }

    private function executeDbTransaction($callback)
    {
        DB::beginTransaction();

        try
        {
            $result = $callback();
            DB::commit();

            return $result;
        }
        catch (\Exception $error)
        {
            DB::rollBack();
            throw new HttpException(Response::HTTP_INTERNAL_SERVER_ERROR, $error->getMessage());
        }
    }

    public function getList($query, $isPaginated)
    {
        if ($isPaginated == 'paginated')
        {
            return $this->getPaginated($query);
        }

        return $this->getUnpaginated($query);
    }

    public function getPaginated($query)
    {
        $result = $this->model->query()->with($this->relationships)->orderBy($query->orderBy, $query->sortBy)->limit($query->pageSize);

        if ($query->fields !== '*')
        {
            $mappedFields = explode(',', $query->fields);
            $result->select($mappedFields);
        }

        return $result->paginate($query->pageSize);
    }

    public function getUnpaginated($query)
    {
        $result = $this->model->query()->with($this->relationships)->orderBy($query->orderBy, $query->sortBy);

        if ($query->fields !== '*')
        {
            $mappedFields = explode(',', $query->fields);
            $result->select($mappedFields);
        }

        return $result->get();
    }

    public function create($data)
    {
        $result = $this->executeDbTransaction(
            fn () => $this->model->query()->create($data)
        );

        return $result;
    }

    public function updateById($id, $data)
    {
        $result = $this->executeDbTransaction(
            fn () => tap($this->model->query()->findOrFail($id))->update($data)
        );

        return $result;
    }

    public function getById($id)
    {
        $result = $this->model->query()->with($this->relationships)->findOrFail($id);

        return $result;
    }

    public function getByNameSlug($nameSlug)
    {
        $result = $this->model->query()->with($this->relationships)
            ->where(
                'name_slug', $nameSlug,
            )->firstOrFail();

            return $result;
    }

    public function deleteById($id)
    {
        $result = $this->executeDbTransaction(
            fn () => tap($this->model->query()->findOrFail($id))->delete()
        );

        return $result;
    }
}
