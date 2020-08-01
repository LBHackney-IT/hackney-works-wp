<?php

// cache the number of intakes a course has for easy searching later
function lbh_track_intake_number($post_id, $post){
    if($post->post_type === "intake"){
        $parent_course = get_field("parent_course", $post);
        $intakes = new WP_Query(array(
            "post_type" => "intake",
            "post_status" => "publish",
            "posts_per_page" => -1,
            "meta_query" => array(
                array(
                    "key" => "parent_course",
                    "value" => $parent_course->ID
                )                   
            ),
        ));
        update_post_meta(
            $parent_course->ID, 
            "intake_count", 
            $intakes->found_posts
        );
    }
}
add_action("save_post", "lbh_track_intake_number", 10, 3);


// when the theme is activated, update all cache values
function lbh_update_all_intake_numbers(){
    $courses = new WP_Query(array(
        "post_type" => "course",
        "posts_per_page" => -1
    ));
    foreach($courses->get_posts() as $course):
        $intakes = new WP_Query(array(
            "post_type" => "intake",
            "post_status" => "publish",
            "posts_per_page" => -1,
            "meta_query" => array(
                array(
                    "key" => "parent_course",
                    "value" => $course->ID
                )                   
            ),
        ));
        update_post_meta(
            $course->ID, 
            "intake_count", 
            $intakes->found_posts
        );
    endforeach;
}
add_action("after_switch_theme", "lbh_update_all_intake_numbers");