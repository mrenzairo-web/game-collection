@extends('layout.user_template')

@section('content')
<div class="container-fluid py-4 px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark">User Management</h2>
            <p class="text-muted mb-0">Manage system administrators and staff accounts.</p>
        </div>
        <button class="btn px-4 py-2 fw-bold shadow-sm" style="background-color: #2b2626; color: white;" data-bs-toggle="modal" data-bs-target="#addUserModal">
            <i class="bi bi-person-plus-fill me-2"></i> Add New User
        </button>
    </div>

    @if(session('success'))
    <div class="alert alert-success border-0 shadow-sm mb-4">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
    </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background-color: #f8f9fa;">
                        <tr>
                            <th class="ps-4 py-3 text-secondary text-uppercase small">Name</th>
                            <th class="py-3 text-secondary text-uppercase small">Email</th>
                            <th class="text-center py-3 text-secondary text-uppercase small">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td class="ps-4 fw-bold text-dark">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-light text-primary border-0 me-2" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $user->id }}">
                                    <i class="bi bi-pencil-fill"></i>
                                </button>
                                <button class="btn btn-sm btn-light text-danger border-0" data-bs-toggle="modal" data-bs-target="#deleteUserModal{{ $user->id }}">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-5 text-muted">No users found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .btn:hover { color: #ffb7c5 !important; }
    .table-hover tbody tr:hover { background-color: #fdf6f7 !important; }
    .rounded-4 { border-radius: 1rem !important; }
</style>

{{-- ADD USER MODAL (Nasa labas ng loop) --}}
<div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow">
            <div class="modal-header border-0 pb-0"><h5 class="modal-title fw-bold">Add New User</h5></div>
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3"><label class="form-label small">Name</label><input type="text" name="name" class="form-control" required></div>
                    <div class="mb-3"><label class="form-label small">Email</label><input type="email" name="email" class="form-control" required></div>
                    <div class="mb-3"><label class="form-label small">Password</label><input type="password" name="password" class="form-control" required></div>
                    <div class="mb-3"><label class="form-label small">Confirm Password</label><input type="password" name="password_confirmation" class="form-control" required></div>
                </div>
                <div class="modal-footer border-0"><button type="submit" class="btn text-white w-100" style="background-color: #2b2626;">Save User</button></div>
            </form>
        </div>
    </div>
</div>

{{-- EDIT & DELETE MODALS (Nasa loob ng loop) --}}
@foreach($users as $user)
    {{-- Edit Modal --}}
    <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow">
                <div class="modal-header border-0 pb-0"><h5 class="modal-title fw-bold">Edit User</h5></div>
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3"><label class="form-label small">Name</label><input type="text" name="name" class="form-control" value="{{ $user->name }}" required></div>
                        <div class="mb-3"><label class="form-label small">Email</label><input type="email" name="email" class="form-control" value="{{ $user->email }}" required></div>
                        <hr><small class="text-muted">Fill password to change, leave blank if not.</small>
                        <div class="mb-3"><label class="form-label small">New Password</label><input type="password" name="password" class="form-control"></div>
                        <div class="mb-3"><label class="form-label small">Confirm Password</label><input type="password" name="password_confirmation" class="form-control"></div>
                    </div>
                    <div class="modal-footer border-0"><button type="submit" class="btn text-white w-100" style="background-color: #2b2626;">Update User</button></div>
                </form>
            </div>
        </div>
    </div>

    {{-- Delete Modal --}}
    <div class="modal fade" id="deleteUserModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow">
                <div class="modal-body text-center py-4">
                    <i class="bi bi-exclamation-triangle text-danger display-4"></i>
                    <p class="mt-3">Are you sure you want to delete <strong>{{ $user->name }}</strong>?</p>
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger px-4">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <style>
    /* I-force ang text na maging black/dark */
    .container-fluid, .modal-content, .table, .modal-body, .form-label, .small, p {
        color: #2b2626 !important;
    }
    
    /* Para sa mga labels at placeholder text */
    .form-label, .text-muted {
        color: #2b2626 !important;
        font-weight: 600 !important;
    }

    .btn:hover { color: #ffb7c5 !important; }
    .table-hover tbody tr:hover { background-color: #fdf6f7 !important; }
    .rounded-4 { border-radius: 1rem !important; }
</style>
@endforeach
@endsection