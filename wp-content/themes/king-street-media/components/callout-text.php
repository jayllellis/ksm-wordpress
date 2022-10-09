<?php
$title = get_sub_field('title');
$description = get_sub_field('description');
$link = get_sub_field('link');
?>

<section id="<?php the_sub_field('component_id'); ?>" className="component--callout-text my-15 md:my-26 max-w-wrapper mx-auto px-5 lg:px-2 animate slide-from-bottom">
    <strong className="text-3xl leading-normal md:text-5.5xl font-normal md:leading-[4.1875rem]"><?= $title; ?></strong>
        <p className="text-1.5xl leading-10"><?= $description; ?></p>
        <p className="mt-7">
            <a href="<?= $link['url']; ?>" className="text-lg md:text-2xl text-lightgrey ml-6 first:ml-0 group relative navlink">
                <span><?= $link['title']; ?></span>
                <span className="inline-block w-0 h-0.5 bg-lightgrey absolute -bottom-0.5 left-0 transition-all duration-500 ease-in-out group-hover:w-full navlink__underline"></span>
            </a>
        </p>
      }
</section>