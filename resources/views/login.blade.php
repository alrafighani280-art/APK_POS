@extends('layouts.app')

@section('title', 'Login - POS')

@section('content')
<div class="d-flex justify-content-center align-items-center min-vh-100 bg-light">
    <div class="card border-0 shadow-lg p-4 rounded-4" style="width: 100%; max-width: 400px;">
        <div class="card-body">
            <!-- Header / Logo Area -->
            <div class="text-center mb-4">
                <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                    <i class="bi bi-person-lock fs-2"></i>
                </div>
                <h4 class="fw-bold mb-1">Login POS</h4>
                <p class="text-muted small">Masukan akun Anda untuk melanjutkan</p>
            </div>

            <form action="{{ route('auth') }}" method="POST">
                @csrf
                
                <!-- Email Input -->
                <div class="mb-3">
                    <label for="email" class="form-label small fw-semibold text-secondary">Alamat Email</label>
                    <input type="email" 
                           name="email" 
                           value="{{ old('email') }}"
                           class="form-control form-control-lg @error('email') is-invalid @enderror" 
                           id="email" 
                           placeholder="nama@email.com"
                           required>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Password Input -->
                <div class="mb-4">
                    <label for="password" class="form-label small fw-semibold text-secondary">Password</label>
                    <input type="password" 
                           name="password" 
                           class="form-control form-control-lg @error('password') is-invalid @enderror" 
                           id="password" 
                           placeholder="••••••••"
                           required>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary btn-lg w-100 fw-semibold shadow-sm">
                    Masuk Sekarang
                </button>
            </form>
        </div>
    </div>
</div>
@endsection