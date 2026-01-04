<?php
include '../../config/conn.php';
session_start();
global $conn;
$data = [];
$stmt = mysqli_prepare($conn, "SELECT ord.durasi, ord.tanggal_kunjungan, ord.tanggal_pemesanan , ord.tanggal_kepulangan, ord.jumlah_pengunjung, ord.total ,w.harga_wisata,  w.nama_wisata FROM tb_pemesanan ord INNER JOIN tbwisata w ON ord.id_wisata = w.id_wisata INNER JOIN tb_akun a ON ord.id_akun = a.id_akun WHERE ord.id_akun = ?");
mysqli_stmt_bind_param($stmt, "s", $_SESSION['id_akun']);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan tour</title>
    <link rel="stylesheet" href="../../output.css?v=<?php echo time(); ?>">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
</head>

<body class="flex bg-palette-1 overflow-hidden h-screen">

    <!-- Sidebar -->
    <?php include '../../component/clientsidebar.php' ?>

    <main class="flex-1 p-4 overflow-auto h-146">
        <div class="card p-4">
            <div class="overflow-x-auto"></div>
            <table class="w-full min-h-full" id="tabelTour">
                <thead>
                    <tr class="border-b border-palette-3">
                        <th>NO</th>
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
                <tbody class="overflow-y-scroll">
                    <?php $i = 1; foreach ($data as $history):?>
                    <tr class="border-b border-palette-3">
                        <th><?=$i++?></th>
                        <th class="text-left py-3 px-4"><?=$history['nama_wisata']?></th>
                        <th class="text-left py-3 px-4"><?=$history['jumlah_pengunjung']?></th>
                        <th class="text-left py-3 px-4"><?=$history['durasi']?></th>
                        <th class="text-left py-3 px-4"><?=$history['tanggal_kunjungan']?></th>
                        <th class="text-left py-3 px-4"><?=$history['tanggal_kepulangan']?></th>
                        <th class="text-left py-3 px-4"><?=$history['tanggal_pemesanan']?></th>
                        <th class="text-left py-3 px-4"><?=$history['harga_wisata']?></th>
                        <th class="text-left py-3 px-4"><?=$history['total']?></th>
                    </tr>
                    <?php endforeach?>
                </tbody>
            </table>
        </div>
        </div>
    </main>
</body>
<script>
    lucide.createIcons();

</script>

</html>