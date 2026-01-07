// Tunggu hingga seluruh konten HTML dimuat
document.addEventListener('DOMContentLoaded', function() {
    
    // === 1. PENGATURAN MODAL (BUKA/TUTUP) ===

    const eventModal = document.getElementById('eventModal');
    const tambahEventBtn = document.getElementById('tambahEventBtn');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const batalBtn = document.getElementById('batalBtn');
    const modalTitle = document.getElementById('modalTitle');

    // Fungsi untuk membuka modal
    function openModal(mode = 'add', data = null) {
        if (mode === 'add') {
            modalTitle.textContent = 'Tambah Event Baru';
            document.getElementById('eventForm').reset(); // Bersihkan form
            document.getElementById('imagePreview').style.display = 'none'; // Sembunyikan preview
        } else if (mode === 'edit') {
            modalTitle.textContent = 'Edit Event';
            // (Simulasi) Isi form dengan data yang ada
            // document.getElementById('eventName').value = data.name;
            // ... (isi field lainnya)
            console.log('Mode Edit (data):', data);
        }
        eventModal.style.display = 'flex';
    }

    // Fungsi untuk menutup modal
    function closeModal() {
        eventModal.style.display = 'none';
    }

    // Event listener untuk tombol-tombol
    tambahEventBtn.addEventListener('click', () => openModal('add'));
    closeModalBtn.addEventListener('click', closeModal);
    batalBtn.addEventListener('click', closeModal);

    // Tutup modal jika klik di luar area modal (di overlay)
    window.addEventListener('click', function(event) {
        if (event.target === eventModal) {
            closeModal();
        }
    });

    // === 2. FORM PREVIEW GAMBAR ===

    const eventImageInput = document.getElementById('eventImage');
    const imagePreview = document.getElementById('imagePreview');

    eventImageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            imagePreview.style.display = 'none';
        }
    });

    // === 3. KATEGORI TIKET DINAMIS ===

    const tambahKategoriBtn = document.getElementById('tambahKategoriBtn');
    const kategoriTiketList = document.getElementById('kategoriTiketList');

    tambahKategoriBtn.addEventListener('click', function() {
        const newTierItem = document.createElement('div');
        newTierItem.className = 'ticket-tier-item';
        
        newTierItem.innerHTML = `
            <input type="text" placeholder="Nama Kategori" class="tier-name" required>
            <input type="number" placeholder="Harga" class="tier-price" required>
            <input type="number" placeholder="Kuota" class="tier-quota" required>
            <button type="button" class="btn-icon btn-remove-tier" title="Hapus Kategori">&times;</button>
        `;
        
        kategoriTiketList.appendChild(newTierItem);
    });

    // Event delegation untuk tombol hapus kategori
    kategoriTiketList.addEventListener('click', function(event) {
        if (event.target.classList.contains('btn-remove-tier')) {
            // Hapus elemen .ticket-tier-item yang merupakan parent dari tombol
            event.target.closest('.ticket-tier-item').remove();
        }
    });

    // === 4. SUBMIT FORM (SIMULASI) ===

    const eventForm = document.getElementById('eventForm');
    const eventTableBody = document.getElementById('eventTableBody');

    eventForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Mencegah form submit (reload halaman)

        // 1. Kumpulkan data dari form
        const eventName = document.getElementById('eventName').value;
        const eventDateRaw = new Date(document.getElementById('eventDate').value);
        const eventLocation = document.getElementById('eventLocation').value;
        
        // Format tanggal (contoh sederhana)
        const eventDate = eventDateRaw.toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });

        // 2. Kumpulkan data kategori tiket
        const tiers = [];
        let totalQuota = 0;
        kategoriTiketList.querySelectorAll('.ticket-tier-item').forEach(item => {
            const quota = parseInt(item.querySelector('.tier-quota').value, 10) || 0;
            totalQuota += quota;
            
            tiers.push({
                name: item.querySelector('.tier-name').value,
                price: item.querySelector('.tier-price').value,
                quota: quota,
            });
        });

        console.log('Event Baru Disimpan:', {
            name: eventName,
            date: eventDate,
            location: eventLocation,
            totalQuota: totalQuota,
            tiers: tiers
        });

        // 3. (Simulasi) Tambahkan baris baru ke tabel
        const newRow = eventTableBody.insertRow(0); // insert di paling atas
        newRow.innerHTML = `
            <td>
                <div class="event-cell">
                    <img src="${imagePreview.src.startsWith('http') ? 'https://placehold.co/80x45/E1E8FF/7380B0?text=New' : imagePreview.src}" alt="Event Image" class="table-img">
                    <span>${eventName}</span>
                </div>
            </td>
            <td>${eventDate}</td>
            <td>${eventLocation}</td>
            <td><span class="status-badge status-upcoming">Akan Datang</span></td>
            <td>0 / ${totalQuota}</td>
            <td>
                <button class="btn-icon btn-edit" title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></button>
                <button class="btn-icon btn-delete" title="Hapus"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button>
            </td>
        `;

        // 4. Tutup modal dan bersihkan form
        closeModal();
    });

    // === 5. (Simulasi) Tombol Edit/Delete di Tabel ===
    // Menggunakan event delegation untuk tombol yang ada di tabel
    eventTableBody.addEventListener('click', function(event) {
        const button = event.target.closest('.btn-icon');
        if (!button) return;

        const row = button.closest('tr');
        
        if (button.classList.contains('btn-edit')) {
            // (Simulasi) Ambil data dari baris dan buka modal
            const eventName = row.cells[0].querySelector('span').textContent;
            console.log('Edit event:', eventName);
            // Di aplikasi nyata, Anda akan mengambil ID event dan memuat datanya dari server
            openModal('edit', { name: eventName });
        }
        
        if (button.classList.contains('btn-delete')) {
            // (Simulasi) Hapus baris dari tabel
            if (confirm(`Yakin ingin menghapus event "${row.cells[0].querySelector('span').textContent}"?`)) {
                row.remove();
            }
        }
    });

});