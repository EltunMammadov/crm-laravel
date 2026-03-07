<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\{
    Customer,
    Service
};

class Todo extends Model
{
    use SoftDeletes;

    protected $table = 'todos';

    protected $fillable = [
        'customer_id',
        'service_id',
        'start_date',
        'end_date',
        'status',
        'description'
    ];

    public function customer()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }

    public function service()
    {
        return $this->hasOne(Service::class, 'id', 'service_id');
    }
}
