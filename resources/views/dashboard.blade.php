@extends('layout.user_template')

@section('content')
<div class="container-fluid p-4" style="background-color: #f8f9fa; min-height: 100vh;">
    
    <h2 class="mb-4 fw-bold text-dark">Game Collection Dashboard</h2>

    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card p-4 border-0 shadow-sm text-center">
                <h6 class="text-secondary text-uppercase small fw-bold">Total Games</h6>
                <h3 class="fw-bold text-dark mt-2">5</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-4 border-0 shadow-sm text-center">
                <h6 class="text-secondary text-uppercase small fw-bold">Active Players</h6>
                <h3 class="fw-bold text-primary mt-2">5</h3>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 pt-4 pb-0">
            <h5 class="mb-0 fw-bold text-dark">Recently Added Games</h5>
        </div>
        <div class="card-body p-4">
            <table class="table table-hover align-middle">
                <thead class="text-muted small">
                    <tr>
                        <th>GAME TITLE</th>
                        <th>CATEGORY</th>
                        <th>STATUS</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody class="text-dark">
                    <tr>
                        <td class="fw-bold">Elden Ring</td>
                        <td>RPG</td>
                        <td><span class="badge bg-success px-3 py-2">Available</span></td>
                        <td><button class="btn btn-sm btn-outline-primary px-3">View</button></td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Valorant</td>
                        <td>FPS</td>
                        <td><span class="badge bg-warning text-dark px-3 py-2">Maintenance</span></td>
                        <td><button class="btn btn-sm btn-outline-primary px-3">View</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection