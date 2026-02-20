@extends('layouts.app')
@section('title', 'Manage Languages')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Manage Languages</h4>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addLanguageModal">+ Tambah Language</button>
</div>

<div class="card shadow">
    <div class="card-body">
        <table class="table table-hover">
            <thead><tr><th>ID</th><th>Nama</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($languages as $language)
                <tr>
                    <td>{{ $language->id }}</td>
                    <td>{{ $language->name }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editLanguageModal{{ $language->id }}">Edit</button>
                        <a href="/admin/languages/{{ $language->id }}/delete" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</a>
                    </td>
                </tr>
                <!-- Edit Modal -->
                <div class="modal fade" id="editLanguageModal{{ $language->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header"><h5 class="modal-title">Edit Language</h5></div>
                            <form method="POST" action="/admin/languages/{{ $language->id }}/update">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Nama</label>
                                        <input type="text" name="name" class="form-control" value="{{ $language->name }}" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <tr><td colspan="3" class="text-center text-muted">Belum ada language.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addLanguageModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"><h5 class="modal-title">Tambah Language</h5></div>
            <form method="POST" action="/admin/languages">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection