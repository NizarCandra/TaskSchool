<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
            ]
        );

        $tasks = [
            [
                'title' => 'Mengerjakan PR Matematika',
                'description' => 'Kerjakan soal latihan bab persamaan linear.',
                'status' => 'belum',
                'deadline' => now()->addDays(2)->toDateString(),
            ],
            [
                'title' => 'Membuat rangkuman Bahasa Indonesia',
                'description' => 'Rangkum materi teks eksplanasi minimal satu halaman.',
                'status' => 'proses',
                'deadline' => now()->addDays(4)->toDateString(),
            ],
            [
                'title' => 'Upload laporan praktikum RPL',
                'description' => 'Lengkapi dokumentasi Laravel 13 dan screenshot hasil project.',
                'status' => 'selesai',
                'deadline' => now()->addDay()->toDateString(),
            ],
        ];

        foreach ($tasks as $task) {
            Task::updateOrCreate(
                ['title' => $task['title']],
                array_merge($task, ['user_id' => $user->id])
            );
        }
    }
}