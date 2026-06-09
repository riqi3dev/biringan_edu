<?php 

    // mu-plugins, stands for 'Must Use Plugins' cannot be deactivated but is strictly being used by wordpress
    // this specific plugin will be utilized for custom posts types
    // handles custom post types
    function university_event_type() {
        register_post_type('event', array(
            'public' => true,
            'labels' => array(
                'name' => 'Events',
                'add_new_item' => 'Add New Event',
                'edit_item' => 'Edit Event',
                'all_items' => 'All Events',
                'singular_name' => 'Event'
            ),
            'menu_icon' => 'dashicons-calendar',
        ));
    }
    add_action('init', 'university_event_type');

?>