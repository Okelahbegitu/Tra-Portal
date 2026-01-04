<?php
include '../../config/conn.php';
include '../../config/Parsedown.php';
require_once '../../vendor/autoload.php';

$parsedown = new Parsedown();

$ENV = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$ENV->load();

$parsedown->setSafeMode(true);
session_start();
// Validasi input
$id_wisata = $_GET['id'];
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die('ID tidak valid');
}

$sql = "SELECT w.*, a.gambar 
        FROM tbwisata w 
        LEFT JOIN album a ON a.id_wisata = w.id_wisata 
        WHERE w.id_wisata = ?";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    die('Prepare failed: ' . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "i", $id_wisata);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $wid = $row['id_wisata'];

    if (!isset($data[$wid])) {
        $data[$wid] = [
            'data' => $row,
            'gambar' => []
        ];
    }

    if (!empty($row['gambar'])) {
        $data[$wid]['gambar'][] = $row['gambar'];
    }
}
mysqli_stmt_close($stmt);

$desc = $parsedown->parse($data[$id_wisata]['data']['deskripsi_wisata']);



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Tra-Portal</title>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/github-markdown-css/github-markdown.min.css">

    <link rel="stylesheet" href="../../output.css?v=<?php echo time(); ?>">
</head>

<body class="flex bg-palette-1 overflow-hidden h-screen">
    <?php include '../../component/clientsidebar.php'; ?>
    <main class="flex-1 p-4 overflow-y-auto">
        <div class="grid grid-cols-5 gap-5 h-full">
            <div class="md:col-span-3 card rounded-md">
                <div class="swiper aspect-[16/9] w-full rounded-md overflow-hidden">
                    <div class="swiper-wrapper">
                        <?php for ($i = 0; $i < count($data[$id_wisata]['gambar']); $i++): ?>
                            <div class="swiper-slide">
                                <img src="../../<?= $data[$id_wisata]['gambar'][$i] ?>" class="w-full h-full object-cover">
                            </div>
                        <?php endfor ?>
                    </div>

                    <div class="brand-pagination absolute bottom-3 left-0 right-0 z-10 flex justify-center">
                    </div>
                    <div class="brand-button-prev">
                        <i data-lucide="chevron-left" class="w-4 h-4"></i>
                    </div>
                    <div class="brand-button-next">
                        <i data-lucide="chevron-right" class="w-4 h-4"></i>
                    </div>

                </div>
            </div>


            <div class="md:col-span-2 card rounded-md min-h-[200px]">
                <div class="m-2 p-5">
                    <h1 class="text-4xl font-bold"><?= $data[$id_wisata]['data']['nama_wisata'] ?></h1>
                    <div class="flex mt-3">
                        <h2 class="text-3xl"><?= $data[$id_wisata]['data']['harga_wisata'] ?> Rp</h2>
                    </div>
                    <div class="flex mt-3 align-middle">
                        <i class="text-3xl" data-lucide="map-pinned"></i>
                        <p class="text-1xl"><?= $data[$id_wisata]['data']['lokasi'] ?></p>
                    </div>
                    <div class="grid h-64 ">
                        <button
                            onclick="doTransaction(  '<?= $_SESSION['id_akun'] ?>',  '<?= $data[$id_wisata]['data']['id_wisata'] ?>',  <?= (int) $data[$id_wisata]['data']['harga_wisata'] ?>)"
                            class="hover:bg-blue-600 bg-blue-400 self-end h-15 border rounded-2xl font-bold text-3xl cursor-pointer text-white ">
                            Check-out
                        </button>
                    </div>
                </div>

            </div>

            <div class="md:col-span-5 markdown-body  rounded-md min-h-[250px] overflow-y-scroll ">
                <?= $desc ?>
            </div>
        </div>


    </main>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="<?= $_ENV['MIDTRANS_CLIENT_KEY'] ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const swiper = new Swiper('.swiper', {
            loop: true,
            pagination: {
                el: '.brand-pagination',
                clickable: true,
                bulletClass: 'brand-bullet',
                bulletActiveClass: 'brand-bullet-active',
            },
            navigation: {
                nextEl: '.brand-button-next',
                prevEl: '.brand-button-prev',
            },
        });

        function doTransaction(id_akun, id_wisata, harga_wisata) {
            Swal.fire({
                title: "Check-out",
                html: `
      <div class="space-y-3 text-left">
        <input type="number" id="jumlah" class="swal2-input" placeholder="Jumlah pengunjung">
        <input type="date" id="tanggal" class="swal2-input">
        <input type="number" id="durasi" class="swal2-input" placeholder="Durasi (hari)">
      </div>
    `,
                showCancelButton: true,
                confirmButtonText: "Check-out",
                cancelButtonText: "Batal",
                preConfirm: () => {
                    const jumlah = document.getElementById('jumlah').value;
                    const tanggal = document.getElementById('tanggal').value;
                    const durasi = document.getElementById('durasi').value;

                    if (!jumlah || !tanggal || !durasi) {
                        Swal.showValidationMessage('Semua field wajib diisi');
                        return false;
                    }

                    const today = new Date().toISOString().split('T')[0];
                    if (tanggal === today) {
                        Swal.showValidationMessage('Tanggal tidak boleh hari ini');
                        return false;
                    }

                    return {
                        jumlah: parseInt(jumlah),
                        tanggal,
                        durasi: parseInt(durasi)
                    };
                }
            }).then((result) => {
                if (!result.isConfirmed) return;

                const { jumlah, tanggal, durasi } = result.value;
                const total = jumlah * parseInt(harga_wisata);

                fetch('../../server/payment/create-token.php', {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id_akun: id_akun,
                        id_wisata: id_wisata,
                        tanggal_kunjungan: tanggal, // ambil tanggal saja
                        durasi: durasi,              // ambil durasi saja
                        jumlah_pengunjung: jumlah,   // ambil jumlah saja
                        harga_wisata: harga_wisata,
                        total: total
                    })
                })
                    .then(res => res.json())
                    .then(data => {
                        snap.pay(data.token, {
                            onSuccess: function (result) {
                                console.log('SUCCESS', result);
                                // transaksi selesai, tetap di halaman
                            },
                            onPending: function (result) {
                                console.log('PENDING', result);
                            },
                            onError: function (result) {
                                console.log('ERROR', result);
                            },
                            onClose: function () {
                                console.log('User menutup popup');
                            }
                        })
                    });
            });
        }


    </script>
</body>
<script>
    lucide.createIcons();
</script>

</html>