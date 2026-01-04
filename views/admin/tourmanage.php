<?php

include '../../config/conn.php';

global $conn;
if (isset($_POST['makecategory'])) {
    $id = "C-" . date("Y-m-d") . "-" . rand(1000, 9999);
    $query = mysqli_prepare($conn, "INSERT INTO tb_kategori VALUES (?, ?, 'aktif')");
    mysqli_stmt_bind_param($query, "ss", $id, $_POST['nCategory']);
    mysqli_stmt_execute($query);
}

//get tour data from DB
$queryTour = "SELECT * FROM tbwisata WHERE status = 'aktif'";
$resultTour = mysqli_query($conn, $queryTour);
$dataTour = [];

try {
    while ($row = mysqli_fetch_assoc($resultTour)) {
        $dataTour[] = $row;
    }
} catch (mysqli_sql_exception $e) {
    echo $e;
}

$queryCategory = "SELECT * FROM tb_kategori";
$resultCategory = mysqli_query($conn, $queryCategory);
$dataCategory = [];

try {
    while ($row = mysqli_fetch_assoc($resultCategory)) {
        $dataCategory[] = $row;
    }
} catch (mysqli_sql_exception $e) {
    echo $e;
}
?>

<!DOCTYPE html>
<html lang="id">
<?php include '../../component/makecategory.php'; ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Admin Panel - Tour Manage</title>
    <link rel="stylesheet" href="../../output.css?v=<?php echo time(); ?>">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="flex bg-palette-1 overflow-hidden h-screen">

    <!-- Sidebar -->
    <?php include '../../component/adminsidebar.php' ?>

    <main class="flex-1 p-4 overflow-auto h-146">
        <div>
            <header class="mb-8">
                <h1 class="text-4xl font-black">TOUR MANAGE</h1>
                <p class="text-xl mt-2">KELOLA DESTINASI DAN PAKET WISATA ANDA</p>
            </header>

            <div class="flex justify-between mb-4">
                <a href="addtour.php"
                    class="bg-palette-3 text-white px-4 py-3 rounded-lg font-semibold flex items-center gap-2 hover:bg-white hover:text-black transition-all duration-300">
                    <i data-lucide="plus" class="w-5 h-5"></i>
                    ADD NEW TOUR
                </a>
                <button id="newCategory"
                    class="bg-palette-3 text-white px-4 py-3 rounded-lg font-semibold flex items-center gap-2 hover:bg-white hover:text-black transition-all duration-300">
                    ADD NEW CATEGORY
                </button>
                <div class="flex items-center gap-2">
                    <input type="text" placeholder="Search tours..."
                        class="border border-palette-3 rounded-lg px-4 py-3 w-150 focus:border-palette-4">
                    <button
                        class="bg-palette-4 text-white px-4 py-3 rounded-lg hover:bg-white hover:text-black transition-all duration-300">
                        <i data-lucide="search" class="w-5 h-5"></i>
                    </button>
                </div>
            </div>

            <div class="card p-4">
                <div class="overflow-x-auto">
                    <div class="tab">
                        <button onclick="tabelchange(0)"
                            class="p-3 rounded-lg bg-palette-3 text-white">Destinasi</button>
                        <button onclick="tabelchange(1)"
                            class="p-3 rounded-lg bg-palette-3 text-white">Kategori</button>
                    </div>
                    <table class="w-full" id="tabelTour">
                        <thead>
                            <tr class="border-b border-palette-3">
                                <th>NO</th>
                                <th class="text-left py-3 px-4">Nama</th>
                                <th class="text-left py-3 px-4">Lokasi</th>
                                <th class="text-left py-3 px-4">Kategori</th>
                                <th class="text-left py-3 px-4">Lokasi</th>
                                <th class="text-left py-3 px-4">Harga</th>
                                <th class="text-left py-3 px-4">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($dataTour as $data): ?>
                                <?php

                                $getcategoryQ = "SELECT nama_kategori 
                                FROM `tra-portal`.tb_kategori 
                                WHERE id_kategori = '{$data['id_category']}'";

                                $getCategory = [];
                                $getCategoryResault = mysqli_query($conn, $getcategoryQ);
                                while ($row = mysqli_fetch_assoc($getCategoryResault)) {
                                    $getcategory[] = $row;
                                }
                                ?>
                                <tr class="border-b border-palette-3">
                                    <td class="py-3 px-4"><?= $i++ ?></td>
                                    <td class="py-3 px-4"><?= $data['nama_wisata'] ?></td>
                                    <td class="py-3 px-4"><?= $data['lokasi'] ?></td>
                                    <td class="py-3 px-4"><?= $getcategory[0]['nama_kategori'] ?></td>
                                    <td class="py-3 px-4"><?= $data['lokasi'] ?></td>
                                    <td class="py-3 px-4"><?= $data['harga_wisata'] ?></td>
                                    <td class="py-3 px-4 flex gap-2">
                                        <a href="edittour.php?id_wisata=<?= $data['id_wisata'] ?>" class=" text-palette-4
                                            hover:text-palette-3 transition-all duration-300">
                                            <i data-lucide="edit" class="w-4 h-4"></i>
                                        </a>
                                        <button onclick="deleteData('<?= $data['id_wisata'] ?>', 'wisata')"
                                            class="text-red-800 hover:cursor-pointer hover:text-red-600 transition-all duration-300">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </td>
                                </tr>

                            <?php endforeach ?>
                        </tbody>
                    </table>
                    <table class="w-full hidden" id="tabelCateg">
                        <thead>
                            <tr class="border-b border-palette-3">
                                <th class="text-left py-3 px-4">No</th>
                                <th class="text-left py-3 px-4">Nama Kategori</th>
                                <th class="text-left py-3 px-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            <?php foreach ($dataCategory as $data): ?>
                                <tr class="border-b border-palette-3">
                                    <?php $i++;?>
                                    <td class="py-3 px-4"><?=$i?></td>
                                    <td class="py-3 px-4"><?=$data['nama_kategori']?></td>
                                    <td class="py-3 px-4 flex gap-2">
                                        <button onclick="editKategori('<?=$data['id_kategori']?>', '<?=$data['nama_kategori']?>')"
                                            class="text-palette-4 hover:text-palette-3 transition-all duration-300">
                                            <i data-lucide="edit" class="w-4 h-4"></i>
                                        </button>
                                        <button onclick="deleteData('<?= $data['id_kategori'] ?>', 'kategori')"
                                            class="text-red-800 hover:text-red-600 transition-all duration-300">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <script>
        lucide.createIcons();

        document.getElementById("newCategory").addEventListener("click", () => {
            Swal.fire({
                html: document.getElementById("createCategory").innerHTML,
                showConfirmButton: false
            })
        })

        function editKategori(id, namaLama = '') {
        Swal.fire({
            title: "Edit Nama Kategori",
            input: "text",
            inputLabel: "Masukkan nama kategori baru",
            inputValue: namaLama, // Menampilkan nama lama di dalam input
            showCancelButton: true,
            confirmButtonText: "Simpan",
            cancelButtonText: "Batal",
            inputValidator: (value) => {
                if (!value) {
                    return 'Nama tidak boleh kosong!';
                }
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const formData = new FormData();
                formData.append("id", id);
                formData.append("newData", result.value);

                fetch(`../../server/UPDATE_KATEGORI.php`, {
                    method: "POST",
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire("Berhasil!", data.message, "success")
                            .then(() => location.reload());
                    } else {
                        Swal.fire("Gagal!", data.message || "Terjadi kesalahan", "error");
                    }
                })
                .catch(err => {
                    Swal.fire("Error!", "Gagal menghubungi server", "error");
                });
            }
        });
    }
        

        function deleteData(id, type) {
            Swal.fire({
            title: "Yakin ingin hapus?",
            text: `Data ${type} tidak akan bisa dikembalikan lagi`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batalkan'
        }).then((result) => {
            if (result.isConfirmed) {
                const formData = new FormData();
                formData.append("id", id);

                // Menentukan file tujuan berdasarkan type
                // Memperbaiki syntax ternary yang tadi terputus
                const req = (type === "wisata") ? "DELETE_WISATA.php" : "DELETE_KATEGORI.php";

                fetch(`../../server/${req}`, {
                    method: "POST",
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire("Berhasil!", data.message, "success")
                            .then(() => location.reload());
                    } else {
                        Swal.fire("Gagal!", data.message || "Gagal menghapus data", "error");
                    }
                })
                .catch(err => {
                    Swal.fire("Error!", "Terjadi kesalahan koneksi ke server", "error");
                    console.error(err);
                });
            }
        });
        }


        function tabelchange(index) {
            const tabelTour = document.getElementById('tabelTour');
            const tabelCateg = document.getElementById('tabelCateg');
            if (index == 0) {
                tabelTour.classList.remove('hidden');
                tabelCateg.classList.add('hidden');
            } else if (index == 1) {
                tabelTour.classList.add('hidden');
                tabelCateg.classList.remove('hidden');
            }
        }
    </script>
</body>

</html>