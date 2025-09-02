<div class="mobile-menu">
        <i class="material-icons menu-toggle">menu</i>
</div>

<header class="top_main">
        <div class="site-logo">
        <?php get_logo(); ?>
    </div>
    <div class="site-menu">
        <?php
            wp_nav_menu([
                'theme_location' => 'primary_menu',
                'container'      => false,
                'menu_class'     => 'main_menu',
                'fallback_cb'    => false,
            ]);
        ?>
    </div>
</header>
