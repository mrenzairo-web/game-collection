<nav class="navbar navbar-expand-lg" style="background-color: #2b2626;">
    <div class="container-fluid px-4">
        <a class="navbar-brand text-white fw-bold d-flex align-items-center gap-2" href="#">
            🌸 MikaGameVault 🌸
        </a>

        <div class="d-flex">
            <ul class="navbar-nav flex-row gap-3">
                <li class="nav-item">
                    <a class="nav-link text-white {{ Route::is('dashboard') ? 'fw-bold border-bottom' : '' }}" href="{{ route('dashboard') }}">
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ Route::is('users.index') ? 'fw-bold border-bottom' : '' }}" href="{{ route('users.index') }}">
                        User
                    </a>
                </li>
                <li class="nav-item">
<a class="nav-link text-white {{ Route::is('game.index') ? 'fw-bold border-bottom' : '' }}" href="{{ route('game.index') }}">
                        Game Collection
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ Route::is('profile.edit') ? 'fw-bold border-bottom' : '' }}" href="{{ route('profile.edit') }}">
                        Profile
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    .nav-link:hover {
        color: #ffb7c5 !important;
    }
    
    .border-bottom {
        border-bottom: 2px solid #ffb7c5 !important;
    }
</style>