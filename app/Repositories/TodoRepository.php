<?php

namespace App\Repositories;

use App\Models\Todo;

class TodoRepository
{
    public function __construct(
        private Todo $model
    ) {}

    public function list($sort, $order, $limit)
    {
        return $this->model->select([
            'id',
            'start_date',
            'end_date',
            'status',
            'description',
            'customer_id',
            'service_id'
        ])->with([
            'customer',
            'service'
        ])->orderBy($sort, $order)->paginate($limit);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function read(int $todo_id)
    {
        return $this->model->select([
            'id',
            'start_date',
            'end_date',
            'status',
            'description',
            'customer_id',
            'service_id'
        ])->with([
            'customer',
            'service'
        ])->where('id', $todo_id)->first();
    }

    public function update(int $todo_id, array $data)
    {
        return $this->model
            ->where('id', $todo_id)
            ->update($data);
    }

    public function delete(int $todo_id)
    {
        return $this->model->where('id', $todo_id)->delete();
    }

    public function deleteWhere(array $where)
    {
        return $this->model->where($where)->delete();
    }
}