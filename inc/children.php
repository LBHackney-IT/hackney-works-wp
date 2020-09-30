<?php 
function the_children(){

    global $post;
    $children = new WP_Query(array(
        'post_type'      => 'page',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'post_parent'    => $post->ID,
        'order'          => 'ASC',
        'orderby'        => 'menu_order'
    ));

    if ( $children->have_posts() ):
        echo "<div class='panel'>";
        echo "<h2 class='panel__title'>In this section</h2>";
        echo "<ul class='related-content-list'>";
        while ( $children->have_posts() ) : $children->the_post();
            echo "<li>";
            echo "<a href='" . get_the_permalink() . "'>" . get_the_title() . "</a>";
            echo "</li>";
        endwhile;
        echo "</ul>";
        echo "</div>";
    endif; 
    wp_reset_postdata();
}