

<?php wp_footer(); ?>
<footer class="main-footer">
  <div class="subscribe">
    <h2>Sign up to receive the latest</h2>
    <form action="" class="subscription">
      <input type="email" placeholder="Email Adress">
      <input type="submit" class="sbt-btn">
    </form>
    <div class="social-icons">
      <?php locate_part('social') ?>
    </div>
  </div>
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
