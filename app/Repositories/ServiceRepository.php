<?php

namespace App\Repositories;

use App\Models\Service;

class ServiceRepository
{
    public function __construct(
        private Service $model
    ) {}

    public function list($sort, $order, $limit)
    {
        return $this->model->select([
            'id',
            'title'
        ])->orderBy($sort, $order)->paginate($limit);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function read(int $service_id)
    {
        return $this->model->select([
            'id',
            'title'
        ])->where('id', $service_id)->first();
    }

    public function update(int $service_id, array $data)
    {
        return $this->model
            ->where('id', $service_id)
            ->update($data);
    }

    public function delete(int $service_id)
    {
        return $this->model->where('id', $service_id)->delete();
    }
}