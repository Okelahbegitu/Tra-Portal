<?php
include '../../config/conn.php';
global $conn;

//take all tour
$stmt = "SELECT w.*, a.gambar FROM tbwisata w LEFT JOIN album a ON a.id_wisata = w.id_wisata WHERE w.status ='aktif'";

$stmtCat = "SELECT * FROM tb_kategori";

$result = mysqli_query($conn, $stmt);
$resultCat = mysqli_query($conn, $stmtCat);

$data = [];
$catData = [];

while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['id_wisata'];

    if (!isset($data[$id])) {
        $data[$id] = [
            'data' => $row,
            'gambar' => []
        ];
    }

    if (!empty($row['gambar'])) {
        $data[$id]['gambar'][] = $row['gambar'];
    }
}
while ($row = mysqli_fetch_assoc($resultCat)) {
    $catData[] = $row;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Tra-Portal</title>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

    <link rel="stylesheet" href="../../output.css?v=<?php echo time(); ?>">
</head>

<body class="flex bg-palette-1 overflow-x-hidden h-screen">

    <?php include '../../component/clientsidebar.php'; ?>

    <main class="flex-1 p-4 overflow-y-auto">
        <nav class="flex justify-center ">
            <input type="search" class="border rounded-2xl px-3 bg-white w-150 h-10 border-palette-4">
            <button class="ml-7">
                <i data-lucide="search" class="w-5 h-5"></i>
            </button>
        </nav>
        <div class="mt-10">

            <?php include '../../component/card.php' ?>


            <?php foreach ($catData as $cat): ?>
                <?php
                    $hasTour = false;
                    foreach ($data as $tour){
                        if ($cat['id_kategori'] == $tour['data']['id_category']){
                            $hasTour = true;
                            break;
                        }
                    }
                ?>
                <?php if(!$hasTour) continue?>
                <div>
                    <a href="category.php?id_category=<?= $cat['id_kategori'] ?>"
                        class="text-3xl my-5 flex"><?= $cat['nama_kategori'] ?><i data-lucide="move-right"></i></a>
                    <div class="w-full overflow-x-auto">

                        <div class="flex gap-4 w-max">
                            <?php foreach ($data as $tour): ?>
                                <?php if ($cat['id_kategori'] == $tour['data']['id_category'] ): ?>
                                    <?php
                                    if (!empty($tour['gambar'])) {
                                        $card = new Card(
                                            $tour['data']['id_wisata'],
                                            $tour['data']['nama_wisata'],
                                            $tour['data']['harga_wisata'],
                                            $tour['gambar'][0]
                                        );
                                        echo $card->render();
                                    }
                                    ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let rating = 0
        let session = null
        let history = null

        fetch('../../server/GET_SESSION.php')
            .then(res => res.json())
            .then(sessionData => {
                session = sessionData
                return fetch('../../server/GET_HISTORY.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id_akun: sessionData.id_akun })
                })
            })
            .then(Hres => Hres.json())
            .then(HresJson => {
                if (!HresJson || Object.keys(HresJson).length === 0) {
                    return // cukup stop di sini, Swal.fire tidak akan dipanggil
                }
                history = HresJson
                Swal.fire({
                    title: "Ceritakan pengalaman anda selama liburan!",
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: "Kirim",
                    denyButtonText: "Batal",
                    html: `
        <div id="rate-warper" class="flex gap-2 justify-center mb-4">
          ${[1, 2, 3, 4, 5].map(i => `
            <button class="rate-btn" data-value="${i}">
              <i data-lucide="star" class="star-icon w-6 h-6 text-gray-400"></i>
            </button>
          `).join('')}
        </div>
        <textarea id="comment" class="swal2-textarea !rounded-md !p-2 w-full" placeholder="pengalaman anda...."></textarea>
      `,
                    didOpen: () => {
                        lucide.createIcons()
                        const popup = Swal.getPopup()
                        const btns = popup.querySelectorAll(".rate-btn")
                        const stars = popup.querySelectorAll(".star-icon")

                        btns.forEach(btn => {
                            btn.addEventListener('click', () => {
                                rating = Number(btn.dataset.value)
                                stars.forEach((icon, idx) => {
                                    icon.style.color = idx < rating ? '#facc15' : '#d1d5db'
                                })
                            })
                        })
                    },
                    preConfirm: () => {
                        const Comment = document.getElementById("comment").value
                        if (!Comment || rating == 0) {
                            Swal.showValidationMessage('Lengkapkan inputnya!')
                            return false
                        }
                        console.log(session.id_akun)
                        console.log(history.id_wisata)
                        console.log(Comment)
                        console.log(rating)
                        // return fetch promise supaya SweetAlert menunggu response
                        return fetch("../../server/POST_COMMENT.php", {
                            method: "POST",
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({
                                id_pemesanan: history.id_pemesanan,
                                id_akun: session.id_akun,
                                id_wisata: history.id_wisata,
                                Comment: Comment,
                                rating: rating
                            })
                        }).then(res => res.json())
                    }
                }).then(resEx => {
                    if (resEx.isConfirmed) {
                        console.log('Server response:', resEx.value)
                    }
                })
            })
            .catch(err => console.error(err))

        lucide.createIcons();
    </script>
</body>