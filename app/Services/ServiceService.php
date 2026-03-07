<?php

namespace App\Services;

use App\Repositories\ServiceRepository;
use Illuminate\Http\Request;

class ServiceService
{
    public function __construct(
        private ServiceRepository $serviceRepository
    ) {}

    public function list(Request $request)
    {
        $sort = $request->input('sort', 'id');
        $order = $request->input('order', 'desc');
        $limit = $request->input('limit', 10);

        return $this->serviceRepository->list($sort, $order, $limit);
    }

    public function create(Request $request)
    {
        return $this->serviceRepository->create($request->all());
    }

    public function read(int $service_id)
    {
        return $this->serviceRepository->read($service_id);
    }

    public function update(Request $request, int $service_id)
    {
        return $this->serviceRepository->update($service_id,$request->all());
    }

    public function delete(int $service_id)
    {
        return $this->serviceRepository->delete($service_id);
    }
}