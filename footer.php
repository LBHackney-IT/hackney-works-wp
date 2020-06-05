    </div>
    <footer class='front_page_footer'>
        <div class='lines'></div>
        <div class='container columns'>
            <div class='logo column'>
                <a href='https://hackney.gov.uk' target='_blank'>
                    <img alt="Hackney Council" src="/assets/hackney_logo_white-75c397ebd932a949cbdb0850d2e1fae157ef47a610830d4469df4dd7cd21b18d.png" />
                    <br>
                    <img alt="Find yourself in Hackney" class="tagline" src="/assets/find-yourself-type-white-529e4aaa0e643f9a3b8ff3ff74f1b7c759c797d63f92f293e6b56ff38ca16612.svg" />
                </a>
                <div class='copy'>
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
