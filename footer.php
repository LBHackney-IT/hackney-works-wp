<footer class="site-footer">
    <div class="site-footer__navigation">

        <div class="container">
            <img src="<?php echo get_stylesheet_directory_uri() . "/assets/footer-logo.png" ?>" alt="Hackney Council"/>
            

            <?php wp_nav_menu(array(
                "theme_location" => "footer-left-menu",
                "menu_class" => "site-footer__menu",
                "container" => false,
                "fallback_cb" => false
            )); ?>

            <?php wp_nav_menu(array(
                "theme_location" => "footer-right-menu",
                "menu_class" => "site-footer__menu",
                "container" => false,
                "fallback_cb" => false
            )); ?>
        </div>

    </div>
    <div class="site-footer__copyright">
        <div class="container">
            <p>Copyright message here</p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>