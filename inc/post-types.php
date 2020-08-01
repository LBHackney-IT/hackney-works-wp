<?php

function lbh_custom_post_types_init() {
    register_post_type("hub", array(
        "label" => __("Hubs"),
        "public" => true,
        "menu_icon" => "dashicons-location",
        "show_in_nav_menus"     => true,
        "supports" => array("title")
    ));

    register_post_type("course", array(
        "label" => __("Courses"),
        "public" => true,
        "menu_icon" => "dashicons-welcome-learn-more",
        "show_in_nav_menus" => true,
        "show_in_rest" => true,
        "supports" => array("title", "thumbnail")
    ));

    register_post_type("intake", array(
        "label" => __("Intakes"),
        "public" => true,
        "menu_icon" => "dashicons-groups",
        "show_in_nav_menus" => true,
        "show_in_rest" => true,
        "supports" => false,
        "rewrite" => array(
            "slug" => "apply"
        )
    ));

    register_post_type("testimonial", array(
        "label" => __("Testimonials"),
        "public" => true,
        "menu_icon" => "dashicons-format-quote",
        "show_in_nav_menus" => true,
        "show_in_rest" => true,
        "supports" => array("title", "editor", "thumbnail")
    ));
}
add_action("init", "lbh_custom_post_types_init");

// Don't use the gutenberg editor for testimonials
function lbh_disable_gutenberg_posts( $current_status, $post_type ) {
    $disabled_post_types = array( 'testimonial' );
    if ( in_array( $post_type, $disabled_post_types, true ) ) {
        $current_status = false;
    }
    return $current_status;
}
add_filter( 'use_block_editor_for_post_type', 'lbh_disable_gutenberg_posts', 10, 2 );

// Add the custom columns to the intake post type:
function lbh_set_intake_columns($columns) {
    return array(
        'title' => "Title",
        'course' => "Parent course",
        'days' => "Days",
        'times' => "Times",
        'date' => "Date"
    );
}
add_filter( 'manage_intake_posts_columns', 'lbh_set_intake_columns' );

// Add the data to the custom columns for the book post type:
function lbh_custom_admin_columns( $column, $post_id ) {
    switch ( $column ) {
        case 'course' :
            $parent = get_post_meta( $post_id , 'parent_course' , true );
            echo "<a href='" . get_edit_post_link($parent) . "'>";
            echo get_the_title($parent);
            echo "</a>";
            break;
        case "days":
            the_field("days", $post_id);
            break;
        case "times":
            echo get_field("start_time", $post_id) . " to " .  get_field("end_time", $post_id);
            break;
    }
}
add_action( 'manage_intake_posts_custom_column' , 'lbh_custom_admin_columns', 10, 2 );