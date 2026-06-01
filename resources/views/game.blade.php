@extends('layout.user_template')

@section('content')
<main class="col-md-9 col-lg-10 px-md-4 py-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center pb-2 mb-4">
        <div>
            <h1 class="h3 fw-bold text-dark m-0">Game Collection</h1>
            <p class="text-secondary small mb-0">Manage your game library, platform categories, and release schedules.</p>
        </div>
        <button class="btn btn-dark fw-semibold" data-bs-toggle="modal" data-bs-target="#addGameModal">
            <i class="bi bi-plus-lg me-1"></i> Add New Game
        </button>
    </div>

    {{-- SUCCESS ALERT --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- CARDS GRID --}}
    <div class="row g-3">
        @forelse($games as $game)
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card h-100 border shadow-sm">
                {{-- COVER IMAGE --}}
                @if($game->image)
                    <img src="{{ asset('storage/' . $game->image) }}"
                         class="card-img-top"
                         alt="{{ $game->title }}"
                         style="height:160px; object-fit:cover;">
                @else
                    <div class="bg-light d-flex align-items-center justify-content-center"
                         style="height:160px;">
                        <div class="text-center text-secondary">
                            <i class="bi bi-controller fs-2 d-block"></i>
                            <small>No Image</small>
                        </div>
                    </div>
                @endif

                <div class="card-body d-flex flex-column pb-2">
                    <h6 class="fw-bold text-dark mb-1">{{ $game->title }}</h6>
                    <span class="badge bg-dark text-white mb-2" style="width:fit-content">{{ $game->category }}</span>
                    <p class="text-dark small mb-1">
                        <i class="bi bi-calendar3 me-1"></i>
                        {{ \Carbon\Carbon::parse($game->release_date)->format('M d, Y') }}
                    </p>
                    <p class="text-dark small mb-0">
                        <i class="bi bi-person me-1"></i>
                        {{ $game->developer }}
                    </p>
                </div>

                <div class="card-footer bg-white border-top d-flex gap-2 pt-2 pb-2">
                    <button class="btn btn-sm btn-outline-secondary flex-fill"
                            onclick="openEditModal({{ json_encode($game) }})">
                        <i class="bi bi-pencil"></i> Edit
                    </button>
                    <form action="{{ route('games.destroy', $game->id) }}" method="POST" class="flex-fill">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger w-100"
                                onclick="return confirm('Delete this game?')">
                            <i class="bi bi-trash"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5 text-secondary">
            <i class="bi bi-controller fs-1 d-block mb-2"></i>
            No games found in your collection yet.
        </div>
        @endforelse
    </div>

</main>

Nakikita ko ang issue — nawala ang mga label ng form fields kasi text-muted sila at puti ang modal background. Palitan ng text-dark:
blade{{-- ADD GAME MODAL --}}
<div class="modal fade" id="addGameModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('games.store') }}" method="POST" class="modal-content" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Add New Game</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-dark">Game Title</label>
                    <input type="text" name="title" class="form-control" placeholder="e.g. The Legend of Zelda" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-dark">Category / Platform</label>
                    <input type="text" name="category" class="form-control" placeholder="e.g. RPG, PC, PlayStation" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-dark">Release Date</label>
                    <input type="date" name="release_date" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-dark">Developer</label>
                    <input type="text" name="developer" class="form-control" placeholder="e.g. Nintendo" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-dark">Cover Image <span class="text-secondary fw-normal">(optional)</span></label>
                    <input type="file" name="image" id="add_image" class="form-control" accept="image/*" onchange="previewImage(this, 'add_preview')">
                    <img id="add_preview" src="" alt="preview" class="mt-2 rounded d-none" style="width:100%;max-height:140px;object-fit:cover;">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-dark">Save Game</button>
            </div>
        </form>
    </div>
</div>

{{-- EDIT GAME MODAL --}}
<div class="modal fade" id="editGameModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="editGameForm" method="POST" class="modal-content" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Edit Game Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-dark">Game Title</label>
                    <input type="text" name="title" id="edit_title" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-dark">Category / Platform</label>
                    <input type="text" name="category" id="edit_category" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-dark">Release Date</label>
                    <input type="date" name="release_date" id="edit_release_date" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-dark">Developer</label>
                    <input type="text" name="developer" id="edit_developer" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-dark">Cover Image <span class="text-secondary fw-normal">(leave blank to keep current)</span></label>
                    <input type="file" name="image" id="edit_image" class="form-control" accept="image/*" onchange="previewImage(this, 'edit_preview')">
                    <img id="edit_preview" src="" alt="preview" class="mt-2 rounded d-none" style="width:100%;max-height:140px;object-fit:cover;">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-dark">Update Game</button>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function openEditModal(game) {
        document.getElementById('edit_title').value = game.title;
        document.getElementById('edit_category').value = game.category;
        document.getElementById('edit_release_date').value = game.release_date;
        document.getElementById('edit_developer').value = game.developer;

        const preview = document.getElementById('edit_preview');
        if (game.image) {
            preview.src = '/storage/' + game.image;
            preview.classList.remove('d-none');
        } else {
            preview.classList.add('d-none');
        }

        document.getElementById('editGameForm').action = `/games/${game.id}`;
        new bootstrap.Modal(document.getElementById('editGameModal')).show();
    }
</script>

@endsection