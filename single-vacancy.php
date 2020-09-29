<?php get_header(); 

$course = get_field("parent_course");
if(have_posts()): while(have_posts()): the_post(); 
?>

<section class="hero hero--with-breadcrumbs">
    <div class="container">
        <div class="hero__content">
            <ul class="breadcrumbs">
                <li class="breadcrumbs__crumb"><a href="/">Home</a></li>
                <li class="breadcrumbs__crumb">Opportunity</li>
            </ul>
            <h1 class="hero__title"><?php the_title(); ?></h1>
        </div>
    </div>
</section>

<article class="page-content">
    <div class="container layout-sidebar-right">
        <main class="layout-sidebar-right__main">
            <div class="content-area">
                Content goes here
            </div>
        </main>
        <aside class="layout-sidebar-right__sidebar">
            <div class="sidebar-widget">
                <h2 class="sidebar-widget__title">At a glance</h2>

                Sidebar content
            </div>
        </aside>
    </div>
</article>

<?php endwhile; endif;
get_footer(); ?>