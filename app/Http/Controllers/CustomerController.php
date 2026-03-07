<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CustomerService;
use App\Services\TodoService;
use App\Http\Resources\Customer\CustomerResource;
use App\Http\Resources\MetaResource;
use App\Http\Requests\{
    CreateCustomerRequest,
    UpdateCustomerRequest
};

class CustomerController extends Controller
{
    public function __construct(
        private CustomerService $customerService,
        private TodoService $todoService
    ){}

    public function index(Request $request) 
    {
        $items = $this->customerService->list($request);

        return response()->json([
            'data' => [
                'meta' => new MetaResource($items),
                'items' => CustomerResource::collection($items)
            ]
        ], 200);
    }

    public function create(CreateCustomerRequest $request) 
    {
        $user = $this->customerService->create($request);

        if (!$user) {
            return response() -> json([
                'success' => false,
                'message' => 'Bad request'
            ], 400);
        }

        return response() -> json([
            'success' => true,
            'message' => 'Success',
            'data' => [
                'item' => new CustomerResource($user)
            ]
        ], 201);
    }

    public function read(int $customer_id) 
    {
        $item = $this->customerService->read($customer_id);

        return response()->json([
            'success' => true,
            'message' => 'Success',
            'data' => [
                'item' => new CustomerResource($item)
            ]
        ], 200);
    }

    public function update(UpdateCustomerRequest $request ,int $customer_id)
    {
        $this->customerService->update($request, $customer_id);

        $item = $this->customerService->read($customer_id);

        return response()->json([
            'success' => true,
            'message' => 'Updated',
            'data' => [
                'item' => new CustomerResource($item)
            ]
        ],200);
    }

    public function delete(int $customer_id)
    {
        $this->customerService->delete($customer_id);

        $this->todoService->deleteWhere(['customer_id' => $customer_id]);

        return response()->json([
            'success' => true,
            'message' => 'Deleted'
        ], 200);
    }
}
