

<?php wp_footer(); ?>
<footer class="main-footer">
  <?php locate_part("form") ?>
 
  <div class="pages">
    <?php 
    MainPosts::page_list();

    ?>

  </div>
  <div class="latest">

  </div>
</footer>
  </body>
</html>
