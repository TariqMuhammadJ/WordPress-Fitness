 <?
    $tags = get_the_tags();
        if ( $tags ) {
            echo '<ul class="post-tags">';
            foreach ( $tags as $tag ) {
                echo '<li><a href="' . get_tag_link( $tag->term_id ) . '">' . $tag->name . '</a></li>';
            }
            echo '</ul>';
        }
    ?>