<div class="mb-7">
    <a href="<?= $args['path']; ?>" class="uppercase text-2.5xl leading-tight group relative navlink">
        <img class="w-full mb-11" src="<?= $args['content']['featured_image_url']; ?>" alt="<?= $args['content']['title']; ?>" />
        <strong><?= $args['content']['title']; ?></strong>
        <span class="inline-block w-0 h-1 bg-white absolute -bottom-0.5 left-0 transition-all duration-500 ease-in-out group-hover:w-full navlink__underline"></span>
    </a>
</div>
<p class="text-2.5xl leading-tight max-w-[534px]"><?= $args['content']['short_description']; ?></p>
<ul class="mt-4">
    <?php foreach($args['content']['tags'] as $tag): ?>
        <li class="inline-block text-base lg:text-2xl text-lightgrey underline mr-2 last:mr-0 md:mr-9 md:last:mr-0">
            <?= $tag->name; ?>
        </li>
    <?php endforeach; ?>
</ul>