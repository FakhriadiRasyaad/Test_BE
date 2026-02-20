@extends('layouts.app')
@section('title', 'Katalog Kursus')
@section('content')
<h4 class="mb-4">Katalog Kursus</h4>
<div class="row">
    @forelse($courses as $course)
    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm">
            <img src="{{ $course->thumbnail_url }}" class="card-img-top" style="height:180px;object-fit:cover;" onerror="this.src='https://via.placeholder.com/400x180'">
            <div class="card-body">
                <span class="badge bg-info mb-2">{{ $course->level }}</span>
                <h5 class="card-title">{{ $course->title }}</h5>
                <p class="card-text text-muted">{{ $course->short_description }}</p>
                <p class="card-text">
                    <strong>Rp {{ number_format($course->price, 0, ',', '.') }}</strong>
                    @if($course->discount_rate > 0)
                        <span class="badge bg-danger ms-2">{{ $course->discount_rate }}% OFF</span>
                    @endif
                </p>
            </div>
            <div class="card-footer">
                <a href="/courses/{{ $course->id }}" class="btn btn-primary btn-sm w-100">Lihat Detail</a>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <p class="text-muted">Belum ada kursus tersedia.</p>
    </div>
    @endforelse
</div>
@endsection