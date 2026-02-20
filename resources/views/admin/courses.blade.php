@extends('layouts.app')
@section('title', 'Manage Courses')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Manage Courses</h4>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCourseModal">+ Tambah Course</button>
</div>

<div class="card shadow">
    <div class="card-body table-responsive">
        <table class="table table-hover">
            <thead><tr><th>ID</th><th>Judul</th><th>Topic</th><th>Language</th><th>Level</th><th>Harga</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($courses as $course)
                <tr>
                    <td>{{ $course->id }}</td>
                    <td>{{ $course->title }}</td>
                    <td>{{ $course->topic->name }}</td>
                    <td>{{ $course->language->name }}</td>
                    <td><span class="badge bg-info">{{ $course->level }}</span></td>
                    <td>Rp {{ number_format($course->price, 0, ',', '.') }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editCourseModal{{ $course->id }}">Edit</button>
                        <a href="/admin/courses/{{ $course->id }}/delete" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</a>
                    </td>
                </tr>
                <!-- Edit Modal -->
                <div class="modal fade" id="editCourseModal{{ $course->id }}" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header"><h5 class="modal-title">Edit Course</h5></div>
                            <form method="POST" action="/admin/courses/{{ $course->id }}/update">
                                @csrf
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Judul</label>
                                            <input type="text" name="title" class="form-control" value="{{ $course->title }}" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Short Description</label>
                                            <input type="text" name="short_description" class="form-control" value="{{ $course->short_description }}" required>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">Deskripsi</label>
                                            <textarea name="description" class="form-control" rows="3">{{ $course->description }}</textarea>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Topic</label>
                                            <select name="topic_id" class="form-select">
                                                @foreach($topics as $topic)
                                                <option value="{{ $topic->id }}" {{ $course->topic_id == $topic->id ? 'selected' : '' }}>{{ $topic->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Language</label>
                                            <select name="language_id" class="form-select">
                                                @foreach($languages as $language)
                                                <option value="{{ $language->id }}" {{ $course->language_id == $language->id ? 'selected' : '' }}>{{ $language->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Harga</label>
                                            <input type="number" name="price" class="form-control" value="{{ $course->price }}" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Diskon (%)</label>
                                            <input type="number" name="discount_rate" class="form-control" value="{{ $course->discount_rate }}" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Level</label>
                                            <select name="level" class="form-select">
                                                @foreach(['ALL LEVEL','BEGINNER','INTERMEDIATE','ADVANCE'] as $level)
                                                <option value="{{ $level }}" {{ $course->level == $level ? 'selected' : '' }}>{{ $level }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">Thumbnail URL</label>
                                            <input type="text" name="thumbnail_url" class="form-control" value="{{ $course->thumbnail_url }}" required>
                                        </div>
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
                <tr><td colspan="7" class="text-center text-muted">Belum ada course.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addCourseModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header"><h5 class="modal-title">Tambah Course</h5></div>
            <form method="POST" action="/admin/courses">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Judul</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Short Description</label>
                            <input type="text" name="short_description" class="form-control" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Topic</label>
                            <select name="topic_id" class="form-select">
                                @foreach($topics as $topic)
                                <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Language</label>
                            <select name="language_id" class="form-select">
                                @foreach($languages as $language)
                                <option value="{{ $language->id }}">{{ $language->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Harga</label>
                            <input type="number" name="price" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Diskon (%)</label>
                            <input type="number" name="discount_rate" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Level</label>
                            <select name="level" class="form-select">
                                @foreach(['ALL LEVEL','BEGINNER','INTERMEDIATE','ADVANCE'] as $level)
                                <option value="{{ $level }}">{{ $level }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Thumbnail URL</label>
                            <input type="text" name="thumbnail_url" class="form-control" required>
                        </div>
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