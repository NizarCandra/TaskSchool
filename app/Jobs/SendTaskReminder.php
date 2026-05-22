<?php

namespace App\Jobs;

use App\Models\Task;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class SendTaskReminder implements ShouldQueue
{
    use Queueable;

    public function __construct(public int $taskId)
    {
    }

    public function handle(): void
    {
        $task = Task::find($this->taskId);

        if (! $task) {
            return;
        }

        Log::info('Reminder tugas dikirim.', [
            'task_id' => $task->id,
            'title' => $task->title,
            'deadline' => optional($task->deadline)->toDateString(),
        ]);

        $task->forceFill([
            'reminder_sent_at' => now(),
        ])->save();
    }
}
