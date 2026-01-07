document.addEventListener('DOMContentLoaded', () => {

    // --- SCRIPT UNTUK SIDEBAR TOGGLE ---
    const mobileMenuButton = document.getElementById('mobileMenuButton');
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');

    const toggleSidebar = () => {
        sidebar.classList.toggle('-translate-x-full');
        sidebarOverlay.classList.toggle('hidden');
    };

    if (mobileMenuButton) {
        mobileMenuButton.addEventListener('click', toggleSidebar);
    }
    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', toggleSidebar);
    }
    
    // --- TODO: Tambahkan JavaScript khusus untuk halaman pengaturan di sini ---
    // (Misalnya: logika untuk menambah/menghapus slider, validasi form, dll.)
    console.log("Halaman Pengaturan Website dimuat.");

});