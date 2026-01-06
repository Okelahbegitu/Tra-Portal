<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="../output.css?v=<?php echo time(); ?>">


    <title>Proyek Tailwind</title>
</head>

<body>
    <header class="sticky top-0 z-50 bg-palette-3">
        <nav class="w-full flex justify-between text-white p-4">
            <h1 class="font-bold text-2xl">Tra-Portal</h1>
            <a href="signup.php" class="p-3 font-bold bg-palette-4 rounded-3xl">Login!</a>
        </nav>
    </header>

    <div class="swiper mt-10 relative">
        <div class="swiper-wrapper ">
            <!-- Slides -->
            <div class="swiper-slide">
                <img src="https://ik.imagekit.io/tvlk/blog/2022/11/Telaga-Tulung-Ni-Lenggo-Wisata-Kalimantan-Timur-Shutterstock.jpg?tr=q-70,c-at_max,w-1000,h-600"
                    class="brightness-50 w-full h-120 object-cover">
            </div>
            <div class="swiper-slide">
                <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/05/f4/e1/a9/derawan-archipelago.jpg?w=600&h=600&s=1"
                    class="brightness-50 w-full h-120 object-cover">
            </div>
            <div class="swiper-slide">
                <img src="https://ik.imagekit.io/tvlk/blog/2022/11/Labuan-Cermin-Wisata-Kalimantan-Timur-Shutterstock.jpg?tr=q-70,c-at_max,w-1000,h-600"
                    class="brightness-50 w-full h-120 object-cover">
            </div>
        </div>
        <!-- If we need pagination -->
        <div class="brand-pagination mt-4 flex gap-2 absolute bottom-4 z-10 justify-center"></div>
        <div class="absolute bottom-50 w-full text-center transition-all duration-700 ease-out text-white z-20">
            <div class="opacity-0  transition-all duration-700 translate-y-6" id="slogan">
                <h2 class="font-bold text-6xl">Kenyamanan anda adalah kenyaman kami juga!</h2>
                <div class="mt-8">
                    <a href=" #"
                        class="rounded-full border px-2.5 border-white hover:bg-white hover:text-black bg-transparent">Pelajari
                        lebih lanjut -> </a>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-palette-3 flex  text-white p-4 font-bold justify-center">
        <h1 class="text-white">Jelajahi</h1>
    </div>
    <div class="flex justify-between">
        <div class="card w-auto h-auto m-2 p-4 ">
            <img class="block" width="510" height="270" src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/09/58/e5/76/pantai-lamaru.jpg">
            <h3 class="text-3xl">Pantai Lamaru</h3>
            <h2 class="text-4xl font-bold">Rp 1.000.000</h2>
            <div class="flex justify-end">
                <a href="detailclient.php?nama=Pantai+Lamaru
                &harga=1000000
                &gambar=https://dynamic-media-cdn.tripadvisor.com/media/photo-o/09/58/e5/76/pantai-lamaru.jpg
                &deskripsi=Pantai+Lamaru+adalah+destinasi+wisata+terbaik+dengan+pemandangan+sunset+yang+luar+biasa.
                &lokasi=Balikpapan" class="flex p-3 mt-3 font-bold bg-palette-4 rounded-3xl text-white">
                    Pesan
                </a>


            </div>

        </div>
        <div class="card w-auto h-auto m-2 p-4 ">
            <img class="block" width="510" height="270" src="https://kaltimtoday.co/wp-content/uploads/2020/02/1-512x270.png">
            <h3 class="text-3xl">Muesum Mulawarman</h3>
            <h2 class="text-4xl font-bold">Rp 1.000.000</h2>
            <div class="flex justify-end">
                <a href="detailclient.php?nama=Museum+Mulawarman&harga=1000000&gambar=https://kaltimtoday.co/wp-content/uploads/2020/02/1-512x270.png&deskripsi=Wisata+sejarah+dan+budaya+Kalimantan+Timur&lokasi=Tenggarong"
                    class="flex  p-3 mt-3 font-bold bg-palette-4 rounded-3xl text-white">
                    Pesan
                </a>
            </div>

        </div>
        <div class="card w-auto h-auto m-2 p-4 ">
            <img class="block" width="510" height="270" src="https://lh3.googleusercontent.com/gps-cs-s/AG0ilSxUEshhZ9v4v6We0E8yKH8QSi5iRz0Sz5EHVOx22bfKYny9XGgGSH3vlsnGEaGB4bksVw7LmsHzaV812VbhM2xsCYvZRBOlg0ViXWNV5SyVnrreMRl0qEsa9Q9i_RymOPkGZTOfFW4E-6zu=w810-h468-n-k-no">
            <h3 class="text-3xl">Gunung Liangpran</h3>
            <h2 class="text-4xl font-bold">Rp 1.000.000</h2>
            <div class="flex justify-end">
                <a href="detailclient.php?nama=Gunung+Liangpran&harga=1000000&gambar=https://lh3.googleusercontent.com/gps-cs-s/AG0ilSxUEshhZ9v4v6We0E8yKH8QSi5iRz0Sz5EHVOx22bfKYny9XGgGSH3vlsnGEaGB4bksVw7LmsHzaV812VbhM2xsCYvZRBOlg0ViXWNV5SyVnrreMRl0qEsa9Q9i_RymOPkGZTOfFW4E-6zu=w810-h468-n-k-no&lokasi=Kalimantan+Timur&deskripsi=Gunung+Liangpran+adalah+destinasi+wisata+alam+terbaik+dengan+pemandangan+pegunungan+yang+indah."
                    class="flex  p-3 mt-3 font-bold bg-palette-4 rounded-3xl text-white">
                    Pesan
                </a>
            </div>

        </div>
    </div>

    <div class="bg-palette-4 text-center h-50 text-white">
        <h1 class="text-5xl font-bold ">Tentang Kami</h1>
        <p class="mt-6">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
            labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
            aliquip ex
            ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
            dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
            deserunt mollit anim id est laborum.</p>
    </div>
    <div class="flex justify-center mt-7 ">
        <a href="#" class="p-3 font-bold bg-palette-1 text-center  rounded-3xl">Checkout sekarang!</a>
    </div>
    <div class="bg-gray-400 w-auto h-10 mt-8"></div>

    <?php if (empty($reviews)): ?>

        <div class="grid grid-cols-3 gap-2.5">

            <div class="card w-auto h-auto m-2 p-4 ">
                <div class="flex justify-start items-center">
                    <div class="rounded-full bg-amber-200 w-15 h-15"></div>
                    <h2 class="text-4xl font-bold ml-2">Name</h2>
                </div>
                <div class="flex justify-end">
                    <a href="#" class="flex  p-3 mt-3 font-bold bg-palette-4 rounded-3xl text-white">
                        Pesan
                    </a>
                </div>

            </div>
        </div>
    <?php else: ?>
        <div class="h-100 flex justify-center text-center items-center">
            <h2>Belum ada review :(</h2>
        </div>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>

        const btnlearn = document.getElementById('btn-learn')
        const slogan = document.getElementById('slogan');
        let translateY = 6; // awal posisi translate-y
        let opacity = 0;    // awal opacity
        setTimeout(() => {

            const interval = setInterval(() => {

                // animasi naik
                if (translateY > 0) translateY -= 0.1;

                // animasi fade in
                if (opacity < 1) opacity += 0.02;

                // update style
                slogan.style.transform = translateY(${translateY}rem);
                slogan.style.opacity = opacity;

                // hentikan interval jika sudah selesai
                if (translateY <= 0 && opacity >= 1) {
                    slogan.classList.remove('opacity-0', 'translate-y-8');
                    clearInterval(interval);
                }
            }, 16); // <-- tutup setInterval di sini

        }, 200); // <-- jeda 1 detik sebelum animasi mulai

        const swiper = new Swiper('.swiper', {
            loop: true,
            autoplay: {
                delay: 3000,
            },
            pagination: {
                el: '.brand-pagination',
                clickable: true,
                bulletClass: 'brand-bullet',
                bulletActiveClass: 'brand-bullet-active',
            }
            ,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>

</body>


</html>


</html>