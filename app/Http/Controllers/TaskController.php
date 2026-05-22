<?php

namespace App\Http\Controllers;

use App\Jobs\SendTaskReminder;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function index(): View
    {
        return view('tasks.index', [
            'tasks' => Task::query()
                ->orderByRaw("CASE WHEN status = 'selesai' THEN 1 ELSE 0 END")
                ->orderByRaw("CASE WHEN deadline IS NULL THEN 1 ELSE 0 END")
                ->orderBy('deadline')
                ->latest()
                ->paginate(10),
            'summary' => [
                'total' => Task::count(),
                'belum' => Task::where('status', 'belum')->count(),
                'proses' => Task::where('status', 'proses')->count(),
                'selesai' => Task::where('status', 'selesai')->count(),
            ],
        ]);
    }

    public function create(): View
    {
        return view('tasks.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $task = Task::create($this->validatedData($request));

        SendTaskReminder::dispatch($task->id);

        return redirect()->route('tasks.index')->with('success', 'Tugas berhasil ditambahkan.');
    }

    public function show(Task $task): View
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task): View
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task): RedirectResponse
    {
        $task->update($this->validatedData($request));

        return redirect()->route('tasks.index')->with('success', 'Tugas berhasil diperbarui.');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Tugas berhasil dihapus.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:belum,proses,selesai'],
            'deadline' => ['nullable', 'date'],
        ]);
    }
}
