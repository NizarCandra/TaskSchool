@extends('layouts.app', ['title' => 'Daftar Tugas'])

@section('content')
<section class="page-head">
    <div>
        <p class="eyebrow">Dashboard</p>
        <h1>Daftar Tugas Sekolah</h1>
        <p class="muted">Kelola tugas, status pengerjaan, dan deadline dari satu halaman.</p>
    </div>
</section>

<section class="stats-grid" aria-label="Ringkasan tugas">
    <article class="stat-card stat-total">
        <span>Total</span>
        <strong>{{ $summary['total'] }}</strong>
    </article>
    <article class="stat-card stat-waiting">
        <span>Belum</span>
        <strong>{{ $summary['belum'] }}</strong>
    </article>
    <article class="stat-card stat-progress">
        <span>Proses</span>
        <strong>{{ $summary['proses'] }}</strong>
    </article>
    <article class="stat-card stat-done">
        <span>Selesai</span>
        <strong>{{ $summary['selesai'] }}</strong>
    </article>
</section>

<section class="data-panel">
    <div class="panel-head">
        <div>
            <h2>Tugas Terbaru</h2>
            <p class="muted">Deadline terdekat tampil di atas, tugas selesai otomatis di bawah.</p>
        </div>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Status</th>
                    <th>Deadline</th>
                    <th>Reminder</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tasks as $task)
                    @php
                        $statusLabel = ['belum' => 'Belum', 'proses' => 'Proses', 'selesai' => 'Selesai'][$task->status] ?? ucfirst($task->status);
                    @endphp
                    <tr>
                        <td>
                            <strong>{{ $task->title }}</strong>
                            <span>{{ Str::limit($task->description ?: 'Tidak ada deskripsi.', 72) }}</span>
                        </td>
                        <td><span class="badge status-{{ $task->status }}">{{ $statusLabel }}</span></td>
                        <td>{{ optional($task->deadline)->format('d M Y') ?? '-' }}</td>
                        <td>{{ $task->reminder_sent_at ? 'Terkirim' : 'Belum' }}</td>
                        <td>
                            <div class="actions">
                                <a class="btn btn-light" href="{{ route('tasks.show', $task) }}">Detail</a>
                                <a class="btn btn-light" href="{{ route('tasks.edit', $task) }}">Edit</a>
                                <form method="POST" action="{{ route('tasks.destroy', $task) }}" onsubmit="return confirm('Hapus tugas ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="empty-state">Belum ada tugas. Tambahkan tugas pertama untuk mulai.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-wrap">{{ $tasks->links() }}</div>
</section>
@endsection