<?php

// rewrite wp title
function lbh_custom_apply_title( $title, $sep ) {
    global $post;
    if ( $post->post_type == 'intake' ) {
		return "Apply for a course " . $sep . " ";
	}
    return $title;
}
add_filter( 'wp_title', 'lbh_custom_apply_title', 10, 2);

// rewrite slugs to be ids
function lbh_custom_intake_slug( $slug, $post_id, $post_status, $post_type, $post_parent, $original_slug ) { 
    if($post_type === "intake"){
        return $post_id;
    }
    return $slug; 
};
add_filter( 'wp_unique_post_slug', 'lbh_custom_intake_slug', 10, 6 );

// rewrite title as date range
function lbh_custom_intake_title($title, $id){
    if(get_post($id)->post_type === "intake"){
        return get_field("start_date", $id) . " — " . get_field("end_date", $id);
    }
    return $title; 
}
add_filter("the_title", "lbh_custom_intake_title", 10, 6);