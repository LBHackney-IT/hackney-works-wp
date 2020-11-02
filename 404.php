<?php get_header(); ?>

<section class="hero hero--with-breadcrumbs">
    <div class="container">
        <div class="hero__content">

        <ol class='breadcrumbs'>
            <li class='breadcrumbs__crumb'><a href='<?php get_option("home") ?>'>Home</a></li>
            <li class='breadcrumbs__crumb'>404</li>
        </ol>

            <h1 class="hero__title">Page not found</h1>
        </div>
    </div>
</section>

<div class="page-content">
    <div class="container with-sidebar">

        <div>
            <article class="panel panel--more-padding content-area">
                <p>If you typed the web address, check it is correct.</p>
                <p>If you pasted the web address, check you copied the entire address. </p>
                <p>If the web address is correct or you selected a link or button, you can <a href="mailto:opportunities@hackney.gov.uk">contact Hackney Opportunities</a>.</p>
            </article>
        </div>


    </div>
</div>

<?php get_template_part("call-to-action"); ?>

<?php get_footer(); ?>



