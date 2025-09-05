<form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
    <input type="search" class="search-field" placeholder="Search..." value="<?php echo get_search_query(); ?>" name="s" />
    <button type="submit" class="search-submit"><span>&#x2315;</span></button>
</form>
