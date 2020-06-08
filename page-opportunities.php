<?php 
/* Template Name: Opportunities board */

$opportunities = fetch_opportunities();
?>

<?php get_header(); ?>

<?php if(have_posts()): while(have_posts()): the_post(); ?>

    <h1><?php the_title(); ?></h1>

    <ul>
    <?php 
        if($opportunities): 
        $i = 0;
        while($i < count($opportunities)):

    ?>
        <li>
            <h3><?php echo $opportunities[$i]->title ?></h3>
            <p><?php echo $opportunities[$i]->actable_type ?></p>
        </li>
    <?php 
        $i++;
        endwhile; 
        endif;
    ?>
    </ul>

    <?php the_content(); ?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>