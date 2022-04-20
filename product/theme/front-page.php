<?php 
/*--------------------------------------------------------------
>>> front-page.php：サイトTOPページ
--------------------------------------------------------------*/
get_header(); ?>

<main class="front">
  <div class="wrapper">
    <?php get_template_part('template-parts/hero'); ?>
    <section class="main">
      <div class="caption --mt-unset-sp">
        <svg class="caption__icon"><use href="#fa-bell"/></svg>
        <h2 class="caption__text">新しい投稿</h2>
      </div>
      <?php 
      $the_query = new WP_Query(array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 18, // 注）page-newと一致させること
      )); 
      if ($the_query->have_posts()) {
        $args = array();
        $args['option']['style'] = '--main';
        $args['option']['star-style'] = '--post-card';
        
        while ($the_query->have_posts()) { $the_query->the_post();
          $data                  = array();
          $data['tag']           = get_field('post-main-tag', $post->ID);
          $data['permalink_url'] = get_permalink($post->ID);
          $data['eyecatch_url']  = get_eyecatch_url($post->ID);
          $data['title']         = $post->post_title;
          $data['category']      = get_category_child($post->ID);
          $data['date']          = $post->post_date;
          $args['posts'][]       = $data;
        }
        get_template_part('template-parts/post-list-card', null, $args);
        
        // ページネーション可能なほど記事があるなら
        if ($the_query->max_num_pages > 1) { ?>
        <a class="see-more-post-btn" href="<?php echo esc_url(home_url().'/new'); ?>/page/2" aria-label="投稿をもっと表示するボタン">
          <span class="see-more-post-btn__text">新着記事をもっと見る</span>
          <svg class="see-more-post-btn__icon"><use href="#fa-chevron"/></svg>
        </a>
      <?php
        }
        wp_reset_postdata();
      } ?>
    </section>
    <section class="side">
      <div class="side__box">
        <div class="side__box-tab-none">
          <!-- PC・タブレット版 広告 <上部> -->
          <?php get_template_part('template-parts/adsence', 'pc-tab-side-top'); ?>
        </div>
      </div>

      <div class="side__box">
        <div class="side__box-l">
          <div class="side__box-pc-none">
            <!-- PC・タブレット版 広告 <上部> -->
            <?php get_template_part('template-parts/adsence', 'pc-tab-side-top'); ?>
          </div>
        </div>
        <div class="side__box-r">
          <!-- 検索ボックス -->
          <?php get_template_part('template-parts/search-box'); ?>

          <!-- カテゴリ一覧 -->
          <?php get_template_part('template-parts/category-menu'); ?>

          <!-- サイト紹介 -->
          <?php get_template_part('template-parts/profile'); ?>
        </div>
      </div>

      <div class="side__box">
        <!-- PC・タブレット版 広告 <下部> -->
        <?php get_template_part('template-parts/adsence', 'pc-tab-side-bottom'); ?>

        <!-- スマホ版 広告 <下部> -->
        <?php get_template_part('template-parts/adsence', 'sp-footer'); ?>
      </div>
    </section>    
  </div>
</main>

<?php get_footer(); ?>