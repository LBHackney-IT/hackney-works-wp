<?php

// rewrite wp title
function lbh_custom_apply_title( $title, $sep ) {
    global $post;
    global $wp;
    if ( $post && $post->post_type == 'intake' ) {
		return "Apply for a course " . $sep . " ";
    }
    if ( array_key_exists( 'apply_confirmation', $wp->query_vars ) ) {
		return "Application complete " . $sep . " ";
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
    if(get_post($id) && get_post($id)->post_type === "intake"){
        if(get_field("start_date", $id) && get_field("end_date", $id)){
            return get_field("start_date", $id) . " — " . get_field("end_date", $id);
        } elseif(get_field("start_date", $id)){
            return "From " . get_field("start_date", $id);
        } else {
            return $id;
        }
    }
    return $title; 
}
add_filter("the_title", "lbh_custom_intake_title", 10, 6);


add_action( 'init',  function() {
    add_rewrite_rule( 
        'apply/([a-z0-9-]+)/confirmation/?$', 
        'index.php?intake=$matches[1]&apply_confirmation=1', 
        'top' 
    );

    add_rewrite_rule( 
        'vacancy/([a-z0-9-]+)/apply/?$', 
        'index.php?vacancy=$matches[1]&apply_vacancy=1', 
        'top' 
    );

} );

add_filter( 'query_vars', function( $query_vars ) {
    $query_vars[] = 'apply_confirmation';
    $query_vars[] = 'apply_vacancy';
    return $query_vars;
} );


add_action( 'parse_request', 'lbh_parse_request' );
function lbh_parse_request( &$wp ) {
    if ( array_key_exists( 'apply_confirmation', $wp->query_vars ) ) {
        include "confirmation-template.php";
        exit();
    }
    if ( array_key_exists( 'apply_vacancy', $wp->query_vars ) ) {
        include "vacancy-apply-template.php";
        exit();
    }
    return;
}

add_action("template_redirect", "handle_external_applications");
function handle_external_applications(){
    // handle intakes and vacancies
    if(in_array(get_post_type(), array("intake", "vacancy")) && get_field("management") === "external"){
        nocache_headers();
        wp_redirect(get_field("external_application_url"));
    }
    // handle events
    if(get_post_type() === "event"){
        nocache_headers();
        wp_redirect(get_field("external_application_url"));
    }
}