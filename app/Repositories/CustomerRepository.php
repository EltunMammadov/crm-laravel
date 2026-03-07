<?php

namespace App\Repositories;

use App\Models\Customer;

class CustomerRepository 
{
    public function __construct(private Customer $model){}

    public function list($sort, $order, $limit)
    {
        return $this->model->select([
            'id',
            'fullname',
            'email',
            'phone',
            'birthdate'
        ])->orderBy($sort, $order)->paginate($limit);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function read(int $customer_id)
    {
        return $this->model->select([
            'id',
            'fullname',
            'email',
            'phone',
            'birthdate'
        ])->where('id', $customer_id)->first();
    }

    public function update(array $data, int $customer_id)
    {
        return $this->model
        ->where('id', $customer_id)
        ->update($data);
    }

    public function delete(int $customer_id)
    {
        return $this->model->where('id', $customer_id)->delete();
    }
}