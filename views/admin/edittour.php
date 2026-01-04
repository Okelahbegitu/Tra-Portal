<?php
include '../../config/conn.php';
global $conn;

$oldAlbumArray = [];
$dataTour = null;
$idTour = $_GET['id_wisata'] ?? null;

if ($idTour) {
    // Ambil data wisata
    $stmt = mysqli_prepare($conn, "SELECT * FROM tbwisata WHERE id_wisata = ?");
    mysqli_stmt_bind_param($stmt, "s", $idTour);
    mysqli_stmt_execute($stmt);
    $dataTour = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

    // Ambil album lama
    $stmt = mysqli_prepare($conn, "SELECT * FROM album WHERE id_wisata = ?");
    mysqli_stmt_bind_param($stmt, "s", $idTour);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($res)) {
        $oldAlbumArray[] = $row;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $idTour) {
    mysqli_begin_transaction($conn);
    try {
        // UPDATE DATA WISATA
        $stmt = mysqli_prepare($conn, "UPDATE tbwisata SET nama_wisata=?, lokasi=?, deskripsi_wisata=?, harga_wisata=? WHERE id_wisata=?");
        mysqli_stmt_bind_param($stmt, "sssis", $_POST['name'], $_POST['location'], $_POST['desc'], $_POST['price'], $idTour);
        mysqli_stmt_execute($stmt);

        // LOGIKA DELETE FOTO YANG DIHAPUS USER
        $keepOldIds = [];
        if (!empty($_POST['newPictIdJSON'])) {
            $decoded = json_decode($_POST['newPictIdJSON'], true);
            foreach ($decoded as $item) {
                if (isset($item['status'], $item['id']) && $item['status'] === 'old') {
                    $keepOldIds[] = (string) $item['id'];
                }
            }
        }

        foreach ($oldAlbumArray as $old) {
            $oldId = (string) $old['id_photo'];
            if (!in_array($oldId, $keepOldIds, true)) {
                $filePath = __DIR__ . '/../../' . $old['gambar'];
                if (file_exists($filePath)) unlink($filePath);
                
                $delStmt = mysqli_prepare($conn, "DELETE FROM album WHERE id_photo = ?");
                mysqli_stmt_bind_param($delStmt, "s", $oldId);
                mysqli_stmt_execute($delStmt);
            }
        }

        // INSERT FOTO BARU
        if (!empty($_FILES['albumArray']['tmp_name'])) {
            $baseDir = __DIR__ . '/../../' . "uploads/wisata/$idTour/";
            if (!is_dir($baseDir)) mkdir($baseDir, 0755, true);

            foreach ($_FILES['albumArray']['tmp_name'] as $i => $tmp) {
                if ($_FILES['albumArray']['error'][$i] !== 0) continue;

                $idPhoto = "P-" . uniqid();
                $ext = pathinfo($_FILES['albumArray']['name'][$i], PATHINFO_EXTENSION);
                $filename = "$idPhoto.$ext";
                $target = $baseDir . $filename;
                $pathDB = "uploads/wisata/$idTour/$filename";

                if (move_uploaded_file($tmp, $target)) {
                    $insStmt = mysqli_prepare($conn, "INSERT INTO album (id_wisata, id_photo, gambar) VALUES (?, ?, ?)");
                    mysqli_stmt_bind_param($insStmt, "sss", $idTour, $idPhoto, $pathDB);
                    mysqli_stmt_execute($insStmt);
                }
            }
        }

        mysqli_commit($conn);
        echo "Berhasil simpan wisata + album";
        exit; // Penting agar tidak merender HTML saat request AJAX
    } catch (Exception $e) {
        mysqli_rollback($conn);
        echo "Error: " . $e->getMessage();
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Tour - Tour Admin Panel</title>
    <link rel="stylesheet" href="../../output.css?v=<?php echo time(); ?>">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
</head>
<script>
    let albumArray = []
    let newPictId = []

    function puttoAlbum(id, type = "new") {
        newPictId.push({
            id: id,
            status: type
        })
    }
</script>

<body class="flex bg-palette-1 overflow-hidden h-screen">


    <!-- Sidebar -->
    <?php include '../../component/adminsidebar.php' ?>

    <main class="flex-1 p-4 overflow-y-auto">

        <div class="max-w-4xl mx-auto">
            <header class="mb-8">
                <h1 class="text-4xl font-black">ADD NEW TOUR</h1>
                <p class="text-xl mt-2">TAMBAH WISATA BARU</p>
            </header>

            <div class="card p-6">
                <form class="space-y-6" method="post" id="formAddTour" enctype="multipart/form-data">

                    <div class="grid grid-cols-2 gap-6">
                        <div class="col-span-2">
                            <label class="text-sm font-semibold mb-2 flex items-center gap-2">
                                <i data-lucide="map-pin" class="w-4 h-4"></i>
                                Nama Wisata
                            </label>
                            <input type="text" name="name"
                                class="w-full border border-palette-3 rounded-lg px-4 py-3 focus:border-palette-4"
                                placeholder="Masukkan nama wisata" value="<?= $dataTour['nama_wisata'] ?>">
                        </div>
                        <div>
                            <label class="text-sm font-semibold mb-2 flex items-center gap-2">
                                <i data-lucide="tag" class="w-4 h-4"></i>
                                Kategori
                            </label>
                            <select class="w-full border border-palette-3 rounded-lg px-4 py-3 focus:border-palette-4"
                                placeholder="Masukkan kategori wisata" name="category">
                                <?php
                                $opsQuery = "SELECT * FROM tb_kategori";
                                $opsData = [];
                                $opsResult = mysqli_query($conn, $opsQuery);
                                while ($row = mysqli_fetch_assoc($opsResult)) {
                                    $opsData[] = $row;
                                }
                                ?>
                                <?php foreach ($opsData as $key): ?>
                                    <option value="<?= $key['id_kategori'] ?>"><?= $key['nama_kategori'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div>
                            <label class="text-sm font-semibold mb-2 flex items-center gap-2">
                                <i data-lucide="navigation" class="w-4 h-4"></i>
                                Lokasi
                            </label>
                            <input type="text"
                                class="w-full border border-palette-3 rounded-lg px-4 py-3 focus:border-palette-4"
                                placeholder="Masukkan lokasi wisata" required name="location"
                                value="<?= $dataTour['lokasi'] ?>">
                        </div>
                        <div class="col-span-2">
                            <label class="text-sm font-semibold mb-2 flex items-center gap-2">
                                <i data-lucide="dollar-sign" class="w-4 h-4"></i>
                                Harga
                            </label>
                            <input type="number"
                                class="w-full border border-palette-3 rounded-lg px-4 py-3 focus:border-palette-4"
                                placeholder="Masukkan harga" min="100" name="price" required
                                value="<?= $dataTour['harga_wisata'] ?>">
                        </div>
                        <div class="col-span-2 text-5xl font-semibold mb-2 flex items-center gap-2">

                            <!-- DISPLAY  -->
                            <div class="border-2 w-full border-palette-3  rounded-lg px-3 py-2 flex items-center gap-2 "
                                id="display-container">

                                <?php foreach ($oldAlbumArray as $img): ?>
                                    <div id="<?= $img['id_photo'] ?>" class="relative group w-20 align-middle h-20">
                                        <img src="../../<?= $img['gambar'] ?>"
                                            onload="puttoAlbum('<?= $img['id_photo'] ?>', 'old')"
                                            class="border border-palette-3 w-16 h-16 object-cover">
                                        <button onclick="removeFile(event, '<?= $img['id_photo'] ?>')" class="absolute top-1 right-5 bg-red-500 text-white w-5 h-5 
                                            rounded-full text-xs opacity-0 group-hover:opacity-100 transition">
                                            x
                                        </button>
                                    </div>
                                <?php endforeach ?>
                                <div>


                                </div>
                                <label
                                    class="text-sm font-semibold mb-2 flex items-center text-white  hover:bg-gray-400 bg-gray-500 border p-15 rounded-md"
                                    for="pict">
                                    <i data-lucide="plus" class="w-4 h-4"></i>
                                </label>

                                <input type="file"  multiple class="hidden" id="pict">


                            </div>
                        </div>
                        <div class="col-span-2">
                            <label class="text-sm font-semibold mb-2 flex items-center gap-2">
                                <i data-lucide="text-align-start" class="w-4 h-4"></i>
                                Deskripsi
                            </label>
                            <textarea class="w-full border border-palette-3 rounded-lg px-4 py-3 focus:border-palette-4"
                                name="desc"><?= $dataTour['deskripsi_wisata'] ?></textarea>
                        </div>
                    </div>
                    <div class="flex gap-4 pt-4">
                        <button type="submit" name="add" id="add"
                            class="bg-palette-3 text-white px-6 py-3 rounded-lg font-semibold hover:bg-palette-4 transition-all duration-300 flex items-center gap-2 justify-center flex-1">

                            <span id="submittxt">Save Tour</span>
                            <i data-lucide="save" id="savelogo" class="w-5 h-5"></i>
                            <i data-lucide="load" id="loadlogo" class="w-5 hidden animate-spin h-5"></i>

                        </button>
                        <a href="tourmanage.php"
                            class="bg-gray-400 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-500 transition-all duration-300 text-center flex-1 flex items-center justify-center gap-2">
                            <i data-lucide="x" class="w-5 h-5"></i>
                            Cancel
                        </a>
                        <div>
                        </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        lucide.createIcons();

        /** @type {HTMLInputElement} */
        const Ifile = /** @type {HTMLInputElement} */ document.getElementById('pict');
        const imgContainer = /** @type {HTMLInputElement} */ document.getElementById("display-container");
        const formAddTour = document.getElementById('formAddTour');

        Ifile.addEventListener("change", () => {
            if (Ifile.files.length > 0) {
                imgContainer.classList.remove("hidden");
                Ifile.classList.remove("rounded-b-lg");
                Ifile.classList.add("rounded-b-none");

                // Perbaikan: Konversi FileList ke Array agar bisa forEach dengan lancar
                const filelist = Array.from(Ifile.files);

                filelist.forEach((file, index) => {
                    const previewURL = URL.createObjectURL(file);
                    const idUnik = Math.floor(Math.random() * 90) + 10; // Menghasilkan 10 sampai 99
                    imgContainer.insertAdjacentHTML("afterbegin", `
                <div id="${idUnik}" class="relative group w-20 align-middle h-20">
                    <img src="${previewURL}" class="border border-palette-3 w-16 h-16 object-cover">
                    <button onclick="removeFile(event, ${idUnik})"
                        type = 'button'
                        class="absolute top-1 right-5 bg-red-500 text-white w-5 h-5 
                        rounded-full text-xs opacity-0 group-hover:opacity-100 transition">
                        x
                    </button>
                </div>
            `);



                    albumArray.push([idUnik, file]);
                    puttoAlbum(idUnik, 'new')
                });
            } else {
                imgContainer.classList.add("hidden");
                Ifile.classList.add("rounded-b-lg");
                Ifile.classList.remove("rounded-b-none");
            }
            console.log(albumArray)
            console.log(albumArray)
            console.log(newPictId)
        });

        function removeFile(event, id) {
            event.preventDefault()
            // "Ambil semua item yang ID-nya TIDAK SAMA dengan targetId"
            albumArray = albumArray.filter(item => item[0] !== id);
            newPictId = newPictId.filter(item => item.id !== id);



            const element = document.getElementById(id)
            if (element) {
                element.remove()
            }
            console.log(albumArray)
            console.log(newPictId)
        }
    </script>

    <script type="module">
        import { showToast } from '../../component/js/toast.js';
        formAddTour.addEventListener('submit', async (event) => {
            event.preventDefault();

            // 1. Inisialisasi Element UI
            const submittxt = document.getElementById('submittxt');
            const loadlogo = document.getElementById('loadlogo');
            const savelogo = document.getElementById('savelogo');

            // 2. Validasi Awal (Client Side)
            if (albumArray.length > 5) {
                return showToast("Maks gambar adalah 5!", "error");
            }

            // 3. Update UI ke Status Processing
            submittxt.innerText = "Processing...";
            loadlogo.classList.remove('hidden'); // Munculkan spinner
            savelogo.classList.add('hidden');    // Sembunyikan icon save

            try {
                // 4. Persiapan Data
                const formdata = new FormData(formAddTour);
                formdata.delete("pict"); // Hapus input file default jika ada

                // Tambahkan file dari albumArray
                albumArray.forEach((item) => {
                    const fileData = item[1];
                    formdata.append("albumArray[]", fileData);
                });

                // Tambahkan data pendukung lainnya
                formdata.append("newPictIdJSON", JSON.stringify(newPictId));

                // 5. Eksekusi Request
                const response = await fetch(`edittour.php?id_wisata=<?= $_GET['id_wisata'] ?>`, {
                    method: "POST",
                    body: formdata
                });

                const data = await response.text();
                console.log("RESPONSE PHP:", data);
                console.log(albumArray)
                console.log(newPictId)

                // 6. Cek Response Server
                if (data.includes("Berhasil")) {
                    showToast('Berhasil diperbarui', 'success');
                    // Opsional: redirect atau reset form di sini
                } else {
                    showToast('Gagal memproses data: ' + data, 'error');
                }

            } catch (err) {
                console.error("FETCH ERROR:", err);
                showToast("Terjadi kesalahan koneksi", "error");
            } finally {
                // 7. Kembalikan Status UI (Loading Selesai)
                submittxt.innerText = "Save Tour";
                loadlogo.classList.add('hidden');
                savelogo.classList.remove('hidden');
            }
        });

    </script>
</body>

</html>