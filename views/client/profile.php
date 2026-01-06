<?php
include '../../config/conn.php';
global $conn;

session_start();
$id_akun = $_SESSION['id_akun'];
//ambil sebagian data user yang tidak ada di $_SESSION
$stmt = mysqli_prepare($conn, "SELECT password FROM tb_akun WHERE id_akun = ?");
mysqli_stmt_bind_param($stmt, "s", $id_akun);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$data = [];

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
        <div class="max-w-4xl mx-auto">
            <header class="mb-8">
                <h1 class="text-4xl font-black">ADD NEW TOUR</h1>
                <p class="text-xl mt-2">TAMBAH WISATA BARU</p>
            </header>

            <div class="card p-6">
                <div class="flex">
                    <div class="border-r-2 pr-10">
                        <div class="mt-4">
                            <header class="mb-8">
                                <h1 class="text-4xl font-black">Data diri sekarang</h1>
                            </header>
                            <label class="text-sm font-semibold mb-2 flex items-center gap-2"
                                for="username">username</label>
                            <input
                                class="w-full border bg-gray-400 border-palette-3 rounded-lg px-4 py-3 focus:border-palette-4"
                                value="<?= $_SESSION['username'] ?>" readonly type="text">
                        </div>
                        <div class="mt-4">
                            <label class="text-sm font-semibold mb-2 flex items-center gap-2"
                                for="username">email</label>
                            <input
                                class="w-full border bg-gray-400 border-palette-3 rounded-lg px-4 py-3 focus:border-palette-4"
                                value="<?= $_SESSION['email'] ?>" readonly type="text">
                        </div>
                        <div class="mt-4">
                            <label class="text-sm font-semibold mb-2 flex items-center gap-2"
                                for="username">username</label>
                            <input
                                class="w-full border bg-gray-400 border-palette-3 rounded-lg px-4 py-3 focus:border-palette-4"
                                value="qeqeqe" readonly type="password">
                        </div>
                    </div>
                    <form class="ml-10" id="updateData">
                        <div class="mt-4">
                            <header class="mb-8">
                                <h1 class="text-4xl font-black">Perbarui Data diri</h1>
                            </header>
                            <label class="text-sm font-semibold mb-2 flex items-center gap-2"
                                for="newusername">username</label>
                            <input class="w-full border  border-palette-3 rounded-lg px-4 py-3 focus:border-palette-4"
                                name="newUsername" value="<?= $_SESSION['username'] ?>" type="text">
                        </div>
                        <div class="mt-4">
                            <label class="text-sm font-semibold mb-2 flex items-center gap-2"
                                for="newEmail">email</label>
                            <input class="w-full border  border-palette-3 rounded-lg px-4 py-3 focus:border-palette-4"
                                name="newEmail" value="<?= $_SESSION['email'] ?>" type="text">
                        </div>
                        <div class="mt-4">
                            <label for class="text-sm font-semibold mb-2 flex items-center gap-2" name="newPassword"
                                for="username">password</label>
                            <input class="w-full border border-palette-3 rounded-lg px-4 py-3 focus:border-palette-4"
                                name="newPassword" value="" type="password">
                        </div>
                        <div class="flex justify-end mt-5">
                            <input
                                class="bg-palette-3 text-white px-6 py-3 rounded-lg font-semibold hover:bg-palette-4 transition-all duration-300 flex items-center gap-2 "
                                type="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const form = document.getElementById("updateData")
        const formData = new FormData(form)

        form.addEventListener('submit', (e) => {
            e.preventDefault();

            Swal.fire({
                title: "Masukan password untuk konfirmasi",
                input: "password",
                inputLabel: "Password",
                inputPlaceholder: "rahasia12345",
                inputAttributes: {
                    autocapitalize: "off",
                    autocorrect: "off"
                },
                confirmButtonText: "Verify dan ubah",
                showLoaderOnConfirm: true,
                preConfirm: (Verifypassword) => {
                    // Ambil formData saat submit
                    const formData = new FormData(form);
                    formData.append('VerifyPassword', Verifypassword);

                    // Kirim ke server
                    return fetch('../../server/UPDATE_DATA_ACCOUNT.php', {
                        method: 'POST',
                        body: formData
                    })
                        .then(async res => {
                            const data = await res.json().catch(() => ({}));
                            if (!res.ok) {
                                throw new Error(data.message || 'Gagal diubah, cek password!');
                            }
                            return data;
                        })
                        .catch(err => {
                            Swal.showValidationMessage(err.message);
                        });
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Berhasil diubah",
                        icon: "success"
                    });
                }
            });
        });


    </script>
    <script>
        lucide.createIcons();

    </script>
</body>