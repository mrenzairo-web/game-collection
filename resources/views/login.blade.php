@extends('layout.main')

@section('content')
<div class="d-flex align-items-center justify-content-center" style="min-height: 100vh; background-color: #ffc0cb; padding-top: 80px; padding-bottom: 50px;">
    
    <div class="bg-white p-5 shadow-sm" style="width: 100%; max-width: 400px; border: 1px solid #dee2e6; min-height: 550px;">
        
        <div class="text-center mb-5" style="margin-top: 40px;">
            <h4 style="font-weight: normal;">Log in to Cosmic Piloting Services</h4>
        </div>

        <form action="/login" method="POST">
            @csrf 
            
            <div class="mb-4">
                <input type="email" class="form-control py-2" id="email" name="email" placeholder="Email address" required>
            </div>

            <div class="mb-4">
                <input type="password" class="form-control py-2" id="password" name="password" placeholder="Password" required>
            </div>

            <div class="mb-4 form-check">
                <input type="checkbox" class="form-check-input" id="remember">
                <label class="form-check-label" for="remember">Remember email address</label>
            </div>

            <button type="submit" class="btn btn-primary w-100 mb-4 py-2">
                Login
            </button>
        </form> 
       
       
        <hr>

         <div class="text-center mt-4">
                            <span class="small text-muted">Don't have an account?</span>
                            <a href="{{ route('register') }}" class="text-primary small text-decoration-none fw-bold ms-1"> Sign up here.</a>
                        </div>
        
    </div>
</div>
@endsection