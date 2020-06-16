<?php 
/* Template Name: Opportunities board */

$opportunities = fetch_opportunities();
?>

<?php get_header(); ?>

<?php if(have_posts()): while(have_posts()): the_post(); ?>

    <h1><?php the_title(); ?></h1>
    
    <br/>

    <div class="filters">
        Filter: 
        <div class="job large tag <?php if(get_query_var("type")) echo "inactive"; ?>">
            <a href="?">All</a>
        </div>
        <div class="job large tag <?php if(get_query_var("type") !== "jobs" ) echo "inactive"; ?>">
            <a href="?type=jobs">Jobs</a>
        </div>
        <div class="job large tag <?php if(get_query_var("type") !== "apprenticeships" ) echo "inactive"; ?>">
            <a href="?type=apprenticeships">Apprenticeships</a>
        </div>
        <div class="job large tag <?php if(get_query_var("type") !== "placements" ) echo "inactive"; ?>">
            <a href="?type=placements">Placements</a>
        </div>
        <div class="job large tag <?php if(get_query_var("type") !== "events" ) echo "inactive"; ?>">
            <a href="?type=events">Events</a>    
        </div>
        <div class="job large tag <?php if(get_query_var("type") !== "training" ) echo "inactive"; ?>">
            <a href="?type=training">Training</a>
        </div>
    </div>

    <br/>

    <div class="container">
    <div class="opportunity_list columns is-multiline">
        <?php 
            if($opportunities): 
            $i = 0;
            while($i < count($opportunities)):
        ?>
            <div class="single_opportunity column is-one-third">
                <div class="box">
                    <div class="opportunity_tags">
                        <div class="tag"><?php echo $opportunities[$i]->actable_type ?></div>
                    </div>
                    <p class="opportunity_title"><?php echo $opportunities[$i]->actable->title ?></p>
                    <p class="opportunity_description"><?php echo $opportunities[$i]->actable->short_description ?></p>
                </div>
            </div>
        <?php 
            $i++;
            endwhile; 
            endif;
        ?>
    </div>

<?php endwhile; endif; ?>

<?php get_footer(); ?>