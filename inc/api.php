<?php

add_action( 'rest_api_init', function () {
  register_rest_route( 'announcement', '/v1', array(
    'methods' => 'GET',
    'callback' => 'lbh_announcement_route',
  ));
});

function lbh_announcement_route() {
    $res = new stdClass();
    $visible = get_option('show_announcement');
    if( $visible === "on" ){
        $res->visible = true;
    } else {
        $res->visible = false;
    }
    $res->title = get_option('announcement_title');
    $res->content = get_option('announcement_content');
    return $res;
}