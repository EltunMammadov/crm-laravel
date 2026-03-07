<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Todo\CreateTodoRequest;
use App\Http\Requests\Todo\UpdateTodoRequest;
use App\Http\Resources\MetaResource;
use App\Services\TodoService;
use App\Http\Resources\Todo\TodoDetailedResource;
use App\Http\Resources\Todo\TodoResource;

class TodoController extends Controller
{
    public function __construct(
        private TodoService $todoService
    ) {}

    public function index(Request $request)
    {
        $items = $this->todoService->list($request);

        return response()->json([
            'success' => true,
            'data' => [
                'meta' => new MetaResource($items),
                'items' => TodoDetailedResource::collection($items)
            ]
        ], 200);
    }

    public function create(CreateTodoRequest $request)
    {
        $record = $this->todoService->create($request);

        return response()->json([
            'success' => true,
            'data' => [
                'item' => new TodoDetailedResource($record)
            ]
        ], 201);
    }

    public function read(int $todo_id)
    {
        $item = $this->todoService->read($todo_id);

        return response()->json([
            'success' => true,
            'data' => [
                'item' => new TodoDetailedResource($item)
            ]
        ], 200);
    }

    public function edit(int $todo_id)
    {
        $item = $this->todoService->read($todo_id);

        return response()->json([
            'success' => true,
            'data' => [
                'item' => new TodoResource($item)
            ]
        ], 200);
    }

    public function update(UpdateTodoRequest $request, int $todo_id)
    {
        $this->todoService->update($request, $todo_id);

        $item = $this->todoService->read($todo_id);

        return response()->json([
            'success' => true,
            'data' => [
                'item' => new TodoResource($item)
            ]
        ], 200);
    }

    public function delete(int $todo_id)
    {
        $this->todoService->delete($todo_id);
        
        return response()->json([
            'success' => true,
            'message' => 'Deleted'
        ], 200);
    }
}
