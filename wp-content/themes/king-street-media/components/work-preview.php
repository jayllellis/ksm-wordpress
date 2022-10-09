<?php $projects = get_work_preview_items(); ?>

<section id="<?php the_sub_field('component_id'); ?>" class="projects-preview pb-15 md:pb-24 lg:pb-32">
      <div class="projects-wrap md:flex flex-wrap justify-end md:gap-y-15 lg:gap-y-45 px-5 md:px-8">
        <?php
        $counter = 0;
        foreach($projects as $project):
        ?>
            <div class="size-<?= $project['content']['container_size']; ?> scrolltrigger-<?= $counter; ?> animate fade-in-grow mb-9 md:mb-0">
              <?php get_template_part('components/inc/project-snippet', '', $project); ?>
            </div>
        <?php $counter++; endforeach; ?>
      </div>
    <div class="mt-15 md:mt-24 lg:mt-45">
    <p class="text-center">
        <a href="/work" class="text-2xl text-lightgrey ml-6 first:ml-0 group relative navlink">
            <span>More Projects</span>
            <span class="inline-block w-0 h-0.5 bg-lightgrey absolute -bottom-0.5 left-0 transition-all duration-500 ease-in-out group-hover:w-full navlink__underline"></span>
        </a>
    </p>
    </div>
</section>