<!DOCTYPE html>
<html lang="en" class="govuk-template lbh-template">
  <head>
    <meta charset="utf-8">
    <title><?php the_title(); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="theme-color" content="#0b0c0c">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/dist/_main.css">
    <?php wp_head(); ?>
  </head>
  <body class="govuk-template__body">

    <script>
      document.body.className = ((document.body.className) ? document.body.className + ' js-enabled' : 'js-enabled');
    </script>

    <!-- Skip link goes here -->
    <!-- Cookie banner goes here -->
    <!-- Header goes here -->
    <?php get_header(); ?>
    <!-- Phase banner goes here -->
    <!-- Announcements go here -->
    <!-- Breadcrumbs go here -->

    <main class="lbh-main-wrapper " id="main-content" role="main">
      <div class="lbh-container">
        <!-- Main content components go here -->
      </div>
    </main>

    <!-- Put your path to the LBHFrontend JS File in the src attribute here -->
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/dist/js/_main.js"></script>
    <?php wp_footer(); ?>

  </body>
</html> 