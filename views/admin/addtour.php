<?php

include '../../config/conn.php';
global $conn;
$null = null;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    mysqli_begin_transaction($conn);
    $uploadedFiles = [];

    try {
        $idTour = "T-" . date("Ymd") . "-" . rand(1000, 9999);
        $status = "aktif";

        $stmtWisata = mysqli_prepare(
            $conn,
            "INSERT INTO tbwisata 
            VALUES (?, ?, ?, ?, ?, ?, ?)"
        );

        mysqli_stmt_bind_param(
            $stmtWisata,
            "sssssis",
            $idTour,
            $_POST['category'],
            $_POST['name'],
            $_POST['location'],
            $_POST['desc'],
            $_POST['price'],
            $status
        );
        mysqli_stmt_execute($stmtWisata);

        $stmtAlbum = mysqli_prepare(
            $conn,
            "INSERT INTO album VALUES (?, ?, ?)"
        );

        if (!empty($_FILES['albumArray']['name'][0])) {
            $baseDir = __DIR__ . "../../../uploads/wisata/$idTour/";
            if (!is_dir($baseDir))
                mkdir($baseDir, 0755, true);

            $count = count($_FILES['albumArray']['name']);

            for ($i = 0; $i < $count; $i++) {
                $ext = pathinfo($_FILES['albumArray']['name'][$i], PATHINFO_EXTENSION);
                $idPhoto = "P-" . uniqid();
                $filename = "$idPhoto.$ext";
                $target = $baseDir . $filename;
                $pathDB = "uploads/wisata/$idTour/$filename";

                if (!move_uploaded_file($_FILES['albumArray']['tmp_name'][$i], $target)) {
                    throw new Exception("Gagal upload file");
                }

                $uploadedFiles[] = $target;
                mysqli_stmt_bind_param($stmtAlbum, "sss",  $idPhoto, $idTour,$pathDB);
                mysqli_stmt_execute($stmtAlbum);
            }
        }

        mysqli_commit($conn);

    } catch (Exception $e) {
        mysqli_rollback($conn);

        // hapus file jika DB gagal
        foreach ($uploadedFiles as $f) {
            if (file_exists($f))
                unlink($f);
        }

        echo "Error: " . $e->getMessage();
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
                                placeholder="Masukkan nama wisata">
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
                                placeholder="Masukkan lokasi wisata" name="location">
                        </div>
                        <div class="col-span-2">
                            <label class="text-sm font-semibold mb-2 flex items-center gap-2">
                                <i data-lucide="dollar-sign" class="w-4 h-4"></i>
                                Harga
                            </label>
                            <input type="number"
                                class="w-full border border-palette-3 rounded-lg px-4 py-3 focus:border-palette-4"
                                placeholder="Masukkan harga" min="100" name="price">
                        </div>
                        <div class="col-span-2 text-5xl font-semibold mb-2 flex items-center gap-2">

                            <!-- DISPLAY  -->
                            <div class="border-2 w-full border-palette-3  rounded-lg px-3 py-2 flex items-center gap-2 "
                                id="display-container">

                                <label
                                    class="text-sm font-semibold mb-2 flex items-center text-white  hover:bg-gray-400 bg-gray-500 border p-15 rounded-md"
                                    for="pict">
                                    <i data-lucide="plus" class="w-4 h-4"></i>
                                </label>

                                <input type="file" multiple class="hidden" id="pict">


                            </div>
                        </div>
                        <div class="col-span-2">
                            <label class="text-sm font-semibold mb-2 flex items-center gap-2">
                                <i data-lucide="text-align-start" class="w-4 h-4"></i>
                                Deskripsi
                            </label>
                            <textarea class="w-full border border-palette-3 rounded-lg px-4 py-3 focus:border-palette-4"
                                name="desc">
                            </textarea>
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
        let albumArray = []
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
                        class="absolute top-1 right-5 bg-red-500 text-white w-5 h-5 
                        rounded-full text-xs opacity-0 group-hover:opacity-100 transition">
                        x
                    </button>
                </div>
            `);



                    albumArray.push([idUnik, file]);
                });
            } else {
                imgContainer.classList.add("hidden");
                Ifile.classList.add("rounded-b-lg");
                Ifile.classList.remove("rounded-b-none");
            }
        });

        function removeFile(event, id) {
            event.preventDefault()
            // "Ambil semua item yang ID-nya TIDAK SAMA dengan targetId"
            albumArray = albumArray.filter(item => item[0] !== id);

            const element = document.getElementById(id)
            if (element) {
                element.remove()
            }
        }
    </script>

    <script type="module">
        import { showToast } from '../../component/js/toast.js';
        formAddTour.addEventListener('submit', (event) => { // Tambahkan parameter event
            event.preventDefault();

            const submittxt = document.getElementById('submittxt');

            const loadlogo = document.getElementById('loadlogo');
            const savelogo = document.getElementById('savelogo');

            submittxt.innerText = "Processing..."
            loadlogo.classList.add('hidden')
            savelogo.classList.remove('hidden')

            const formdata = new FormData(formAddTour);

            formdata.delete("pict");

            albumArray.forEach((item) => {
                const fileData = item[1];
                formdata.append("albumArray[]", fileData);
            });

            fetch('addtour.php', {
                method: "POST",
                body: formdata
            }).then(response => response.text())
                .then(data => {
                    if (data.includes("Berhasil")) {
                        showToast('berhasil ditambahakn');
                        submittxt.innerText = "Save Tour"
                        loadlogo.classList.add('hidden')
                        savelogo.classList.remove('hidden')

                    }
                });

        });


    </script>
</body>

</html>