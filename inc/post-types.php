<?php

function lbh_custom_post_types_init() {
    register_post_type("hub", array(
        "label" => __("Hubs"),
        "public" => false,
        "show_ui" => true,
        "menu_icon" => "dashicons-location",
        "supports" => array("title")
    ));

    register_post_type("event", array(
        "label" => __("Events"),
        "public" => true,
        "menu_icon" => "dashicons-calendar-alt",
        "show_in_rest" => true,
        "supports" => array("title", "revisions", "author")
    ));

    register_post_type("vacancy", array(
        "label" => __("Vacancies"),
        "public" => true,
        "menu_icon" => "dashicons-coffee",
        "show_in_rest" => true,
        "supports" => array("title", "revisions", "author")
    ));

    register_post_type("checklist_item", array(
        "label" => __("Checklist items"),
        "public" => false,
        "show_ui" => true,
        "menu_icon" => "dashicons-editor-ul",
        "supports" => array("title", "editor")
    ));

    register_post_type("course", array(
        "label" => __("Courses"),
        "public" => true,
        "menu_icon" => "dashicons-welcome-learn-more",
        "show_in_rest" => true,
        "supports" => array("title", "thumbnail", "revisions", "author")
    ));

    register_post_type("intake", array(
        "label" => __("Intakes"),
        "public" => true,
        "menu_icon" => "dashicons-groups",
        "show_in_rest" => true,
        "supports" => array("revisions", "author"),
        "rewrite" => array(
            "slug" => "apply"
        )
    ));

    register_post_type("testimonial", array(
        "label" => __("Testimonials"),
        "public" => false,
        "show_ui" => true,
        "menu_icon" => "dashicons-format-quote",
        "supports" => array("title", "editor", "thumbnail")
    ));
}
add_action("init", "lbh_custom_post_types_init");

// Don't use the gutenberg editor for testimonials
function lbh_disable_gutenberg_posts( $current_status, $post_type ) {
    $disabled_post_types = array( 'testimonial', 'checklist_item' );
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
            if(get_post($parent)){
                echo "<a href='" . get_edit_post_link($parent) . "'>";
                echo get_the_title($parent);
                echo "</a>";
            }
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



// rewrite content as the custom field value
function lbh_custom_course_content($content){
    if(get_post() && in_array(get_post()->post_type, array("course", "vacancy", "event"))){
        return get_field("description");
    }
    return $content; 
}
add_filter("the_content", "lbh_custom_course_content", 10, 6);