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
    
    // --- KODE MANAJEMEN PESANAN ---

    // --- DATA MOCK (CONTOH DATA) ---
    let mockOrders = [
        {
            id: 'KPOP1001',
            name: 'Aisha Fatimah',
            email: 'aisha@example.com',
            phone: '081234567890',
            event: "IVE 'AFTER PARTY WITH DIVE'",
            tickets: [
                { category: 'VIP Standing', qty: 1, price: 3500000 },
                { category: 'CAT 1 Seating', qty: 1, price: 2800000 }
            ],
            totalPrice: 6300000,
            status: 'Paid',
            orderDate: '2025-11-15T10:30:00Z'
        },
        {
            id: 'KPOP1E02',
            name: 'Budi Santoso',
            email: 'budi.s@example.com',
            phone: '081222223333',
            event: "RIIZE 'RIIZING DAY'",
            tickets: [
                { category: 'CAT 1', qty: 2, price: 2500000 }
            ],
            totalPrice: 5000000,
            status: 'Pending',
            orderDate: '2025-11-14T14:45:00Z'
        },
        {
            id: 'KPOP1003',
            name: 'Citra Lestari',
            email: 'citra.lestari@example.com',
            phone: '081555554444',
            event: "DAY6 'FOREVER YOUNG' (3RD WORLD TOUR)'",
            tickets: [
                { category: 'GA Standing', qty: 1, price: 1800000 }
            ],
            totalPrice: 1800000,
            status: 'Failed',
            orderDate: '2025-11-13T09:12:00Z'
        },
        {
            id: 'KPOP1004',
            name: 'David Lee',
            email: 'david.lee@example.com',
            phone: '081987654321',
            event: "BABYMONSTER 'HELLO MONSTERS'",
            tickets: [
                { category: 'CAT 2 Seating', qty: 4, price: 2200000 }
            ],
            totalPrice: 8800000,
            status: 'Paid',
            orderDate: '2025-11-15T11:05:00Z'
        }
    ];

    // --- ELEMEN DOM ---
    const tableBody = document.getElementById('ordersTableBody');
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const exportCsvBtn = document.getElementById('exportCsvBtn');

    // Elemen Modal Detail
    const detailModal = document.getElementById('detailModal');
    const closeDetailModal = document.getElementById('closeDetailModal');
    const detailModalContent = document.getElementById('detailModalContent');

    // Elemen Modal Edit
    const editModal = document.getElementById('editModal');
    const closeEditModal = document.getElementById('closeEditModal');
    const cancelEditBtn = document.getElementById('cancelEditBtn');
    const editOrderId = document.getElementById('editOrderId');
    const editStatusSelect = document.getElementById('editStatusSelect');
    const saveStatusBtn = document.getElementById('saveStatusBtn');

    // --- FUNGSI ---

    // Fungsi untuk format mata uang Rupiah
    const formatCurrency = (amount) => {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(amount);
    };

    // Fungsi untuk mendapatkan badge status
    const getStatusBadge = (status) => {
        switch (status) {
            case 'Paid':
                return `<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">${status}</span>`;
            case 'Pending':
                return `<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">${status}</span>`;
            case 'Failed':
                return `<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">${status}</span>`;
            default:
                return `<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">${status}</span>`;
        }
    };

    // Fungsi untuk merender tabel
    const renderTable = (orders) => {
        if (!tableBody) return;

        tableBody.innerHTML = ''; // Kosongkan tabel
        if (orders.length === 0) {
            tableBody.innerHTML = `<tr><td colspan="6" class="text-center text-gray-500 py-10">Tidak ada data ditemukan.</td></tr>`;
            return;
        }

        orders.forEach(order => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">${order.id}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">${order.name}</div>
                    <div class="text-sm text-gray-500">${order.email}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">${order.event}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">${formatCurrency(order.totalPrice)}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    ${getStatusBadge(order.status)}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                    <button data-id="${order.id}" class="view-detail-btn text-blue-600 hover:text-blue-900">Detail</button>
                    <button data-id="${order.id}" class="edit-status-btn text-indigo-600 hover:text-indigo-900">Edit Status</button>
                </td>
            `;
            tableBody.appendChild(row);
        });
    };

    // Fungsi untuk filter dan render
    const filterAndRender = () => {
        if (!searchInput || !statusFilter) return;

        const searchTerm = searchInput.value.toLowerCase();
        const status = statusFilter.value;

        const filteredOrders = mockOrders.filter(order => {
            const matchesSearch = (
                order.id.toLowerCase().includes(searchTerm) ||
                order.name.toLowerCase().includes(searchTerm) ||
                order.email.toLowerCase().includes(searchTerm)
            );
            const matchesStatus = (status === 'all' || order.status === status);
            return matchesSearch && matchesStatus;
        });

        renderTable(filteredOrders);
    };

    // --- FUNGSI MODAL ---

    const openModal = (modal) => {
        if (!modal) return;
        modal.classList.remove('opacity-0', 'pointer-events-none');
        const content = modal.querySelector('.modal-content');
        if (content) {
            content.classList.remove('-translate-y-10');
        }
    };

    const closeModal = (modal) => {
        if (!modal) return;
        modal.classList.add('opacity-0', 'pointer-events-none');
        const content = modal.querySelector('.modal-content');
        if (content) {
            content.classList.add('-translate-y-10');
        }
    };

    const openDetailModal = (orderId) => {
        const order = mockOrders.find(o => o.id === orderId);
        if (!order || !detailModalContent) return;

        let ticketsHtml = order.tickets.map(ticket => `
            <li class="flex justify-between items-center">
                <span>${ticket.qty}x ${ticket.category}</span>
                <span class="font-medium">${formatCurrency(ticket.price * ticket.qty)}</span>
            </li>
        `).join('');

        detailModalContent.innerHTML = `
            <div class="grid grid-cols-3 gap-x-4 gap-y-2">
                <span class="font-medium text-gray-500">Order ID</span>
                <span class="col-span-2 text-gray-900 font-semibold">${order.id}</span>
                
                <span class="font-medium text-gray-500">Tanggal</span>
                <span class="col-span-2 text-gray-900">${new Date(order.orderDate).toLocaleString('id-ID')}</span>
                
                <span class="font-medium text-gray-500">Nama</span>
                <span class="col-span-2 text-gray-900">${order.name}</span>
                
                <span class="font-medium text-gray-500">Email</span>
                <span class="col-span-2 text-gray-900">${order.email}</span>
                
                <span class="font-medium text-gray-500">Telepon</span>
                <span class="col-span-2 text-gray-900">${order.phone}</span>
                
                <span class="font-medium text-gray-500">Event</span>
                <span class="col-span-2 text-gray-900">${order.event}</span>
            </div>
            <hr class="my-4">
            <h4 class="font-semibold text-gray-800 mb-2">Rincian Tiket</h4>
            <ul class="space-y-2 list-disc list-inside text-gray-700">
                ${ticketsHtml}
            </ul>
            <hr class="my-4">
            <div class="flex justify-between items-center text-lg">
                <span class="font-bold text-gray-900">Total Bayar</span>
                <span class="font-bold text-blue-600">${formatCurrency(order.totalPrice)}</span>
            </div>
            <div class="mt-4">
                <span class="font-medium text-gray-500">Status</span>
                <div class="mt-1">${getStatusBadge(order.status)}</div>
            </div>
        `;
        openModal(detailModal);
    };

    const openEditModal = (orderId) => {
        const order = mockOrders.find(o => o.id === orderId);
        if (!order || !editOrderId || !editStatusSelect) return;

        editOrderId.value = order.id;
        editStatusSelect.value = order.status;
        openModal(editModal);
    };

    const saveStatus = () => {
        if (!editOrderId || !editStatusSelect) return;
        
        const orderId = editOrderId.value;
        const newStatus = editStatusSelect.value;
        
        const orderIndex = mockOrders.findIndex(o => o.id === orderId);
        if (orderIndex > -1) {
            mockOrders[orderIndex].status = newStatus;
        }

        closeModal(editModal);
        filterAndRender(); 
    };

    // --- FUNGSI EXPORT CSV ---
    const exportToCsv = () => {
        const headers = ['OrderID', 'Nama', 'Email', 'Telepon', 'Event', 'Kategori Tiket', 'Jumlah', 'Total Harga', 'Status', 'Tanggal Pesan'];
        
        let csvContent = "data:text/csv;charset=utf-8," + headers.join(",") + "\r\n";

        mockOrders.forEach(order => {
            order.tickets.forEach(ticket => {
                const row = [
                    order.id,
                    `"${order.name}"`,
                    order.email,
                    order.phone,
                    `"${order.event}"`,
                    `"${ticket.category}"`,
                    ticket.qty,
                    order.totalPrice, 
                    order.status,
                    new Date(order.orderDate).toLocaleString('id-ID')
                ];
                csvContent += row.join(",") + "\r\n";
            });
        });

        const encodedUri = encodeURI(csvContent);
        const link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", "laporan_penjualan_tiket.csv");
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    };


    // --- EVENT LISTENERS ---
    if (searchInput) {
        searchInput.addEventListener('input', filterAndRender);
    }
    if (statusFilter) {
        statusFilter.addEventListener('change', filterAndRender);
    }
    if (exportCsvBtn) {
        exportCsvBtn.addEventListener('click', exportToCsv);
    }

    if (tableBody) {
        tableBody.addEventListener('click', (e) => {
            if (e.target.classList.contains('view-detail-btn')) {
                openDetailModal(e.target.dataset.id);
            }
            if (e.target.classList.contains('edit-status-btn')) {
                openEditModal(e.target.dataset.id);
            }
        });
    }

    if (closeDetailModal) {
        closeDetailModal.addEventListener('click', () => closeModal(detailModal));
    }
    if (closeEditModal) {
        closeEditModal.addEventListener('click', () => closeModal(editModal));
    }
    if (cancelEditBtn) {
        cancelEditBtn.addEventListener('click', () => closeModal(editModal));
    }
    
    if (detailModal) {
        detailModal.addEventListener('click', (e) => {
            if (e.target === detailModal) closeModal(detailModal);
        });
    }
    if (editModal) {
        editModal.addEventListener('click', (e) => {
            if (e.target === editModal) closeModal(editModal);
        });
    }

    if (saveStatusBtn) {
        saveStatusBtn.addEventListener('click', saveStatus);
    }

    // --- INISIASI ---
    renderTable(mockOrders);
});