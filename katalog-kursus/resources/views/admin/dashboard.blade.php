@extends('layouts.app')
@section('title', 'Dashboard Admin')
@section('content')
<h4 class="mb-4">Dashboard Admin</h4>
<div class="row">
    <div class="col-md-4 mb-3">
        <div class="card bg-primary text-white shadow">
            <div class="card-body text-center">
                <h2>{{ $totalCourses }}</h2>
                <p class="mb-0">Total Courses</p>
                <a href="/admin/courses" class="btn btn-light btn-sm mt-2">Kelola</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card bg-success text-white shadow">
            <div class="card-body text-center">
                <h2>{{ $totalTopics }}</h2>
                <p class="mb-0">Total Topics</p>
                <a href="/admin/topics" class="btn btn-light btn-sm mt-2">Kelola</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card bg-warning text-white shadow">
            <div class="card-body text-center">
                <h2>{{ $totalLanguages }}</h2>
                <p class="mb-0">Total Languages</p>
                <a href="/admin/languages" class="btn btn-light btn-sm mt-2">Kelola</a>
            </div>
        </div>
    </div>
</div>
@endsection