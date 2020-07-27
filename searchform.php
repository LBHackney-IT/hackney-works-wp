<form action="/" method="get" class="mini-search">
    <label for="search" class="visually-hidden">Search </label>
    <input  class="mini-search__input" type="text" name="s" placeholder="Search..." id="search" value="<?php the_search_query(); ?>" />
    <button class="mini-search__button">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/search.svg" alt="Submit search"/>
    </button>
</form>