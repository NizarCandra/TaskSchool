<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'TaskSchool' }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header class="app-header">
        <div class="app-shell header-inner">
            <a class="brand" href="{{ route('tasks.index') }}">
                <span class="brand-mark">TS</span>
                <span>
                    <strong>TaskSchool</strong>
                    <small>Manajemen Tugas Sekolah</small>
                </span>
            </a>
            <nav class="top-nav">
                <a href="{{ route('tasks.index') }}">Daftar</a>
                <a class="btn btn-primary" href="{{ route('tasks.create') }}">Tambah Tugas</a>
            </nav>
        </div>
    </header>

    <main class="app-shell page">
        @if (session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        @yield('content')
    </main>
</body>
</html>