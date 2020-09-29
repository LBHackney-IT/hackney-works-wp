<?php
/* Template Name: Opportunities board */

$types = array(
    "All" => "",
    "Courses" => "course",
    "Events" => "event",
    "Vacancies" => "vacancy"
);

$type_query = array("course", "event", "vacancy");
if(get_query_var("type")){
    $type_query = get_query_var("type");
}

$search = new WP_Query();
$search->parse_query(array(
    "posts_per_page" => 9,
    "post_type" => $type_query
));
relevanssi_do_query( $search );

global $paged;
$max_page = $search->max_num_pages;
$results = $search->found_posts;

get_header();

if(have_posts()): while(have_posts()): the_post(); ?>

<section class="hero hero--with-breadcrumbs">
    <div class="container">
        <div class="hero__content">
            <ul class="breadcrumbs">
                <li class="breadcrumbs__crumb"><a href="/">Home</a></li>
                <li class="breadcrumbs__crumb">Opportunities</li>
            </ul>
            <h1 class="hero__title"><?php the_title(); ?></h1>
        </div>
    </div>
</section>

<article class="page-content">
    <div class="container">

        <nav class="opportunity-search">
            <form 
                class="opportunity-search__form" 
                action="<?php the_permalink(); ?>" 
                method="get"
            >  
                
            <div class="opportunity-search__field">
                    <label class="opportunity-search__label" for="type">Search by type</label>
                    <select class="opportunity-search__input" name="type" id="type">
                        <?php foreach($types as $key => $value): ?>
                            <option value="<?php echo $value ?>" <?php if(get_query_var("type") === $value){ echo "selected"; } ?>>
                                <?php echo $key ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="opportunity-search__field">
                    <label class="opportunity-search__label" for="keywords">Search by keyword</label>
                    <input class="opportunity-search__input" name="keywords" type="search" id="keywords" value="<?php echo get_query_var("keywords") ?>" placeholder="eg. designer"/>
                    <?php if(get_query_var("keywords")): ?>
                        <a class="opportunity-search__clear" href="<?php the_permalink(); ?>"><img src="<?php echo get_stylesheet_directory_uri() . "/assets/cross.svg" ?>" alt="Clear search"/></a>
                    <?php endif; ?>
                </div>

                <button class="opportunity-search__button">Search</button>
            </form>
        </nav>

        <?php if($search->have_posts()): ?>

            <p class="results-count">
                <?php if($search->found_posts == 1): ?>
                    1 matching opportunity
                <?php else: ?>
                    <?php echo $search->found_posts; ?> matching opportunities
                <?php endif; ?>
            </p>

            <ol class="card-list card-list--grid">
                <?php while($search->have_posts()): $search->the_post(); ?>
                <li class="card-list__card">
                    <p class="card-list__tag"><?php echo ucfirst(get_post_type()); ?></p>
                    <h2 class="card-list__title"><a class="card-list__link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <?php echo truncate(get_field("description"), 130); ?>
                </li>

                <?php endwhile; ?>
            </ol>
        <?php else: ?>
            <p class="no-results">No matching opportunities. Try widening your search.</p>
        <?php endif; ?>

        <?php if($max_page > 1): ?>
            <nav class="page-navigation">
                <ul class="page-navigation__list">  
                    <?php if($paged > 1): ?>
                    <li class="page-navigation__item page-navigation__item--previous">
                        <a class="page-navigation__link" href="<?php echo previous_posts(); ?>">
                            <span>Previous</span>    
                            <span>Page <?php echo $paged - 1 ?> of <?php echo $max_page ?></span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if($paged < $max_page): ?>
                    <li class="page-navigation__item page-navigation__item--next"> 
                        <a class="page-navigation__link" href="<?php echo next_posts(); ?>">
                            <span>Next</span>   
                            <span>Page <?php echo $paged + 1 ?> of <?php echo $max_page ?></span>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </nav>
        <?php endif; ?>


    </div>

    

</article>

<?php endwhile; endif;

get_template_part("call-to-action");

get_footer();