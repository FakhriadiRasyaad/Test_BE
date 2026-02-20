@extends('layouts.app')
@section('title', 'Manage Topics')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Manage Topics</h4>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTopicModal">+ Tambah Topic</button>
</div>

<div class="card shadow">
    <div class="card-body">
        <table class="table table-hover">
            <thead><tr><th>ID</th><th>Nama</th><th>Deskripsi</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($topics as $topic)
                <tr>
                    <td>{{ $topic->id }}</td>
                    <td>{{ $topic->name }}</td>
                    <td>{{ $topic->description }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editTopicModal{{ $topic->id }}">Edit</button>
                        <a href="/admin/topics/{{ $topic->id }}/delete" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</a>
                    </td>
                </tr>
                <!-- Edit Modal -->
                <div class="modal fade" id="editTopicModal{{ $topic->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header"><h5 class="modal-title">Edit Topic</h5></div>
                            <form method="POST" action="/admin/topics/{{ $topic->id }}/update">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Nama</label>
                                        <input type="text" name="name" class="form-control" value="{{ $topic->name }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Deskripsi</label>
                                        <textarea name="description" class="form-control">{{ $topic->description }}</textarea>
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
                <tr><td colspan="4" class="text-center text-muted">Belum ada topic.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addTopicModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"><h5 class="modal-title">Tambah Topic</h5></div>
            <form method="POST" action="/admin/topics">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description" class="form-control"></textarea>
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