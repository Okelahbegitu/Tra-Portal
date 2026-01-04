<?php $page = basename($_SERVER['PHP_SELF']); ?>
<aside class="w-50 bg-palette-4 text-white flex flex-col p-4 min-h-screen">

    <div>
        <div class="text-2xl font-black mb-2">Tra-Portal</div>
        <div class="text-sm font-semibold mb-8"></div>

        <nav class="mt-6">
            <ul class="flex flex-col gap-2.5">
                <li>
                    <a href="home.php"
                        class="flex items-center gap-2.5 p-3 rounded-lg <?= $page == "home.php" || $page == "detail.php" || $page == "category.php" ? 'bg-palette-3' : '' ?> w-full">
                        <i data-lucide="house" class="w-5 h-5"></i>
                        <span>Home</span>
                    </a>
                </li>
                <li>
                    <a href="order.php"
                        class="flex items-center gap-2.5 p-3 <?= $page == "order.php" ? 'bg-palette-3' : '' ?> rounded-lg w-full">
                        <i data-lucide="list-ordered" class="w-5 h-5"></i>
                        <span>Pesanan</span>
                    </a>
                </li>
                <li>
                    <a href="orderlist.php" class="flex items-center gap-2.5 p-3 <?= in_array($page, ["orderlist.php", "addtour.php"]) ? 'bg-palette-3' : '' ?>
 rounded-lg w-full">
                        <i data-lucide="settings" class="w-5 h-5"></i>
                        <span>Penggaturan</span>
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
            <span>JAWA</span>
        </div>
        <a href="index.php"
            class="flex items-center gap-2.5 p-3 rounded-lg w-full bg-red-800 text-white hover:bg-white hover:text-black transition-all duration-300">
            <i data-lucide="log-out" class="w-5 h-5"></i>
            <span>LOGOUT</span>
        </a>
    </div>
</aside>