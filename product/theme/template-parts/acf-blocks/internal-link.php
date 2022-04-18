<?php
/*--------------------------------------------------------------
>>> [AFC block] 「商品リンク」ブロック
--------------------------------------------------------------*/ ?>

<?php 
// ※ACF blockに情報が紐づいてるので、$post_idは必要ない。
//   ACF blockはpost_meta DB領域にデータを保持せず、すべて投稿コンテンツに埋め込まれる設計。
// この記事で紹介してる商品情報を取得
$post_objs =  get_field('internal-link-post-objs');
?>

<?php
  foreach ($post_objs as $post_obj) : 
    $link = esc_url(get_permalink($post_obj->ID));
    $title = $post_obj->post_title;
    $excerpt = get_post_excerpt($post_obj->post_content, 90);
    $eyecatch = esc_url(get_eyecatch_url($post_obj->ID, '4_3_thumbnail')); ?>

  <a class="internal-link" href="<?php echo $link; ?>" target="_blank">
  <div class="internal-link__body">
    <div class="internal-link__body-inner">
      <p class="internal-link__label">関連記事</p>
      <p class="internal-link__title"><?php echo $title; ?></p>
      <p class="internal-link__excerpt"><?php echo $excerpt; ?></p>
      <p class="internal-link__read-more">
        <span class="internal-link__read-more-text">続きをよむ</span>
        <svg class="internal-link__read-more-icon"><use href="#fa-chevron"/></svg>
      </p>
    </div>
  </div>
  <div class="internal-link__eyecatch">
    <div class="internal-link__eyecatch-inner">
      <img class="internal-link__eyecatch-img lozad" src="data:image/gif;base64,R0lGODlhAQABAGAAACH5BAEKAP8ALAAAAAABAAEAAAgEAP8FBAA7" data-src="<?php echo $eyecatch; ?>" alt="記事アイキャッチ">
    </div>
  </div>
</a>
<?php endforeach; ?>