<?php
include '../../config/conn.php';
global $conn;

//get all data
$stmt = mysqli_prepare($conn   ,"SELECT w.*, a.gambar FROM tbwisata w LEFT JOIN album a ON a.id_wisata = w.id_wisata WHERE w.status ='aktif' AND w.id_category = ?");
mysqli_stmt_bind_param($stmt, "s", $_GET['id_category']);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

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

<body class="flex bg-palette-1 overflow-hidden h-screen">
    <?php include '../../component/clientsidebar.php'; ?>

    <main class="flex-1 p-4 overflow-y-auto">
        <nav class="flex justify-center ">
            <input type="search" class="border rounded-2xl px-3 bg-white w-150 h-10 border-palette-4">
            <button class="ml-7">
                <i data-lucide="search" class="w-5 h-5"></i>
            </button>
        </nav>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-2 mt-10">

            <?php include '../../component/card.php' ?>
            <?php foreach ($data as $tour) {

                $card = new Card($tour['data']['id_wisata'], $tour['data']['nama_wisata'], $tour['data']['harga_wisata'], $tour['gambar'][0]);
                echo $card->render();
                echo $card->render();
                echo $card->render();
                echo $card->render();
                echo $card->render();
                echo $card->render();
                echo $card->render();
                echo $card->render();
                echo $card->render();
                echo $card->render();
                echo $card->render();
                echo $card->render();
                echo $card->render();
                echo $card->render();
                echo $card->render();
                echo $card->render();
                echo $card->render();
                echo $card->render();
                echo $card->render();
                echo $card->render();
                echo $card->render();
                echo $card->render();
                echo $card->render();
                echo $card->render();
            } ?>
        </div>
    </main>
    <script>
        lucide.createIcons();
    </script>
</body>