<?php $projects = get_work_preview_items(-1); ?>

<section id="<?php the_sub_field('component_id'); ?>" class="component--all-work projects-preview pb-32">
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
</section>