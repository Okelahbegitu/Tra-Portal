<?php $page = basename($_SERVER['PHP_SELF']); ?>
<aside class="w-50 bg-palette-4 text-white flex flex-col p-4 min-h-full">
    <div>
        <div class="text-2xl font-black mb-2">TOUR ADMIN</div>
        <div class="text-sm font-semibold mb-8">ADMINISTRATION PANEL</div>

        <nav class="mt-6">
            <ul class="flex flex-col gap-2.5">
                <li>
                    <a href="adminpanel.php"
                        class="flex items-center gap-2.5 p-3 rounded-lg <?= $page == "adminpanel.php" ? 'bg-palette-3' : '' ?> w-full">
                        <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                        <span>DASHBOARD</span>
                    </a>
                </li>
                <li>
                    <a href="tourmanage.php"
                        class="flex items-center gap-2.5 p-3 <?= $page == "tourmanage.php" ? 'bg-palette-3' : '' ?> rounded-lg w-full">
                        <i data-lucide="map-pin" class="w-5 h-5"></i>
                        <span>TOUR MANAGE</span>
                    </a>
                </li>
                <li>
                    <a href="orderlist.php" class="flex items-center gap-2.5 p-3 <?= in_array($page, ["orderlist.php", "addtour.php"]) ? 'bg-palette-3' : '' ?>
 rounded-lg w-full">
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
            <span><?=$_SESSION['username']?></span>
        </div>
        <a href="../../signin.php"
            class="flex items-center gap-2.5 p-3 rounded-lg w-full bg-red-800 text-white hover:bg-white hover:text-black transition-all duration-300">
            <i data-lucide="log-out" class="w-5 h-5"></i>
            <span>LOGOUT</span>
        </a>
    </div>
</aside>