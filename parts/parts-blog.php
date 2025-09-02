<main class="main-body blog-page">
    <? get_menu() ?>
    <div class="blog-section">

        <section class="blog">
        <div class="featured">
            <?php MainPosts::featured("sports") ?>
        </div>
        <div class="latest">
            <?php MainPosts::latest_posts() ?>
        </div>
        </section>
    <section class="side-bar">
        <?
        if(is_active_sidebar('main-sidebar')){
            dynamic_sidebar('main-sidebar');
        }
        ?>
    </section>
    </div>
    
</main>

