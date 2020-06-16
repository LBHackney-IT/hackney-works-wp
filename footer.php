            </div>
        </main>
    </div>
    <footer class='front_page_footer'>
        <div class='lines'></div>
        <div class='container columns'>
            <div class='logo column'>
                <a href='https://hackney.gov.uk' target='_blank'>
                    <img alt="Hackney Council" src="<?php echo get_stylesheet_directory_uri() ?>/assets/hackney_logo_white.png" />
                    <br>
                    <img alt="Find yourself in Hackney" class="tagline" src="<?php echo get_stylesheet_directory_uri() ?>/assets/find-yourself-type-white.svg" />
                </a>
                <div class='copy'>
                    <p>This website may not be compatible with Internet Explorer. Please use an alternative browser such as Chrome or Safari.</p>
                    All content is available under the <a target="_blank" href="https://www.nationalarchives.gov.uk/doc/open-government-licence/version/3/">Open Government Licence</a>
                </div>
            </div>
                <?php 
                    wp_nav_menu( array( 
                        'theme_location' => 'footer-left-menu',
                        'menu_class' => 'column',
                        'container' => ''
                    ) ); 
                    wp_nav_menu( array( 
                        'theme_location' => 'footer-right-menu',
                        'menu_class' => 'column',
                        'container' => ''
                    ) ); 
                ?>
            </div>

        </div>
    </footer>
    </body>
    <?php wp_footer(); ?>
</html>
