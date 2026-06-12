<?php 

    // handles the styling and logic
    function biringan_univ_files () {
        wp_enqueue_style('university_main_styles', get_theme_file_uri('/build/style-index.css'));
        wp_enqueue_style('university_extra_styles', get_theme_file_uri('/build/index.css'));
        wp_enqueue_style('custom-google-fonts', 'fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
        wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
        wp_enqueue_script('main_javascript', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
    }

    // handles additional features to the theme
    function university_features() {
        add_theme_support('title-tag');
        register_nav_menu('headerMenuLocation', 'Header Menu Location');
        register_nav_menu('footerLocation1', 'Footer Menu Location 1');
        register_nav_menu('footerLocation2', 'Footer Menu Location 2');
    }

    function dynamic_nav_menu_highlight(array $classes, $item) { 
        // 1. Get the post type of the page currently being viewed
        $current_post_type = get_post_type();

        // 2. PROTECT THE BLOG: If we are viewing a Custom Post Type (like 'event' or 'campus')
        // and NOT a standard blog post, stop the Blog menu item from accidentally lighting up.
        if ($current_post_type && !in_array($current_post_type, array('post', 'page'))) {
            if ($item->object === 'post') {
                return array_diff($classes, array('current_page_parent', 'current-menu-parent', 'current-menu-ancestor'));
            }
        }

        // 3. FORCE CPT HIGHLIGHT: If the menu item explicitly points to the custom post type archive we are viewing
        if ($current_post_type && $item->object === $current_post_type) {
            $classes[] = 'is-active';
        }

        // 4. APPLY CUSTOM CLASS: If WordPress naturally flags this item as active, a parent, or an ancestor
        // (which single.php will now trigger natively for standard posts), append your clean class.
        if (in_array('current-menu-item', $classes) || 
            in_array('current_page_parent', $classes) || 
            in_array('current-menu-ancestor', $classes) ||
            in_array('current-page-ancestor', $classes)) {
        
            $classes[] = 'is-active'; // The uniform class you style in your CSS
        }

        return array_unique($classes);
    }

    // execute  functions
    add_action('wp_enqueue_scripts', 'biringan_univ_files'); 
    add_action('after_setup_theme', 'university_features');
    add_filter('nav_menu_css_class', 'dynamic_nav_menu_highlight', 10, 2);
?>