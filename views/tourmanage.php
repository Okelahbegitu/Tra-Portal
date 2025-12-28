<?php

include '../config/conn.php';

global $conn;
if (isset($_POST['makecategory'])) {
    $id = "C-" . date("Y-m-d") . "-" . rand(1000, 9999);
    $query = mysqli_prepare($conn, "INSERT INTO tb_kategori VALUES (?, ?)");
    mysqli_stmt_bind_param($query, "ss", $id, $_POST['nCategory']);
    mysqli_stmt_execute($query);
}

//get tour data from DB
$queryTour = "SELECT * FROM tbwisata";
$result = mysqli_query($conn, $queryTour);
$dataTour = [];

try {
    while ($row = mysqli_fetch_assoc($result)) {
        $dataTour[] = $row;
    }
} catch (mysqli_sql_exception $e) {
    echo $e;
}
?>

<!DOCTYPE html>
<html lang="id">
<?php include '../component/makecategory.php'; ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Admin Panel - Tour Manage</title>
    <link rel="stylesheet" href="../output.css?v=<?php echo time(); ?>">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            <a href="index.php"
                class="flex items-center gap-2.5 p-3 rounded-lg w-full bg-red-800 text-white hover:bg-white hover:text-black transition-all duration-300">
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
                                    <a href="edittour.php/<?= $data['id_destinasi'] ?> class=" text-palette-4
                                        hover:text-palette-3 transition-all duration-300">
                                        <i data-lucide="edit" class="w-4 h-4"></i>
                                        </button>
                                        <a class="text-red-800 hover:text-red-600 transition-all duration-300">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                </td>
                            </tr>
                            <?php foreach ($dataTour as $data): ?>
                                <?php $i = 1;

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
                                    <td class="py-3 px-4"><?= $data['harga_wisata'] ?></td>
                                    <td class="py-3 px-4 flex gap-2">
                                        <a href="edittour.php?id_wisata=<?= $data['id_wisata'] ?>" class=" text-palette-4
                                            hover:text-palette-3 transition-all duration-300">
                                            <i data-lucide="edit" class="w-4 h-4"></i>
                                            </button>
                                            <a class="text-red-800 hover:text-red-600 transition-all duration-300">
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
                                <th class="text-left py-3 px-4">ID KATEGORI</th>
                                <th class="text-left py-3 px-4">NAMA KATEGORI</th>
                                <th class="text-left py-3 px-4">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-palette-3">
                                <td class="py-3 px-4">1</td>
                                <td class="py-3 px-4">bla bla</td>
                                <td class="py-3 px-4 flex gap-2">
                                    <a href="edittour.php/<?= $data['id_destinasi'] ?>"
                                        class="text-palette-4 hover:text-palette-3 transition-all duration-300">
                                        <i data-lucide="edit" class="w-4 h-4"></i>
                                    </a>
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
        document.getElementById("newCategory").addEventListener("click", () => {
            Swal.fire({
                html: document.getElementById("createCategory").innerHTML,
                showConfirmButton: false
            })
        })
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