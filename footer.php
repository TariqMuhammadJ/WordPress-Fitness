

<?php wp_footer(); ?>
<footer class="main-footer">
  <?php locate_part("form") ?>
 
  <div class="pages">
    <?php 
    MainPosts::page_list();

    ?>

  </div>
</footer>
  </body>
</html>
