@extends('layout.user_template')

@section('content')

<main class="col-md-9 col-lg-10 px-md-4 py-4">

    <div class="row g-4">

        {{-- LEFT COLUMN: Profile Info & Logout --}}
        <div class="col-12 col-lg-4">
            {{-- Profile Card --}}
            <div class="card shadow-sm border-0 p-4 text-center mb-4">
                <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : 'https://via.placeholder.com/150' }}" 
                    class="rounded-circle mb-3 mx-auto" 
                    id="profilePreview"
                    style="width: 120px; height: 120px; object-fit: cover; border: 4px solid #f8f9fa;">
                
                <h4 class="fw-bold mb-1">{{ $user->name }}</h4>
                <p class="text-muted mb-2">System Administrator</p>
                
                <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 mb-4 w-50 mx-auto rounded-pill">Active Account</span>


                
            </div>

            {{-- Logout Card --}}
            <div class="card shadow-sm border-0 p-4">
                </h5>
                
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger w-100">Logout Now</button>
                </form>
            </div>
        </div>

        {{-- RIGHT COLUMN: Profile Details --}}
        <div class="col-12 col-lg-8">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                
                <div class="card shadow-sm border-0 p-4">
                    <h3 class="fw-bold mb-1">Profile Details</h3>
                    <p class="text-muted mb-4">View and keep your internal personal registration details updated.</p>

                    {{-- File Upload --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted">Change Profile Picture</label>
                        <input type="file" name="profile_picture" class="form-control" id="avatarInput" accept="image/*">
                    </div>

                    {{-- Full Name --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted">Full Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                    </div>

                    {{-- Email --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-muted">Email Address</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                    </div>

                    <hr class="my-3">

                    <h4 class="fw-bold mb-3">Security & Password</h4>
                    
                    {{-- Password Fields --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted">New Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold text-muted">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <button type="reset" class="btn btn-outline-secondary px-4">Reset Fields</button>
                        <button type="submit" class="btn btn-primary px-4">Save Profile changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

{{-- Script for Live Preview --}}
<script>
    document.getElementById('avatarInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('profilePreview').src = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>

@endsection