@extends('layouts.app', ['title' => 'Edit Tugas'])

@section('content')
<section class="form-panel">
    <div class="form-head">
        <div>
            <p class="eyebrow">Perbarui</p>
            <h1>Edit Tugas Sekolah</h1>
        </div>
    </div>

    <form method="POST" action="{{ route('tasks.update', $task) }}">
        @csrf
        @method('PUT')
        @include('tasks.partials.form', ['task' => $task])
        <div class="form-actions">
            <a class="btn btn-light" href="{{ route('tasks.show', $task) }}">Batal</a>
            <button class="btn btn-primary" type="submit">Perbarui Tugas</button>
        </div>
    </form>
</section>
@endsection