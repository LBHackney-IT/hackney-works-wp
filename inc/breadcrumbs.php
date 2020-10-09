<?php 
function the_breadcrumbs($post_id = null){
    if($post_id){
        $post = get_post($post_id);
    } else {
        global $post;
    }
    if(is_page()){
        $parent_id = $post->post_parent;
        $breadcrumbs = array();
        while ($parent_id) {
            $page = get_page($parent_id);
            $breadcrumbs[] = "<li class='breadcrumbs__crumb'><a href='" . get_permalink($page->ID) . "'>" . get_the_title($page->ID) . "</a></li>";
            $parent_id = $page->post_parent;
        }
        $breadcrumbs = array_reverse($breadcrumbs);
        echo "<ol class='breadcrumbs'>";
        echo "<li class='breadcrumbs__crumb'><a href='" . get_option("home") . "'>Home</a></li>";
        foreach ($breadcrumbs as $crumb) echo $crumb;
        echo "<li class='breadcrumbs__crumb'>" . get_the_title($post) . "</li>";
        echo "</ol>";
    }
}