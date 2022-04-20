<?php
/*--------------------------------------------------------------
>>> hero.php：TOPページヒーローエリアスライダー テンプレートパーツ
--------------------------------------------------------------*/
?>

<div class="hero" id="hero">
  <div class="hero__main">
    <?php 
    $the_query = new WP_Query(array(
      'post_type' => 'post',
      'post_status' => 'publish',
      'posts_per_page' => 1 ));
    $the_post = array();
    if ($the_query->have_posts()) {
      while ($the_query->have_posts()) { $the_query->the_post();
        $the_post['tag']           = get_field('post-main-tag', $post->ID);
        $the_post['permalink_url'] = get_permalink($post->ID);
        $the_post['eyecatch_url']  = get_eyecatch_url($post->ID);
        $the_post['title']         = $post->post_title;
        $the_post['category']      = get_category_child($post->ID);
        $the_post['date']          = $post->post_date;
        $the_post['excerpt']       = get_post_excerpt($post->post_content, 120);
      }
      wp_reset_postdata(); 
    } ?>

    <div class="post-card --hero-main">
      <article class="post-card__media">
        <a class="post-card__eyecatch" href="<?php echo esc_url($the_post['permalink_url']); ?>" aria-label="最新記事サムネ">
          <div class="post-card__eyecatch-inner">
            <img class="post-card__eyecatch-img lozad" data-src="<?php echo esc_url($the_post['eyecatch_url']); ?>" alt="">
          </div>
        </a>
        <div class="post-card__body">
          <a class="post-card__tag" href="<?php echo esc_url(get_term_link($the_post['tag'])); ?>"><?php echo esc_html($the_post['tag']->name); ?></a>
          <h3 class="post-card__title"><?php echo $the_post['title']; ?></h3>
          <div class="post-card__meta">  
            <p class="post-card__category">
              <svg class="post-card__category-icon" style="background: <?php echo esc_html($the_post['category']['color']);?>;">
                <use href="#<?php echo esc_html($the_post['category']['icon']); ?>-solid"/>
              </svg>
              <span class="post-card__category-text"><?php echo esc_html($the_post['category']['name']); ?></span>
            </p>
            <time class="post-card__date" datetime="<?php echo mysql2date('Y-m-d', $the_post['date']); ?>" itemprop="datePublished">
              <svg class="post-card__date-icon"><use href="#fa-clock"/></svg>
              <span class="post-card__date-text"><?php echo mysql2date('Y年m月d日', $the_post['date']); ?></span>
            </time>
          </div>
          <p class="post-card__excerpt"><?php echo $the_post['excerpt']; ?></p>
        </div>
      </article>
    </div>
  </div>
  <div class="hero__sub">
    <div class="caption --mt-unset">
      <svg class="caption__icon"><use href="#fa-folder"/></svg>
      <h2 class="caption__text">おすすめの投稿</h2>
    </div>
    <?php
    $hero_posts = array();
    foreach (get_option_post_list_reccomend() as $post) {
      $data                  = array();
      $data['tag']           = get_field('post-main-tag', $post->ID);
      $data['permalink_url'] = get_permalink($post->ID);
      $data['eyecatch_url']  = get_eyecatch_url($post->ID);
      $data['title']         = $post->post_title;
      $data['category']      = get_category_child($post->ID);
      $data['date']          = $post->post_date;
      $hero_posts[] = $data;
    } wp_reset_postdata(); ?>

    <div class="post-card --hero-sub swiper-container">
      <div class="post-post-card__media-unit swiper-wrapper">
        <?php foreach ($hero_posts as $post) : ?>
        <article class="post-card__media swiper-slide">
          <a class="post-card__eyecatch" href="<?php echo esc_url($post['permalink_url']); ?>" aria-label="注目記事のサムネイル">
            <div class="post-card__eyecatch-inner">
              <img class="post-card__eyecatch-img swiper-lazy" data-src="<?php echo esc_url($post['eyecatch_url']); ?>" alt="">
            </div>
          </a>
          <div class="post-card__body">
            <a class="post-card__tag" href="<?php echo esc_url(get_term_link($post['tag'])); ?>"><?php echo esc_html($post['tag']->name); ?></a>
            <h3 class="post-card__title"><?php echo $post['title']; ?></h3>
            <div class="post-card__meta">  
              <p class="post-card__category">
                <svg class="post-card__category-icon" style="background: <?php echo esc_html($post['category']['color']);?>;">
                  <use href="#<?php echo esc_html($post['category']['icon']); ?>-solid"/>
                </svg>
                <span class="post-card__category-text"><?php echo esc_html($post['category']['name']); ?></span>
              </p>
              <time class="post-card__date" datetime="<?php echo mysql2date('Y-m-d', $post['date']); ?>" itemprop="datePublished">
                <svg class="post-card__date-icon"><use href="#fa-clock"/></svg>
                <span class="post-card__date-text"><?php echo mysql2date('Y年m月d日', $post['date']); ?></span>
              </time>
            </div>
          </div>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
    <div class="hero__sub-mask"></div>
    <span class="hero__scroll-line">SCROLL</span>
  </div>
</div>