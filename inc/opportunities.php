<?php

function add_query_vars_filter( $vars ){
    $vars[] = "type";
    return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );

function fetch_opportunities(){
    $url = API_HOST . "/opportunities";
    if(get_query_var("type")){
        $url = $url . "?type=" . get_query_var("type");
    }
    $req = curl_init($url);
    curl_setopt($req, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($req, CURLOPT_RETURNTRANSFER, TRUE);
    $res = curl_exec($req);
    curl_close($req);
    return json_decode($res);
}