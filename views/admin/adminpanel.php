<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Admin Panel - Dashboard</title>
    <link rel="stylesheet" href="../../output.css?v=<?php echo time(); ?>">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
</head>
<body class="flex bg-palette-1 overflow-hidden h-screen">

    <!-- Sidebar -->
    <?php include '../../component/adminsidebar.php' ?>

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