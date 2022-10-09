<?php 
$hero_image = wp_get_attachment_image_src( get_sub_field('hero_image'), 'full' );
$logo = wp_get_attachment_image_src( get_sub_field('logo'), 'full' );
?>

<section class="w-full h-[49.44vw] max-h-[940px] mb-35 md:mb-[225px] lg:mb-[347px] mt-15 md:mt-0 animate slide-from-bottom" style="background: url('<?= $hero_image[0]; ?>') center center / cover no-repeat;">
  <div class="mx-auto w-full max-w-6xl h-full relative px-4 md:px-14">
    <div class="hidden md:block md:float-right md:mt-14 absolute md:static -top-15 left-0 w-full md:w-auto h-15 md:h-auto">
      <?php get_template_part('components/inc/navigation'); ?>
    </div>
    <div class="md:hidden absolute -top-15 left-0 w-full z-50">
      <?php get_template_part('components/inc/mobile-nav'); ?>
    </div>
    <img class="absolute left-1/2 -bottom-[100px] md:-bottom-[184px] -translate-x-1/2 max-w-xs md:max-w-2xl lg:max-w-none" src="<?= $logo[0]; ?>" alt="King Street Media logo" />
  </div>
</section>