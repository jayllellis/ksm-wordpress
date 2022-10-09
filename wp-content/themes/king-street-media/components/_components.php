<?php

switch ( get_row_layout() ) {
    case 'all_work':
        get_template_part('components/all-work');
    break;

    case 'callout_text':
        get_template_part('components/callout-text');
    break;

    case 'contact_form':
        get_template_part('components/contact-form');
    break;

    case 'fullwidth_image':
        get_template_part('components/fullwidth-image');
    break;

    case 'header_nav':
        get_template_part('components/header-nav');
    break;

    case 'hero_section':
        get_template_part('components/hero-section');
    break;

    case 'image_collage':
        get_template_part('components/image-collage');
    break;

    case 'image_grid_carousel':
        get_template_part('components/image-grid-carousel');
    break;

    case 'newsletter_and_contact_tile':
        get_template_part('components/newsletter-contact-tile');
    break;

    case 'spacer':
        get_template_part('components/spacer');
    break;

    case 'team_tile':
        get_template_part('components/hero-section/team-tile');
    break;

    case 'text_with_image':
        get_template_part('components/text-with-image');
    break;

    case 'two_column_with_cta':
        get_template_part('components/two_col-cta');
    break;

    case 'two_column_list':
        get_template_part('components/two_col-list');
    break;

    case 'two_column_text':
        get_template_part('components/two_col-text');
    break;

    case 'work_preview':
        get_template_part('components/work-preview');
    break;
}