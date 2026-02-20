@extends('layouts.app')
@section('title', 'Register')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow">
            <div class="card-body p-4">
                <h4 class="mb-4 text-center">Register</h4>
                <form method="POST" action="/register">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Register</button>
                    <p class="text-center mt-3">Sudah punya akun? <a href="/login">Login</a></p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection