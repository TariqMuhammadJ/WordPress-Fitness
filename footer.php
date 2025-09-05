

<?php wp_footer(); ?>
<footer class="main-footer">
  <?php locate_part("form") ?>
 
  <div class="pages">
    <?php 
    MainPosts::page_list();

    ?>

</div>
<div class="tag-area">
  <?php wp_tag_cloud($args); ?>
</div>

</footer>
  </body>
</html>
