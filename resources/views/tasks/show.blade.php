@extends('layouts.app', ['title' => 'Detail Tugas'])

@section('content')
@php
    $statusLabel = ['belum' => 'Belum', 'proses' => 'Proses', 'selesai' => 'Selesai'][$task->status] ?? ucfirst($task->status);
@endphp

<section class="detail-panel">
    <div class="detail-head">
        <div>
            <p class="eyebrow">Detail Tugas</p>
            <h1>{{ $task->title }}</h1>
            <span class="badge status-{{ $task->status }}">{{ $statusLabel }}</span>
        </div>
        <div class="actions">
            <a class="btn btn-light" href="{{ route('tasks.edit', $task) }}">Edit</a>
            <a class="btn btn-primary" href="{{ route('tasks.index') }}">Kembali</a>
        </div>
    </div>

    <div class="detail-grid">
        <div>
            <span>Deadline</span>
            <strong>{{ optional($task->deadline)->format('d M Y') ?? '-' }}</strong>
        </div>
        <div>
            <span>Reminder</span>
            <strong>{{ $task->reminder_sent_at ? 'Sudah dikirim' : 'Belum dikirim' }}</strong>
        </div>
        <div>
            <span>Dibuat</span>
            <strong>{{ optional($task->created_at)->format('d M Y H:i') }}</strong>
        </div>
    </div>

    <article class="description-box">
        <h2>Deskripsi</h2>
        <p>{{ $task->description ?: 'Tidak ada deskripsi.' }}</p>
    </article>
</section>
@endsection