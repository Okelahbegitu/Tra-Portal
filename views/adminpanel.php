<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Admin Panel - Dashboard</title>
    <link rel="stylesheet" href="../output.css?v=<?php echo time(); ?>">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
</head>
<body class="flex h-100 bg-palette-1">
    <!-- Sidebar -->
    <aside class="w-50 bg-palette-4 text-white flex flex-col p-4 min-h-full">
        <div>
            <div class="text-2xl font-black mb-2">TOUR ADMIN</div>
            <div class="text-sm font-semibold mb-8">ADMINISTRATION PANEL</div>
            
            <nav class="mt-6">
                <ul class="flex flex-col gap-2.5">
                    <li>
                        <a href="adminpanel.php" class="flex items-center gap-2.5 p-3 rounded-lg bg-palette-3 w-full">
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
                <h1 class="text-4xl font-black">DASHBOARD</h1>
                <p class="text-xl mt-2">SELAMAT DATANG, ADMIN! KELOLA WISATA DAN PEMESANAN ANDA DENGAN MUDAH</p>
            </header>

            <div class="grid grid-cols-2 gap-4 mb-8">
                <div class="card p-4">
                    <h2 class="text-2xl font-bold">TOTAL WISATA</h2>
                    <p class="text-4xl font-black mt-4">...</p>
                </div>
                <div class="card p-4">
                    <h2 class="text-2xl font-bold">Total Pemesanan</h2>
                    <p class="text-4xl font-black mt-4">...</p>
                </div>
            </div>
        </div>
    </main>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>