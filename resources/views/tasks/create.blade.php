@extends('layouts.app', ['title' => 'Tambah Tugas'])

@section('content')
<section class="form-panel">
    <div class="form-head">
        <div>
            <p class="eyebrow">Tugas Baru</p>
            <h1>Tambah Tugas Sekolah</h1>
        </div>
    </div>

    <form method="POST" action="{{ route('tasks.store') }}">
        @csrf
        @include('tasks.partials.form', ['task' => null])
        <div class="form-actions">
            <a class="btn btn-light" href="{{ route('tasks.index') }}">Batal</a>
            <button class="btn btn-primary" type="submit">Simpan Tugas</button>
        </div>
    </form>
</section>
@endsection