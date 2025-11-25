<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Tour - Tour Admin Panel</title>
    <link rel="stylesheet" href="../output.css?v=<?php echo time(); ?>">
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
                        <a href="tourmanage.php" class="flex items-center gap-2.5 p-3 rounded-lg bg-palette-3 w-full">
                            <i data-lucide="map-pin" class="w-5 h-5"></i>
                            <span>TOUR MANAGE</span>
                        </a>
                    </li>
                    <li>
                        <a href="orderlist.php" class="flex items-center gap-2.5 p-3 rounded-lg w-full">
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

    <main class="flex-1 p-4 overflow-auto h-146">
        <div class="flex items-center gap-4 mb-6">
            <a href="tourmanage.php" class="flex items-center gap-2 text-palette-4 hover:text-palette-3 transition-all duration-300">
                <i data-lucide="arrow-left" class="w-5 h-5"></i>
                <span>Back to Tour Manage</span>
            </a>
        </div>

        <div class="max-w-4xl mx-auto">
            <header class="mb-8">
                <h1 class="text-4xl font-black">ADD NEW TOUR</h1>
                <p class="text-xl mt-2">TAMBAH WISATA BARU</p>
            </header>

            <div class="card p-6">
                <form class="space-y-6">
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="text-sm font-semibold mb-2 flex items-center gap-2">
                                <i data-lucide="hash" class="w-4 h-4"></i>
                                ID Wisata
                            </label>
                            <input type="text" class="w-full border border-palette-3 rounded-lg px-4 py-3 focus:border-palette-4 bg-gray-100" disabled>
                        </div>
                        <div>
                            <label class="text-sm font-semibold mb-2 flex items-center gap-2">
                                <i data-lucide="tag" class="w-4 h-4"></i>
                                Kategori
                            </label>
                            <input type="text" class="w-full border border-palette-3 rounded-lg px-4 py-3 focus:border-palette-4" placeholder="Masukkan kategori wisata">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="text-sm font-semibold mb-2 flex items-center gap-2">
                                <i data-lucide="map-pin" class="w-4 h-4"></i>
                                Nama Wisata
                            </label>
                            <input type="text" class="w-full border border-palette-3 rounded-lg px-4 py-3 focus:border-palette-4" placeholder="Masukkan nama wisata">
                        </div>
                        <div>
                            <label class="text-sm font-semibold mb-2 flex items-center gap-2">
                                <i data-lucide="navigation" class="w-4 h-4"></i>
                                Lokasi
                            </label>
                            <input type="text" class="w-full border border-palette-3 rounded-lg px-4 py-3 focus:border-palette-4" placeholder="Masukkan lokasi wisata">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="text-sm font-semibold mb-2 flex items-center gap-2">
                                <i data-lucide="dollar-sign" class="w-4 h-4"></i>
                                Harga
                            </label>
                            <input type="number" class="w-full border border-palette-3 rounded-lg px-4 py-3 focus:border-palette-4" placeholder="Masukkan harga">
                        </div>
                        <div>
                            <label class="text-sm font-semibold mb-2 flex items-center gap-2">
                                <i data-lucide="activity" class="w-4 h-4"></i>
                                Status
                            </label>
                            <select class="w-full border border-palette-3 rounded-lg px-4 py-3 focus:border-palette-4">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="flex gap-4 pt-4">
                        <a href="tourmanage.php" class="bg-gray-400 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-500 transition-all duration-300 text-center flex-1 flex items-center justify-center gap-2">
                            <i data-lucide="x" class="w-5 h-5"></i>
                            Cancel
                        </a>
                        <button type="button" class="bg-palette-3 text-white px-6 py-3 rounded-lg font-semibold hover:bg-palette-4 transition-all duration-300 flex items-center gap-2 justify-center flex-1">
                            <i data-lucide="save" class="w-5 h-5"></i>
                            Save Tour
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