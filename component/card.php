<?php
class Card
{
    private $img;
    private $id;
    private $title;
    private $price;

    function __construct($id, $title, $price, $img)
    {
        $this->id = $id;
        $this->title = $title;
        $this->price = $price;
        $this->img = $img;
    }

    function render()
    {
        $title = htmlspecialchars($this->title);
        $price = htmlspecialchars($this->price);
        $img = htmlspecialchars($this->img);
        $id = urlencode($this->id);

return <<<HTML
    <div class="w-full sm:w-[250px] md:w-[280px] lg:w-[300px] bg-palette-3 rounded-xl overflow-hidden">
        <img src="../../$img" class="w-full aspect-[3/2] object-cover" alt="">
        <div class="p-4 space-y-2">
            <p class="font-semibold text-base md:text-lg">$title</p>
            <p class="text-sm text-gray-700">$price</p>
            <a href='detail.php?id=$id'
               class="inline-block bg-palette-2 text-black px-4 py-2 rounded-md text-sm w-full md:w-auto text-center">
                Check-out
            </a>
        </div>
    </div>
    HTML;
    }

}

?>