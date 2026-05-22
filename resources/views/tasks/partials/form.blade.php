<div class="form-grid">
    <div class="form-field field-full">
        <label for="title">Judul Tugas</label>
        <input id="title" name="title" value="{{ old('title', $task->title ?? '') }}" placeholder="Contoh: Mengerjakan PR Matematika" required>
        @error('title') <small class="error-text">{{ $message }}</small> @enderror
    </div>

    <div class="form-field field-full">
        <label for="description">Deskripsi</label>
        <textarea id="description" name="description" rows="5" placeholder="Tulis detail tugas yang perlu dikerjakan">{{ old('description', $task->description ?? '') }}</textarea>
        @error('description') <small class="error-text">{{ $message }}</small> @enderror
    </div>

    <div class="form-field">
        <label for="status">Status</label>
        <select id="status" name="status" required>
            @foreach (['belum' => 'Belum', 'proses' => 'Proses', 'selesai' => 'Selesai'] as $value => $label)
                <option value="{{ $value }}" @selected(old('status', $task->status ?? 'belum') === $value)>{{ $label }}</option>
            @endforeach
        </select>
        @error('status') <small class="error-text">{{ $message }}</small> @enderror
    </div>

    <div class="form-field">
        <label for="deadline">Deadline</label>
        <input type="date" id="deadline" name="deadline" value="{{ old('deadline', optional($task->deadline ?? null)->format('Y-m-d')) }}">
        @error('deadline') <small class="error-text">{{ $message }}</small> @enderror
    </div>
</div>