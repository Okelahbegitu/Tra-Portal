<?php
include '../../config/conn.php';

session_start();

if($_SESSION['role'] != "admin"){
    header("Refresh: 0.1; url=signin.php");
}

global $conn;
$data = [];
$stmt = mysqli_prepare($conn, "SELECT ord.durasi, ord.tanggal_kunjungan, ord.tanggal_pemesanan , ord.tanggal_kepulangan, ord.jumlah_pengunjung, ord.total ,w.harga_wisata,  w.nama_wisata, a.username, a.id_akun FROM tb_pemesanan ord INNER JOIN tbwisata w ON ord.id_wisata = w.id_wisata INNER JOIN tb_akun a ON ord.id_akun = a.id_akun ");
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Admin Panel - Order List</title>
    <link rel="stylesheet" href="../../output.css?v=<?php echo time(); ?>">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
</head>

<body class="flex bg-palette-1 overflow-hidden h-screen">
    <!-- Sidebar -->
    <?php include '../../component/adminsidebar.php' ?>

    <main class="flex-1 p-4 overflow-auto">
        <div>
            <header class="mb-8">
                <h1 class="text-4xl font-black">ORDER LIST</h1>
                <p class="text-xl mt-2">KELOLA PESANAN DAN PEMESANAN PELANGGAN</p>
            </header>

            <div class="flex justify-between mb-4">
                <div class="flex items-center gap-2">
                    <input type="text" placeholder="Search orders... (username)" id="Search"
                        class="border border-palette-3 rounded-lg px-4 py-3 w-150">
                    <button class="bg-palette-4 text-white px-4 py-3 rounded-lg">
                        <i data-lucide="search" class="w-5 h-5"></i>
                    </button>
                </div>
            </div>

            <div class="card p-4">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-palette-3">
                                <th class="text-left py-3 px-4">NO</th>
                                <th class="text-left py-3 px-4">Username</th>
                                <th class="text-left py-3 px-4">Nama Wisata</th>
                                <th class="text-left py-3 px-4">Jumlah orang</th>
                                <th class="text-left py-3 px-4">Durasi (Hari)</th>
                                <th class="text-left py-3 px-4">Tanggal Keberangkatan</th>
                                <th class="text-left py-3 px-4">Tanggal Kepulangan</th>
                                <th class="text-left py-3 px-4">Tanggal Pemesanan</th>
                                <th class="text-left py-3 px-4">Harga Wisata</th>
                                <th class="text-left py-3 px-4">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($data as $history): ?>
                                <tr data-order="<?= $history['username'] ?>"
                                    class="border-b border-palette-3">
                                    <th><?= $i++ ?></th>
                                    <th class="text-left py-3 px-4"><?= $history['username'] ?></th>

                                    <th class="text-left py-3 px-4"><?= $history['nama_wisata'] ?></th>
                                    <th class="text-left py-3 px-4"><?= $history['jumlah_pengunjung'] ?></th>
                                    <th class="text-left py-3 px-4"><?= $history['durasi'] ?></th>
                                    <th class="text-left py-3 px-4"><?= $history['tanggal_kunjungan'] ?></th>
                                    <th class="text-left py-3 px-4"><?= $history['tanggal_kepulangan'] ?></th>
                                    <th class="text-left py-3 px-4"><?= $history['tanggal_pemesanan'] ?></th>
                                    <th class="text-left py-3 px-4"><?= $history['harga_wisata'] ?></th>
                                    <th class="text-left py-3 px-4"><?= $history['total'] ?></th>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
    </main>

    <script>
        lucide.createIcons();

        const search = document.getElementById("Search");
        search.addEventListener('input', () => {  
            const value = search.value.trim().toLowerCase();    // ambil nilai input


            const data = document.querySelectorAll('[data-order]');

            data.forEach((item) =>{
                if (value === ''){
                    item.classList.remove("hidden")
                    return
                }

                if (value == item.dataset.order.toLowerCase()){
                    item.classList.remove("hidden")
                } else {
                    item.classList.add("hidden")
                }
            })


        });

    </script>
</body>

</html>