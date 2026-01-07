<aside class="admin-sidebar">
    <div class="admin-logo">ADMIN KPOP TIX</div>

    <nav class="admin-nav">
        <a href="{{ route('admin.dashboard') }}" class="active">Dashboard</a>
        <a href="#">Manajemen Event</a>
        <a href="#">Pesanan & Penjualan</a>
        <a href="#">Pengaturan</a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="logout-btn">Logout</button>
        </form>
    </nav>
</aside>
