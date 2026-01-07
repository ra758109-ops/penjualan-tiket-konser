<x-layout-admin>

    <style>
        :root {
            --primary-color: #9333ea;
            --secondary-color: #f3f4f6;
            --dark-color: #1f2937;
            --light-text: #ffffff;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --info-color: #3b82f6;
        }

        body {
            background: var(--secondary-color);
            font-family: 'Poppins', sans-serif;
        }

        .admin-main {
            padding: 30px;
        }

        .admin-header h1 {
            font-size: 28px;
            margin-bottom: 5px;
        }

        .admin-header p {
            color: #6b7280;
            margin-bottom: 30px;
        }

        /* SUMMARY CARDS */
        .summary-cards {
            display: flex;
            gap: 20px;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }

        .card {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 6px 15px rgba(0,0,0,.08);
            flex: 1;
            min-width: 250px;
            border-left: 6px solid var(--primary-color);
        }

        .card h3 {
            font-size: 15px;
            color: #4b5563;
            margin-bottom: 10px;
        }

        .figure {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .indicator {
            font-size: 12px;
            padding: 4px 8px;
            border-radius: 6px;
            font-weight: 600;
            display: inline-block;
        }

        .indicator.success {
            background: #d1fae5;
            color: var(--success-color);
        }

        .indicator.warning {
            background: #fef3c7;
            color: var(--warning-color);
        }

        .indicator.info {
            background: #dbeafe;
            color: var(--info-color);
        }

        /* TABLE */
        .recent-activity {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 6px 15px rgba(0,0,0,.08);
        }

        .recent-activity h2 {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            background: var(--secondary-color);
            padding: 12px;
            text-align: left;
        }

        tbody td {
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
        }

        .status {
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
        }

        .status.paid {
            background: var(--success-color);
            color: white;
        }

        .status.pending {
            background: var(--warning-color);
            color: #1f2937;
        }
    </style>

    <main class="admin-main">

        <header class="admin-header">
            <h1>Dashboard Ringkasan</h1>
            <p>Selamat datang, Admin!</p>
        </header>

        <section class="summary-cards">

            <div class="card">
                <h3>Total Penjualan Bulan Ini</h3>
                <p class="figure">Rp 45.750.000</p>
                <span class="indicator success">📈 +15% dari bulan lalu</span>
            </div>

            <div class="card">
                <h3>Event Akan Datang</h3>
                <p class="figure">12 Event</p>
                <span class="indicator info">📅 2 Event dalam 7 hari</span>
            </div>

            <div class="card">
                <h3>Tiket Terjual Hari Ini</h3>
                <p class="figure">345 Tiket</p>
                <span class="indicator warning">⚠ 3 Event hampir habis</span>
            </div>

        </section>

        <section class="recent-activity">
            <h2>Aktivitas Terbaru</h2>

            <table>
                <thead>
                    <tr>
                        <th>ID Pesanan</th>
                        <th>Event</th>
                        <th>Total Bayar</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#10045</td>
                        <td>NCT DREAM: THE DREAM SHOW 3</td>
                        <td>Rp 3.500.000</td>
                        <td><span class="status paid">Lunas</span></td>
                    </tr>
                    <tr>
                        <td>#10044</td>
                        <td>SEVENTEEN: THE CARAT LAND FESTIVAL</td>
                        <td>Rp 4.200.000</td>
                        <td><span class="status pending">Menunggu Bayar</span></td>
                    </tr>
                    <tr>
                        <td>#10043</td>
                        <td>IVE: AFTER PARTY WITH DIVE</td>
                        <td>Rp 980.000</td>
                        <td><span class="status paid">Lunas</span></td>
                    </tr>
                </tbody>
            </table>
        </section>

    </main>

</x-layout-admin>
