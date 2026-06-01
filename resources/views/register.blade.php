@extends('layout.main')

@section('content')
<!-- Pink background para sa buong page -->
<div class="d-flex align-items-center justify-content-center py-5" style="min-height: 100vh; background-color: #ffc0cb;">
    
    <!-- White card container -->
    <div class="bg-white p-4 shadow-sm" style="width: 100%; max-width: 450px;">
        
        <div class="text-center mb-4">
            <h2 class="fw-bold">Create an Account</h2>
            <p class="text-muted">From beginner to endgame — we've got you.</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success small">{{ session('success') }}</div>
        @endif

        <form action="/register" method="POST">
            @csrf 
            
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <!-- Inalis ko muna yung phone field base sa image_e46bcd.png -->

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="terms" required>
                <label class="form-check-label" for="terms">Agree to terms and conditions</label>
            </div>

            <button type="submit" class="btn btn-primary w-100">
                Submit
            </button>
             <div class="text-center mt-4">
                            <span class="small text-muted">Don't have an account?</span>
                            <a href="{{ route('login') }}" class="text-primary small text-decoration-none fw-bold ms-1">Login</a>
                        </div>
        </form> 
        
    </div>
</div>
@endsection