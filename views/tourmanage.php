<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Admin Panel - Tour Manage</title>
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
        <div>
            <header class="mb-8">
                <h1 class="text-4xl font-black">TOUR MANAGE</h1>
                <p class="text-xl mt-2">KELOLA DESTINASI DAN PAKET WISATA ANDA</p>
            </header>

            <div class="flex justify-between mb-4">
                <a href="addtour.php" class="bg-palette-3 text-white px-4 py-3 rounded-lg font-semibold flex items-center gap-2 hover:bg-white hover:text-black transition-all duration-300">
                    <i data-lucide="plus" class="w-5 h-5"></i>
                    ADD NEW TOUR
                </a>
                <div class="flex items-center gap-2">
                    <input type="text" placeholder="Search tours..." class="border border-palette-3 rounded-lg px-4 py-3 w-150 focus:border-palette-4">
                    <button class="bg-palette-4 text-white px-4 py-3 rounded-lg hover:bg-white hover:text-black transition-all duration-300">
                        <i data-lucide="search" class="w-5 h-5"></i>
                    </button>
                </div>
            </div>

            <div class="card p-4">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-palette-3">
                                <th class="text-left py-3 px-4">ID WISATA</th>
                                <th class="text-left py-3 px-4">KATEGORI</th>
                                <th class="text-left py-3 px-4">NAMA WISATA</th>
                                <th class="text-left py-3 px-4">LOKASI</th>
                                <th class="text-left py-3 px-4">HARGA</th>
                                <th class="text-left py-3 px-4">STATUS</th>
                                <th class="text-left py-3 px-4">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-palette-3">
                                <td class="py-3 px-4">1</td>
                                <td class="py-3 px-4">bla bla</td>
                                <td class="py-3 px-4">waheiajdiowa</td>
                                <td class="py-3 px-4">leawhidjiuwa</td>
                                <td class="py-3 px-4">Rp. 1234</td>
                                <td class="py-3 px-4">
                                    <span class="bg-palette-3 text-white px-2 py-1 rounded-lg text-sm">Active</span>
                                </td>
                                <td class="py-3 px-4 flex gap-2">
                                    <button class="text-palette-4 hover:text-palette-3 transition-all duration-300">
                                        <i data-lucide="edit" class="w-4 h-4"></i>
                                    </button>
                                    <button class="text-red-800 hover:text-red-600 transition-all duration-300">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>