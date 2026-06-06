<?php 
    function biringan_univ_files () {
        wp_enqueue_style('uni_styles', get_stylesheet_uri());
    }

    add_action('wp_enqueue_scripts', 'biringan_univ_files'); 
?>