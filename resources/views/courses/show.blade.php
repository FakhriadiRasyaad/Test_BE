@extends('layouts.app')
@section('title', $course->title)
@section('content')
<div class="row">
    <div class="col-md-8">
        <img src="{{ $course->thumbnail_url }}" class="img-fluid rounded mb-3" style="max-height:300px;width:100%;object-fit:cover;" onerror="this.src='https://via.placeholder.com/800x300'">
        <h3>{{ $course->title }}</h3>
        <p class="text-muted">{{ $course->short_description }}</p>
        <hr>
        <p>{{ $course->description }}</p>
    </div>
    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-body">
                <h5>Detail Kursus</h5>
                <ul class="list-unstyled">
                    <li><strong>Level:</strong> {{ $course->level }}</li>
                    <li><strong>Bahasa:</strong> {{ $course->language->name }}</li>
                    <li><strong>Topik:</strong> {{ $course->topic->name }}</li>
                    <li><strong>Harga:</strong> Rp {{ number_format($course->price, 0, ',', '.') }}</li>
                    @if($course->discount_rate > 0)
                    <li><strong>Diskon:</strong> {{ $course->discount_rate }}%</li>
                    @endif
                </ul>
                <a href="/" class="btn btn-secondary w-100">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection