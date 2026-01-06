<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="../output.css?v=<?php echo time(); ?>">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Proyek Tailwind - Tra-Portal</title>
</head>

<body class="bg-gray-50 font-sans text-gray-900">
    <header class="sticky top-0 z-50 bg-palette-3 shadow-md">
        <nav class="container mx-auto flex justify-between items-center p-4">
            <h1 class="font-bold text-2xl text-white tracking-tight">Tra-Portal</h1>
            <a href="signup.php" class="px-6 py-2 font-bold bg-palette-4 text-white rounded-full hover:bg-opacity-90 transition shadow-sm">Login!</a>
        </nav>
    </header>

    <div class="swiper relative w-full h-[500px] md:h-[600px]">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="https://ik.imagekit.io/tvlk/blog/2022/11/Telaga-Tulung-Ni-Lenggo-Wisata-Kalimantan-Timur-Shutterstock.jpg?tr=q-70,c-at_max,w-1000,h-600"
                    class="brightness-50 w-full h-full object-cover">
            </div>
            <div class="swiper-slide">
                <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/05/f4/e1/a9/derawan-archipelago.jpg?w=600&h=600&s=1"
                    class="brightness-50 w-full h-full object-cover">
            </div>
            <div class="swiper-slide">
                <img src="https://ik.imagekit.io/tvlk/blog/2022/11/Labuan-Cermin-Wisata-Kalimantan-Timur-Shutterstock.jpg?tr=q-70,c-at_max,w-1000,h-600"
                    class="brightness-50 w-full h-full object-cover">
            </div>
        </div>

        <div class="absolute inset-0 flex items-center justify-center z-20 text-center px-4">
            <div class="opacity-0 transition-all duration-700 translate-y-6 max-w-4xl" id="slogan">
                <h2 class="font-bold text-4xl md:text-6xl text-white drop-shadow-lg">Kenyamanan anda adalah kenyaman kami juga!</h2>
                <div class="mt-8">
                    <a href="#" class="inline-block rounded-full border-2 border-white px-8 py-3 text-white font-semibold hover:bg-white hover:text-black transition-all">
                        Pelajari lebih lanjut &rarr;
                    </a>
                </div>
            </div>
        </div>
        
        <div class="brand-pagination absolute bottom-6 left-0 right-0 flex justify-center gap-2 z-30"></div>
    </div>

    <div class="bg-palette-3 py-6 shadow-inner">
        <h2 class="text-white text-center text-2xl font-bold tracking-widest uppercase">Jelajahi</h2>
    </div>

    <main class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow border border-gray-100">
                <img class="w-full aspect-video object-cover" src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/09/58/e5/76/pantai-lamaru.jpg">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800">Pantai Lamaru</h3>
                    <h2 class="text-2xl font-black text-palette-4 mt-2">Rp 1.000.000</h2>
                    <div class="flex justify-end mt-6">
                        <a href="detail.php?nama=Pantai+Lamaru&harga=1000000&gambar=https://dynamic-media-cdn.tripadvisor.com/media/photo-o/09/58/e5/76/pantai-lamaru.jpg&deskripsi=Pantai+Lamaru+adalah+destinasi+wisata+terbaik+dengan+pemandangan+sunset+yang+luar+biasa.&lokasi=Balikpapan" 
                           class="px-6 py-2 font-bold bg-palette-4 text-white rounded-xl hover:bg-opacity-90 transition">
                            Pesan
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow border border-gray-100">
                <img class="w-full aspect-video object-cover" src="https://kaltimtoday.co/wp-content/uploads/2020/02/1-512x270.png">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800">Museum Mulawarman</h3>
                    <h2 class="text-2xl font-black text-palette-4 mt-2">Rp 1.000.000</h2>
                    <div class="flex justify-end mt-6">
                        <a href="detail.php?nama=Museum+Mulawarman&harga=1000000&gambar=https://kaltimtoday.co/wp-content/uploads/2020/02/1-512x270.png&deskripsi=Wisata+sejarah+dan+budaya+Kalimantan+Timur&lokasi=Tenggarong"
                            class="px-6 py-2 font-bold bg-palette-4 text-white rounded-xl hover:bg-opacity-90 transition">
                            Pesan
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow border border-gray-100">
                <img class="w-full aspect-video object-cover" src="https://img.okezone.com/okz/500/library/images/2023/08/10/02dylna96ichqp8itmhp_20602.jpg">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800">Gunung Liangpran</h3>
                    <h2 class="text-2xl font-black text-palette-4 mt-2">Rp 1.000.000</h2>
                    <div class="flex justify-end mt-6">
                        <a href="detail.php?nama=Gunung+Liangpran&harga=1000000&gambar=https://img.okezone.com/okz/500/library/images/2023/08/10/02dylna96ichqp8itmhp_20602.jpg&lokasi=Kalimantan+Timur&deskripsi=Gunung+Liangpran+adalah+destinasi+wisata+alam+terbaik+dengan+pemandangan+pegunungan+yang+indah."
                            class="px-6 py-2 font-bold bg-palette-4 text-white rounded-xl hover:bg-opacity-90 transition">
                            Pesan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <section class="bg-palette-4 py-16 text-white text-center shadow-inner">
        <div class="container mx-auto px-6 max-w-4xl">
            <h2 class="text-4xl font-bold mb-6">Tentang Kami</h2>
            <p class="text-lg leading-relaxed opacity-90">
                Sebagai penyedia layanan transportasi dan paket wisata unggulan di Kalimantan Timur, Tra-Portal berkomitmen menghadirkan pengalaman perjalanan yang aman, tepat waktu, dan berkelas. 
                Dengan armada yang selalu prima dan kru profesional, kami memastikan setiap detik perjalanan Anda berlangsung tanpa kendala, karena kenyamanan Anda adalah prioritas nomor satu kami.
            </p>
            <div class="mt-10">
                <a href="#" class="px-10 py-4 font-bold bg-palette-3 text-white rounded-full shadow-lg hover:brightness-110 transition-all inline-block">
                    Checkout sekarang!
                </a>
            </div>
        </div>
    </section>

    <div class="bg-gray-200 w-full h-px my-12 container mx-auto"></div>

<section class="container mx-auto px-6 py-24 border-t border-gray-50">
        <div class="max-w-6xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
                <div class="text-left">
                    <h2 class="text-3xl font-bold text-gray-800 tracking-tight">Ulasan Penjelajah</h2>
                    <p class="text-palette-4 font-medium mt-1">Apa yang mereka rasakan bersama Tra-Portal</p>
                </div>
                <a href="#" class="px-6 py-2.5 text-xs font-bold bg-gray-50 text-gray-600 rounded-full hover:bg-palette-4 hover:text-white transition-all tracking-widest uppercase border border-gray-100">
                    + Berikan Ulasan
                </a>
            </div>

            <?php if (empty($reviews)): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    
                    <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl hover:shadow-gray-200/50 transition-all duration-300 flex flex-col group">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 rounded-2xl bg-palette-4/10 flex items-center justify-center text-palette-4 font-bold">
                                AR
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800 leading-none text-sm">Ananda Rizky</h4>
                                <p class="text-[10px] text-gray-400 uppercase mt-1.5 tracking-wider">Berau, Kalimantan Timur</p>
                            </div>
                        </div>
                        
                        <p class="text-gray-600 leading-relaxed text-sm italic mb-6 flex-grow">
                            "Layanan yang sangat memuaskan dan tepat waktu. Unit kendaraan sangat bersih dan driver sangat profesional memahami rute."
                        </p>
                    </div>

                    <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl hover:shadow-gray-200/50 transition-all duration-300 flex flex-col group">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 rounded-2xl bg-palette-3/10 flex items-center justify-center text-palette-3 font-bold">
                                BS
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800 leading-none text-sm">Budi Santoso</h4>
                                <p class="text-[10px] text-gray-400 uppercase mt-1.5 tracking-wider">Berau, Kalimantan Timur</p>
                            </div>
                        </div>
                        
                        <p class="text-gray-600 leading-relaxed text-sm italic mb-6 flex-grow">
                            "Pengalaman luar biasa mengeksplorasi Kalimantan Timur. Proses pemesanan sangat mudah dan admin sangat responsif."
                        </p>
                        
                    </div>

                    <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl hover:shadow-gray-200/50 transition-all duration-300 flex flex-col group">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 rounded-2xl bg-gray-100 flex items-center justify-center text-gray-400 font-bold">
                                RE
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800 leading-none text-sm">Robert Evans</h4>
                                <p class="text-[10px] text-gray-400 uppercase mt-1.5 tracking-wider">Balikpapan, Kalimantan Timur</p>
                            </div>
                        </div>
                        
                        <p class="text-gray-600 leading-relaxed text-sm italic mb-6 flex-grow">
                            "Sangat direkomendasikan untuk kunjungan bisnis. Ketepatan waktu dan kenyamanan mobil Hiace mereka luar biasa."
                        </p>
                       

                </div>
            <?php else: ?>
                <div class="text-center py-10">
                    <p class="text-gray-400 italic">Memuat ulasan lainnya...</p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <footer class="bg-gray-400 w-full h-12 flex items-center justify-center text-white text-sm">
        &copy; 2024 Tra-Portal Team
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        // Animasi Slogan
        const slogan = document.getElementById('slogan');
        let translateY = 6;
        let opacity = 0;
        setTimeout(() => {
            const interval = setInterval(() => {
                if (translateY > 0) translateY -= 0.1;
                if (opacity < 1) opacity += 0.02;
                slogan.style.transform = `translateY(${translateY}rem)`;
                slogan.style.opacity = opacity;
                if (translateY <= 0 && opacity >= 1) {
                    slogan.classList.remove('opacity-0');
                    clearInterval(interval);
                }
            }, 16);
        }, 200);

        // Swiper Initialization
        const swiper = new Swiper('.swiper', {
            loop: true,
            autoplay: { delay: 3000 },
            pagination: {
                el: '.brand-pagination',
                clickable: true,
                bulletClass: 'brand-bullet inline-block w-3 h-3 bg-white/50 rounded-full mx-1 cursor-pointer',
                bulletActiveClass: '!bg-white !w-6 transition-all rounded-lg',
            },
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