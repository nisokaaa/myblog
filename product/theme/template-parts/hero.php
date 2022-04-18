<?php
/*--------------------------------------------------------------
>>> hero.php：TOPページヒーローエリアスライダー テンプレートパーツ
--------------------------------------------------------------*/
?>

<div class="hero" id="hero">

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
    $data['excerpt']       = get_post_excerpt($post->post_content, 120);
    $hero_posts[] = $data;
  } wp_reset_postdata(); ?>

  <div class="post-card --hero swiper-container">
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

          <?php if (!empty($post['star'])) { ?>
          <div class="post-card__star">
            <div class="star --hero">
              <span class="star__rate --rate-w-<?php echo $post['star'] * 10; ?>"></span>
              <span class="star__point"><?php echo $post['star']; ?></span>
            </div>
          </div>
          <?php } ?>

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
          
          <p class="post-card__excerpt"><?php echo $post['excerpt']; ?></p>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
  </div>
</div>