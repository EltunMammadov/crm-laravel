<?php

namespace App\Http\Resources\Todo;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Customer\CustomerResource;
use App\Http\Resources\Service\ServiceResource;

class TodoDetailedResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'customer' => new CustomerResource($this->customer),
            'service' => new ServiceResource($this->service),
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => $this->status,
            'description' => $this->description
        ];
    }
}
