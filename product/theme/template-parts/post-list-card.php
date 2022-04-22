<?php
/*--------------------------------------------------------------
>>> 記事カード
--------------------------------------------------------------*/ ?>
<?php
  // カードスタイル
  $style = isset($args['option']['style']) ? $args['option']['style'] : '';
  // id
  $id = isset($args['option']['id']) ? 'id="'.$args['option']['id'].'"' : '';
?>

<?php
if (isset($args) && count($args) > 0) : ?>

<div class="post-card <?php echo $style; ?>" <?php echo $id; ?>>
  <div class="post-card__media-unit">
    <?php foreach ($args['posts'] as $post) : ?>
    <article class="post-card__media">
      <a class="post-card__eyecatch" href="<?php echo esc_url($post['permalink_url']); ?>" aria-label="記事一覧のサムネイル">
        <div class="post-card__eyecatch-inner">
          <img class="post-card__eyecatch-img lozad" src="data:image/gif;base64,R0lGODlhAQABAGAAACH5BAEKAP8ALAAAAAABAAEAAAgEAP8FBAA7" 
               data-src="<?php echo esc_url($post['eyecatch_url']); ?>" width="16" height="9" alt="">
        </div>
      </a>
      <div class="post-card__body">
        
        <?php if (!empty($post['tag'])) { ?>
        <!-- tag -->
        <a class="post-card__tag"  href="<?php echo esc_url(get_term_link($post['tag'])); ?>"><?php echo esc_html($post['tag']->name); ?></a>
        <?php } ?>

        <!-- title -->
        <h3 class="post-card__title"><?php echo $post['title']; ?></h3>

        <!-- meta -->
        <div class="post-card__meta">
          <!-- category -->  
          <p class="post-card__category">
            <svg class="post-card__category-icon" style="background: <?php echo esc_html($post['category']['color']);?>;">
              <use href="#<?php echo esc_html($post['category']['icon']); ?>"/>
            </svg>
            <span class="post-card__category-text"><?php echo esc_html($post['category']['name']); ?></span>
          </p>
          <!-- date -->
          <time class="post-card__date" datetime="<?php echo mysql2date('Y-m-d', $post['date']); ?>" itemprop="datePublished">
            <svg class="post-card__date-icon"><use href="#fa-clock"/></svg>
            <span class="post-card__date-text"><?php echo mysql2date('Y年m月d日', $post['date']); ?></span>
          </time>
        </div>

        <?php if (!empty($post['excerpt'])) { ?>
        <!-- excerpt -->
        <p class="post-card__excerpt"><?php echo $post['excerpt']; ?></p>
        <?php } ?>

      </div>
    </article>
    <?php endforeach; ?>
  </div>
</div>
<?php endif; ?>