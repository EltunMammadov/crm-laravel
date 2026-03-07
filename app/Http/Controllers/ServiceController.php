<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ServiceService;
use App\Http\Resources\MetaResource;
use App\Http\Resources\Service\ServiceResource;
use App\Http\Requests\Service\{
    CreateServiceRequest,
    UpdateServiceRequest
};
use App\Repositories\ServiceRepository;

class ServiceController extends Controller
{
    public function __construct(
        private ServiceService $serviceService
    ) {}

    public function index(Request $request)
    {
        $items = $this->serviceService->list($request);

        return response()->json([
            'success' => true,
            'message' => 'Success',
            'data' => [
                'meta' => new MetaResource($items),
                'items' => ServiceResource::collection($items)
            ]
        ], 200);
    }

    public function create(CreateServiceRequest $request)
    {
        $record = $this->serviceService->create($request);

        return response()->json([
            'success' => true,
            'message' => 'Success',
            'data' => [
                'item' => new ServiceResource($record)
            ]
        ], 201);
    }

    public function read(int $service_id)
    {
        $item = $this->serviceService->read($service_id);

        return response()->json([
            'success' => true,
            'message' => 'Success',
            'data' => [
                'item' => new ServiceResource($item)
            ]
        ], 200);
    }

    public function update(UpdateServiceRequest $request, int $service_id)
    {
        $record = $this->serviceService->update($request, $service_id);
        $item = $this->serviceService->read($service_id);

        return response()->json([
            'success' => true,
            'message' => 'Success',
            'data' => [
                'item' => new ServiceResource($item)
            ]
        ], 200);
    }

    public function delete(int $service_id)
    {
        $this->serviceService->delete($service_id);

        return response()->json([
            'success' => true,
            'message' => 'Deleted'
        ], 200);
    }
}
