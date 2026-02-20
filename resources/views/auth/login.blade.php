@extends('layouts.app')
@section('title', 'Login')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow">
            <div class="card-body p-4">
                <h4 class="mb-4 text-center">Login</h4>
                <form method="POST" action="/login">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                    <p class="text-center mt-3">Belum punya akun? <a href="/register">Register</a></p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection