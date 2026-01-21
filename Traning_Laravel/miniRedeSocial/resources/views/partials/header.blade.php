<!-- Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <span id="site_name">
        <a href="{{ route('dashboard') }}">
            <strong>CRUD Book</strong>
        </a>
    </span>
    <div class="d-flex align-items-center gap-2">
        <span>Olá, <strong>{{ Auth::user()->first_name ?? 'Usuário' }}</strong></span>
        <a class="icon-btn" href="{{ route('user.index') }}"><i class="bi bi-person-circle"></i></a>
        <a class="icon-btn" href="{{ route('login.logout') }}"><i class="bi bi-box-arrow-right"></i></a>
    </div>
</div>