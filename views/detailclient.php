
<?php
$nama = $_GET['nama'] ?? 'Nama Paket';
$harga = $_GET['harga'] ?? '0';
$gambar = $_GET['gambar'] ?? 'https://placehold.co/800x500';
$deskripsi = $_GET['deskripsi'] ?? 'Deskripsi paket belum tersedia.';
$lokasi = $_GET['lokasi'] ?? 'Lokasi tidak diketahui.';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $nama ?></title>

    <!-- TAILWIND -->
    <link rel="stylesheet" href="../output.css?v=<?php echo time(); ?>">
</head>

<body class="bg-gray-100 min-h-screen">

    <div class="max-w-4xl mx-auto p-6 mt-10 bg-white rounded-2xl shadow-lg">

        <!-- GAMBAR -->
        <img src="<?php echo $gambar ?>" class="w-full rounded-2xl shadow-md mb-6">

        <!-- NAMA -->
        <h1 class="text-4xl font-bold text-gray-900 mb-3">
            <?php echo $nama ?>
        </h1>

        <!-- LOKASI -->
        <p class="text-lg text-gray-600 mb-2">
            <span class="font-semibold">📍 Lokasi:</span>
            <?php echo $lokasi ?>
        </p>

        <!-- DESKRIPSI -->
        <p class="text-gray-700 text-lg leading-relaxed mb-6">
            <?php echo $deskripsi ?>
        </p>

        <!-- HARGA -->
        <div class="text-3xl font-extrabold text-green-600 mb-6">
            Rp <?php echo number_format($harga, 0, ',', '.') ?>
        </div>

        <!-- TOMBOL PESAN -->
        <a href="#"
            class="block w-full text-center py-3 bg-blue-600 hover:bg-blue-700 transition text-white font-bold rounded-xl shadow-md">
            Pesan Sekarang
        </a>

    </div>

</body>

</html>