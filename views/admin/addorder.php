<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Order - Tour Admin Panel</title>
    <link rel="stylesheet" href="../../output.css?v=<?php echo time(); ?>">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
</head>
<body class="flex h-100 bg-palette-1">
    <!-- Sidebar -->
    <aside class="w-50 bg-palette-4 text-white flex flex-col p-4 h-146">
        <div>
            <div class="text-2xl font-black mb-2">TOUR ADMIN</div>
            <div class="text-sm font-semibold mb-8">ADMINISTRATION PANEL</div>
            
            <nav class="mt-6">
                <ul class="flex flex-col gap-2.5">
                    <li>
                        <a href="adminpanel.php" class="flex items-center gap-2.5 p-3 rounded-lg w-full">
                            <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                            <span>DASHBOARD</span>
                        </a>
                    </li>
                    <li>
                        <a href="tourmanage.php" class="flex items-center gap-2.5 p-3 rounded-lg w-full">
                            <i data-lucide="map-pin" class="w-5 h-5"></i>
                            <span>TOUR MANAGE</span>
                        </a>
                    </li>
                    <li>
                        <a href="orderlist.php" class="flex items-center gap-2.5 p-3 rounded-lg bg-palette-3 w-full">
                            <i data-lucide="list-check" class="w-5 h-5"></i>
                            <span>ORDER LIST</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        
        <div class="mt-auto">
            <div class="flex items-center gap-2.5 mb-4">
                <div class="w-10 h-10 rounded-full bg-palette-3 flex items-center justify-center">
                    <i data-lucide="user" class="w-5 h-5"></i>
                </div>
                <span>ADMIN USN</span>
            </div>
            <a href="index.php" class="flex items-center gap-2.5 p-3 rounded-lg w-full bg-red-800 text-white hover:bg-white hover:text-black transition-all duration-300">
                <i data-lucide="log-out" class="w-5 h-5"></i>
                <span>LOGOUT</span>
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-4 overflow-auto h-146">

        <!-- Add Order Form -->
        <div class="max-w-4xl mx-auto">
            <header class="mb-8">
                <h1 class="text-4xl font-black flex items-center gap-3">
                    ADD NEW ORDER
                </h1>
                <p class="text-xl mt-2 flex items-center gap-2">
                    TAMBAH PESANAN BARU
                </p>
            </header>

            <div class="card p-6">
                <form class="space-y-6">
                    <!-- Order Information -->
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="text-sm font-semibold mb-2 flex items-center gap-2">
                                <i data-lucide="hash" class="w-4 h-4"></i>
                                ORDER ID
                            </label>
                            <div class="relative">
                                <input type="text" class="w-full border border-palette-3 rounded-lg px-4 py-3 focus:border-palette-4 bg-gray-100" disabled>
                            </div>
                        </div>
                        <div>
                            <label class="text-sm font-semibold mb-2 flex items-center gap-2">
                                <i data-lucide="calendar" class="w-4 h-4"></i>
                                Tanggal Pesan
                            </label>
                            <div class="relative">
                                <input type="date" class="w-full border border-palette-3 rounded-lg px-4 py-3 focus:border-palette-4">
                                <i data-lucide="calendar-days" class="w-4 h-4 absolute right-3 top-3.5 text-gray-500"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Customer Information -->
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="text-sm font-semibold mb-2 flex items-center gap-2">
                                <i data-lucide="user" class="w-4 h-4"></i>
                                Nama Pelanggan
                            </label>
                            <div class="relative">
                                <input type="text" class="w-full border border-palette-3 rounded-lg px-4 py-3 focus:border-palette-4" placeholder="Masukkan nama pelanggan">
                                <i data-lucide="user-round" class="w-4 h-4 absolute right-3 top-3.5 text-gray-500"></i>
                            </div>
                        </div>
                        <div>
                            <label class="text-sm font-semibold mb-2 flex items-center gap-2">
                                <i data-lucide="mail" class="w-4 h-4"></i>
                                Email Pelanggan
                            </label>
                            <div class="relative">
                                <input type="email" class="w-full border border-palette-3 rounded-lg px-4 py-3 focus:border-palette-4" placeholder="Masukkan email pelanggan">
                                <i data-lucide="at-sign" class="w-4 h-4 absolute right-3 top-3.5 text-gray-500"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Tour Information -->
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="text-sm font-semibold mb-2 flex items-center gap-2">
                                <i data-lucide="map-pin" class="w-4 h-4"></i>
                                Nama Wisata
                            </label>
                            <div class="relative">
                                <select class="w-full border border-palette-3 rounded-lg px-4 py-3 focus:border-palette-4 appearance-none">
                                    <option value="">Pilih Wisata</option>
                                    <option value="bali">...</option>
                                </select>
                                <i data-lucide="chevron-down" class="w-4 h-4 absolute right-3 top-3.5 text-gray-500 pointer-events-none"></i>
                            </div>
                        </div>
                        <div>
                            <label class="text-sm font-semibold mb-2 flex items-center gap-2">
                                <i data-lucide="navigation" class="w-4 h-4"></i>
                                Lokasi
                            </label>
                            <div class="relative">
                                <input type="text" class="w-full border border-palette-3 rounded-lg px-4 py-3 focus:border-palette-4 bg-gray-100" placeholder="Lokasi wisata" disabled>
                                <i data-lucide="map-pinned" class="w-4 h-4 absolute right-3 top-3.5 text-gray-500"></i>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="text-sm font-semibold mb-2 flex items-center gap-2">
                                <i data-lucide="dollar-sign" class="w-4 h-4"></i>
                                Harga
                            </label>
                            <div class="relative">
                                <input type="text" class="w-full border border-palette-3 rounded-lg px-4 py-3 focus:border-palette-4 bg-gray-100" placeholder="Harga wisata" disabled>
                                <i data-lucide="credit-card" class="w-4 h-4 absolute right-3 top-3.5 text-gray-500"></i>
                            </div>
                        </div>
                        <div>
                            <label class="text-sm font-semibold mb-2 flex items-center gap-2">
                                <i data-lucide="activity" class="w-4 h-4"></i>
                                Status
                            </label>
                            <div class="relative">
                                <select class="w-full border border-palette-3 rounded-lg px-4 py-3 focus:border-palette-4 appearance-none">
                                    <option value="active">Active</option>
                                    <option value="pending">Pending</option>
                                    <option value="completed">Completed</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                                <i data-lucide="chevron-down" class="w-4 h-4 absolute right-3 top-3.5 text-gray-500 pointer-events-none"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-4 pt-4">
                        <a href="orderlist.php" class="bg-gray-400 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-500 transition-all duration-300 text-center flex-1 flex items-center justify-center gap-2">
                            <i data-lucide="x" class="w-5 h-5"></i>
                            Cancel
                        </a>
                        <button type="submit" class="bg-palette-3 text-white px-6 py-3 rounded-lg font-semibold hover:bg-palette-4 transition-all duration-300 flex items-center gap-2 justify-center flex-1">
                            <i data-lucide="save" class="w-5 h-5"></i>
                            Save Order
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>