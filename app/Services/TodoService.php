<?php

namespace App\Services;

use App\Repositories\TodoRepository;
use Illuminate\Http\Request;

class TodoService
{
    public function __construct(
        private TodoRepository $todoRepository
    ) {}

    public function list(Request $request)
    {
        $sort = $request->input('sort', 'id');
        $order = $request->input('order', 'desc');
        $limit = $request->input('limit', 10);

        return $this->todoRepository->list($sort, $order, $limit);
    }

    public function create(Request $request)
    {
        return $this->todoRepository->create($request->all());
    }

    public function read(int $todo_id)
    {
        return $this->todoRepository->read($todo_id);
    }

    public function update(Request $request, int $todo_id)
    {
        return $this->todoRepository->update($todo_id, $request->all());
    }

    public function delete(int $todo_id)
    {
        return $this->todoRepository->delete($todo_id);
    }

    public function deleteWhere(array $where)
    {
        return $this->todoRepository->deleteWhere($where);
    }
}