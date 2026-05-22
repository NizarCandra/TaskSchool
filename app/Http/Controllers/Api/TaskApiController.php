<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\SendTaskReminder;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskApiController extends Controller
{
    public function index(): JsonResponse
    {
        return $this->success('Data tugas berhasil diambil.', Task::latest()->get());
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['nullable', 'in:belum,proses,selesai'],
            'deadline' => ['nullable', 'date'],
        ]);

        $task = Task::create(array_merge(['status' => 'belum'], $data));
        SendTaskReminder::dispatch($task->id);

        return $this->success('Tugas berhasil dibuat.', $task, 201);
    }

    public function show(Task $task): JsonResponse
    {
        return $this->success('Detail tugas berhasil diambil.', $task);
    }

    public function update(Request $request, Task $task): JsonResponse
    {
        $data = $request->validate([
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['sometimes', 'required', 'in:belum,proses,selesai'],
            'deadline' => ['nullable', 'date'],
        ]);

        $task->update($data);

        return $this->success('Tugas berhasil diperbarui.', $task);
    }

    public function destroy(Task $task): JsonResponse
    {
        $task->delete();

        return $this->success('Tugas berhasil dihapus.');
    }

    private function success(string $message, mixed $data = null, int $status = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $status);
    }
}
