<?php
/*--------------------------------------------------------------
>>> footer.php：フッターテンプレートパーツ
--------------------------------------------------------------*/
?>
    <!-- footer -->
    <footer class="footer">
      <div class="footer__wrapper">
        <!-- PC版 広告 -->
        <?php get_template_part('template-parts/adsence', 'pc-footer'); ?>
        
        <a class="footer__link" href="<?php echo esc_url(home_url().'/about'); ?>" aria-label="このサイトについてページへ">このサイトについて</a>

        <p class="footer__copy">
          <small>&copy; 2022 <?php echo get_bloginfo('name');?> All RightsReserved.</small>
        </p>
      </div>
    </footer>

    <?php wp_footer();
    // Google Analyticsコード出力
    echo get_option_field('analytics-scripts'); ?>
  </body>
</html>