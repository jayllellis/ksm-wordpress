<?php
/*--------------------------------------------------------------
* Custom login logo, url & title
--------------------------------------------------------------*/
function ksm_login_logo() { ?>

  <style type="text/css">
  body.login div#login h1 a {
    background-image: url('<?= ksm_custom_logo_url(); ?>');
    width: 200px;
    height: 72px;
    background-size: 200px auto;
  }
  </style>
<?php }
add_action( 'login_enqueue_scripts', 'ksm_login_logo' );

function ksm_login_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'ksm_login_url' );

function ksm_login_url_title() {
    return get_bloginfo( 'name' );
}

add_filter( 'login_headertext', 'ksm_login_url_title' );

/*--------------------------------------------------------------
* Hide admin bar after login
--------------------------------------------------------------*/
// add_filter('show_admin_bar', '__return_false');
