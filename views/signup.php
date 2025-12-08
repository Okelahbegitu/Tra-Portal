<?php
include '../config/conn.php';
global $conn;
if (isset($_POST['signup'])) {
    $Checkquery = mysqli_prepare($conn, "SELECT * FROM tb_akun WHERE username = ? OR email = ?");

    mysqli_stmt_bind_param($Checkquery, 'ss', $_POST['username'], $_POST['email']);
    
    mysqli_stmt_execute($Checkquery);

    mysqli_stmt_store_result($Checkquery);

    $exist = mysqli_stmt_num_rows($Checkquery) > 0;

    if (!$exist){
        try{
        $id = "U-". date("Y-m-d"). "-" . rand(1000, 9999);
        $query = mysqli_prepare($conn,"INSERT INTO tb_akun values (?, ?, ?, ?, ?)");
        $role = "user";
        mysqli_stmt_bind_param($query, "sssss", $id,$_POST['username'], $_POST['email'], $_POST['password'], $role);
        mysqli_stmt_execute($query);
        //header("Refresh: 0.1; url=adminpanel.php");
        echo "alert('berhasil dibuat!')";
        } catch(mysqli_sql_exception $e){
            echo $e;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Tra-Portal</title>
    <link rel="stylesheet" href="../output.css?v=<?php echo time(); ?>">
</head>

<body>
    <header class="sticky top-0 z-50 bg-palette-3">
        <nav class="w-full flex justify-between text-white p-4">
            <h1 class="font-bold text-2xl">Tra-Portal</h1>
            <a href="index.php" class="p-3 font-bold bg-palette-4 rounded-3xl">Home</a>
        </nav>
    </header>

    <div class="flex justify-between">
        <div class="bg-palette-2 w-150">
            <h1 class="text-4xl md:text-5xl font-black text-palette-4 mb-4">HELLO THERE</h1>
            <p class="text-xl text-palette-3 mb-8">Create your account</p>

            <form class="m-10" method="post">
                <div>
                    <label for="username" class="block text-palette-4 text-sm font-semibold mb-2">Username</label>
                    <input type="text" id="username" name="username" required
                        class="w-full form-input px-4 py-3 border border-palette-3 rounded-lg bg-white text-gray-900 focus:border-palette-4">
                </div>

                <div>
                    <label for="email" class="block text-palette-4 text-sm font-semibold mb-2">Email</label>
                    <input type="email" id="email" name="email" required
                        class="w-full form-input px-4 py-3 border border-palette-3 rounded-lg bg-white text-gray-900 focus:border-palette-4">
                </div>

                <div>
                    <label for="password" class="block text-palette-4 text-sm font-semibold mb-2">Password</label>
                    <input type="password" id="password" name="password" required
                        class="w-full form-input px-4 py-3 border border-palette-3 rounded-lg bg-white text-gray-900 focus:border-palette-4">
                </div>
                <a href="signin.php">Sudah punya akun?</a>
                <button type="submit" name="signup"
                    class="w-full py-3 bg-palette-4 text-white text-base font-bold rounded-lg cursor-pointer hover:bg-opacity-90 transition-all duration-300 mt-6">
                    Register
                </button>
            </form>
        </div>
        <div class="w-full">
            <img class="w-full h-auto"
                src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/0d/d2/f8/45/photo3jpg.jpg?w=1400&h=800&s=1">
        </div>
    </div>
</body>

</html>