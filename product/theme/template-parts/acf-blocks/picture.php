<?php
/*--------------------------------------------------------------
>>> [AFC block] 「挿入画像」ブロック
--------------------------------------------------------------*/ ?>

<?php
// ※ACF blockに情報が紐づいてるので、$post_idは必要ない。
//   ACF blockはpost_meta DB領域にデータを保持せず、すべて投稿コンテンツに埋め込まれる設計。
$url = get_field('picture-url');
$aspect_w = get_field('picture-aspect')['width'] ?: 16; // 横サイズ（値が空なら初期値：16）
$aspect_h = get_field('picture-aspect')['height'] ?: 9; // 縦サイズ（値が空なら初期値：9）

if ($url) { ?>
<img 
class="picture lozad keep-ratio copy-protect" 
src="data:image/gif;base64,R0lGODlhAQABAGAAACH5BAEKAP8ALAAAAAABAAEAAAgEAP8FBAA7" 
data-src="<?php echo esc_url($url); ?>" 
width="<?php echo $aspect_w; ?>" height="<?php echo $aspect_h; ?>" alt="" />
<?php } ?>