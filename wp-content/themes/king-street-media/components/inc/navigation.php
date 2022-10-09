<?php
$main_menu = get_menu_items('main-nav');
?>

<nav>
    <ul>
    <?php foreach($main_menu as $menu_item): ?>
        <li class="inline-block ml-6 first:ml-0">
            <a href="<?= $menu_item->slug; ?>" class="font-sans font-semibold text-lg md:text-2xl text-white group relative navlink">
                <span><?= $menu_item->title; ?></span>
                <span class="inline-block w-0 h-1 bg-white absolute -bottom-0.5 left-0 transition-all duration-500 ease-in-out group-hover:w-full navlink__underline"></span>
            </a>
        </li>
    <?php endforeach; ?>
    </ul>
</nav>