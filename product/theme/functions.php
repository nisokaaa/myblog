<?php
/*--------------------------------------------------------------
>>> TABLE OF CONTENTS:
----------------------------------------------------------------
# init.php        (サムネイルやメニューの有効化)
# cleanup.php     (バージョン情報などを削除)
# widgets.php     (ウィジェットエリア、自作ウィジェット)
# scripts.php      (自作スクリプトの登録と読み込み設定)
## ads.php         (広告・Adsenseコード)
## custom.php      (その他)
--------------------------------------------------------------*/

/* ---------------------------------------
  定数宣言
--------------------------------------- */
define("TEMPLATE_DIR", get_template_directory_uri());

/* ---------------------------------------
  自作スクリプトの登録と読み込み設定 (別ファイルに記述)
--------------------------------------- */
require_once get_template_directory() . '/scripts.php';

/* ---------------------------------------
  管理画面内の設定
--------------------------------------- */
//プロフィール欄HTMLタグ有効
remove_filter('pre_user_description', 'wp_filter_kses');

// カテゴリ説明文HTML有効
remove_filter( 'pre_term_description', 'wp_filter_kses' );

//カテゴリ説明欄HTMLタグ有効
remove_filter( 'pre_term_name', 'wp_filter_kses' );

/* ---------------------------------------
  管理ツールバーを非表示
--------------------------------------- */
add_filter('show_admin_bar', '__return_false');

/* ---------------------------------------
  投稿のアイキャッチ画像を有効化
--------------------------------------- */
add_theme_support( 'post-thumbnails' );

/* ---------------------------------------
  ロゴ画像カスタム設定を有効化
--------------------------------------- */
add_theme_support( 'custom-logo' ); 

/* ---------------------------------------
  自動保存の無効化
--------------------------------------- */
function disable_autosave() {
  wp_deregister_script('autosave');
}
add_action('wp_print_scripts','disable_autosave');
function disable_quickpress() {
	remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
}
add_action('wp_dashboard_setup', 'disable_quickpress');

/* ---------------------------------------
  コメントフォームをカスタマイズ
--------------------------------------- */
// フォーム部分のカスタマイズ
add_filter( 'comment_form_default_fields', 'custom_comment_form_fields' );
function custom_comment_form_fields($fields) {
  $commenter = wp_get_current_commenter();
  $req = get_option( 'require_name_email' );
  $aria_req = ($req ? " aria-required='true'" : '');
  $fields['author']   = '<p class="comment-form-author">' . 
                          '<label for="author">お名前'. ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                          '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />'.
                        '</p>';
  $fields['email']    = '<p class="comment-form-email"><label for="email">メールアドレス' . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                          '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" placeholder="mail@example.com" ' . $aria_req . ' />' . 
                        '</p>';
  $fields['cookies']  = '<p class="comment-form-cookies-consent">'.
                          '<input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox"/>'.
                          '<label for="wp-comment-cookies-consent">次回のコメントで使用するためブラウザーに自分の名前、メールアドレスを保存する。</label>' . 
                        '</p>';
  $fields['url']      = '';
  
  return $fields;
}

// フォーム周囲のカスタマイズ
add_filter( 'comment_form_defaults', 'custom_comment_form' );
function custom_comment_form( $args ) {
  $args['comment_notes_before'] = '<p class="comment-notes">メールアドレスは公開されませんのでご安心ください。<br />また、<span class="required">*</span> が付いている欄は必須項目となります。<br />必ずご記入をお願いします。</p>';
  $args['comment_notes_after'] = '<p class="form-allowed-tags">内容に問題なければ、下記の「コメントを送信する」ボタンを押してください。</p>';
  $args['label_submit'] = 'コメントを送信する';
  $args['cancel_reply_link'] = 'キャンセルする';
  $args['logged_in_as'] = '';
  return $args;
}

// コメント フォーム内のURLオートリンクを停止する
remove_filter('comment_text', 'make_clickable', 9);

// コメント カスタマイズ コールバック関数
function custom_comment_list($comment, $args, $depth) {
  $GLOBALS['comment'] = $comment; ?>
  <div class="comment-item" id="comment-<?php comment_ID(); ?>">
    <article>
      <header class="comment-header">
        <?php echo get_avatar( $comment, $args['avatar_size'] ); ?>
        <div class="comment-meta">
          <cite class="comment-author"><?php comment_author_link(); ?></cite>
          <time class="comment-date" datetime="<?php comment_date(); ?>">
            <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>" rel="nofollow"><?php comment_date(); ?></a>
          </time>
        </div>
      </header>
      <div class="comment-body">
        <?php comment_text(); ?>
      </div>
      <div class="comment-reply">
        <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
      </div>
    </article>
  <?php
}

/* ---------------------------------------
  JavaScript読み込み
--------------------------------------- */
function add_scripts() {
  wp_deregister_script('jquery');
  wp_dequeue_style('wp-block-library');
  wp_deregister_script('wp-embed');

  // モバイルかPCか？
  $device_prefix = wp_is_mobile() ? '_mobile' : '_desktop';
  if (is_front_page()) {
    wp_enqueue_style('front', TEMPLATE_DIR.'/public/css/front'.$device_prefix.'.bundle.css', array(), false, 'all');
    wp_enqueue_script('front', TEMPLATE_DIR.'/public/js/front'.$device_prefix.'.bundle.js', array(), false, true);
  } else if (is_single()) {
    wp_enqueue_style('single', TEMPLATE_DIR.'/public/css/single'.$device_prefix.'.bundle.css', array(), false, 'all');
    wp_enqueue_script('single', TEMPLATE_DIR.'/public/js/single'.$device_prefix.'.bundle.js', array(), false, true);
  } else if (is_search() || is_archive() || is_page()) {
    wp_enqueue_style('list', TEMPLATE_DIR.'/public/css/list'.$device_prefix.'.bundle.css', array(), false, 'all');
    wp_enqueue_script('list', TEMPLATE_DIR.'/public/js/list'.$device_prefix.'.bundle.js', array(), false, true);
  }
}
add_action( 'wp_enqueue_scripts', 'add_scripts' );

/* DNSプリフェッチ設定の削除 */
add_filter( 'emoji_svg_url', '__return_false' );

/* oEmbed削除 */
remove_action('wp_head', 'wp_oembed_add_discovery_links');

/* 絵文字削除 */
remove_action( 'wp_head',             'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles',     'print_emoji_styles' );
remove_action( 'admin_print_styles',  'print_emoji_styles' );

/* WPのバージョン削除 */
remove_action('wp_head', 'wp_generator');

/* リモート投稿機能削除 */
remove_action('wp_head', 'rsd_link');

/* 短縮URL表記停止 */
remove_action('wp_head', 'wp_shortlink_wp_head');

/* ---------------------------------------
  最も新しい投稿のpostデータを返す
--------------------------------------- */
function get_latest_post() {
  $the_query = new WP_Query(array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => 1 ));
  if ($the_query->have_posts()) {
    while ($the_query->have_posts()) {$the_query->the_post();
      return $GLOBALS['post'];
    }
    wp_reset_postdata(); 
  }
}

/* ---------------------------------------
  ロゴ画像出力
--------------------------------------- */
function echo_custom_logo($class1, $class2){
  // テーマ設定のプロパティ値を利用
  $id = get_theme_mod( 'custom_logo' );
  $image = wp_get_attachment_image_src( $id, 'full' );
  $tag = '<a class="'. $class1 .'" href="'. home_url('/') .'" aria-label="ロゴ画像"><img src="'. $image[0] .'" class="'. $class2 .'" alt="'. get_bloginfo( 'name' ) .'" /></a>';

  if( is_front_page() && is_home()){
    echo '<h1>'. $tag .'</h1>';
  } else {
    echo $tag;
  }
}

/* ---------------------------------------
  メディアにアップロード済みの画像URLを、画像タイトルから取得
--------------------------------------- */
function get_media_url_by_name($target_image_title = "", $size = 'full'){
  $attachments = get_children(array('post_type' => 'attachment', 'post_mime_type' => 'image'));
  if(!empty($attachments)){
    foreach($attachments as $attachment){
      if($attachment->post_title == $target_image_title) {
        return wp_get_attachment_image_src($attachment->ID, $size)[0];
      }
    }
  } else {
    return null;
  }
}

/* ---------------------------------------
  メディアにアップロード済みの画像URLを、画像IDから取得
--------------------------------------- */
function get_media_url_by_id($target_image_id = "", $size = 'full'){
  if(!empty($target_image_id)){
    return wp_get_attachment_image_src($target_image_id, $size)[0];
  } else {
    return null;
  }
}

/* ---------------------------------------
  メディアサイズ関連
--------------------------------------- */
// 独自のサムネイルサイズ定義（Crop-thumbnailsプラグインなどで使う）
function add_thumbnail_size() {
  //add_image_size( '4_3_thumbnail', 560, 420, true );
}
add_action( 'after_setup_theme', 'add_thumbnail_size' );

// アップロードした時の自動生成を無効にする
function disable_image_sizes( $new_sizes ) {
  unset( $new_sizes['thumbnail'] );
  unset( $new_sizes['medium'] );
  unset( $new_sizes['large'] );
  unset( $new_sizes['medium_large'] );
  unset( $new_sizes['1536x1536'] );
  unset( $new_sizes['2048x2048'] );

  return $new_sizes;
}
add_filter( 'intermediate_image_sizes_advanced', 'disable_image_sizes' );
add_filter( 'big_image_size_threshold', '__return_false' );

/* ---------------------------------------
  アイキャッチURLを取得 (クエリループ中などの「現在の投稿」が対象)
--------------------------------------- */
function get_the_eyecatch_url($size = 'full') {
  
  $thumb_id = get_post_thumbnail_id();                         // アイキャッチ画像のIDを取得
  
  $thumb_img = wp_get_attachment_image_src($thumb_id, $size);  // $sizeサイズの画像内容を取得
  
  return $thumb_img[0];    // 画像のurlだけ取得
}

/* ---------------------------------------
  アイキャッチURLを取得 (ループ外での「特定の投稿」が対象)
--------------------------------------- */
function get_eyecatch_url($post_id, $size = 'full') {
  
  $thumb_id = get_post_thumbnail_id($post_id); // アイキャッチ画像のIDを取得
  
  $thumb_img = wp_get_attachment_image_src($thumb_id, $size);  // $sizeサイズの画像内容を取得
  
  return $thumb_img[0];    // 画像のurlだけ取得
}

/* ---------------------------------------
  抜粋テキスト取得
--------------------------------------- */
function get_post_excerpt($content=null, $length=120){
	if($content != null && $content !== ""){
    $mojionly = strip_tags($content);
    if(mb_strlen($mojionly) > $length) $t = '...';
      $content =  mb_substr($mojionly, 0, $length);
      $content .= $t;
	}
	
	return $content;
}

/* ---------------------------------------
  投稿に紐づく最下層カテゴリー取得
--------------------------------------- */
function get_category_child($post_id = null) {
  $result = null;
  foreach (get_the_category($post_id) as $category) {
    // カテゴリーIDを取得
    $cat_id = $category->term_id;
    // 子孫タームのIDを配列で取得
    $cat_child = get_term_children( $cat_id, 'category' );
    // 子孫タームのIDがない場合
    if( !$cat_child ){
      $result = array('id'=> $cat_id);
      $result += array('name'=> $category->name);
      $result += array('color'=> get_field('color', 'category_'.$cat_id));
      $result += array('icon'=> get_field('icon', 'category_'.$cat_id));
      break;
    }
  }
  return $result;
}

/* ---------------------------------------
  最新記事の日付を取得
--------------------------------------- */
function get_latest_update_date() {
  $post = get_posts('post_type=post&post_status=publish&posts_per_page=1');
  $date = '';
  if(isset($post[0])) {
    $date = mysql2date('Y年m月d日', $post[0]->post_date);
  }
  return $date;
}

/* ---------------------------------------
  目次を記事コンテンツに埋め込む
--------------------------------------- */
function add_toc($content){
  
  if (is_single()) {
    //「スキップアンカーを埋め込んだコンテンツ」と「目次」を取得
    $data = get_toc_data($content);

    // h2タグをマッチング
    if (preg_match('/<h2.*?>/i', $data['new_content'], $result)) {

      // h2の後ろに目次を連結して、コンテンツ内容を変更する
      $content = preg_replace('/<h2.*?>/i', $data['toc'] . $result[0], $data['new_content'], 1);
    }
  }
  return $content;
}
//add_filter('the_content', 'add_toc');

/* ---------------------------------------
  自動生成した目次データを取得する
  返り値  連想配列 new_content => スキップアンカーを埋め込んだコンテンツ
                  toc         => 目次要素
--------------------------------------- */
function get_toc_data($content, $isSide = false){
  $result = "";
  $pattern = '/<h[1-3]>(.+?)<\/h[1-3]>/s';
  preg_match_all($pattern, $content, $elements, PREG_SET_ORDER);

  if (count($elements) >= 1) {
    $toc = '';
    $i = 0;
    $currentlevel = 0;
    $id = 'chapter-';

    foreach ($elements as $element) {
      // スキップアンカーを埋め込む（目次クリックで読み飛ばすため）
      $id .= $i + 1;
      $replace_title = preg_replace('/<(h[1-3])>(.+?)<\/(h[1-3])>/s', '<$1 id="' . $id . '">$2</$3>', $element[0]);
      $content = str_replace($element[0], $replace_title, $content);

      if (strpos($element[0], '<h2') !== false) {
        $level = 1;
      } elseif (strpos($element[0], '<h3') !== false) {
        $level = 2;
      }

      while ($currentlevel < $level) {
        if ($currentlevel === 0) {
          $toc .= '<ul class="toc__list --parent">';
        } else {
          $toc .= '<ul class="toc__list --child">';
        }
        $currentlevel++;
      }

      while ($currentlevel > $level) {
        $toc .= '</li></ul>';
        $currentlevel--;
      }

      // 目次の項目で使用する要素を指定
      $custom_id = $isSide ? 'id="side-' . $id . '"' : 'id="article-' . $id . '"';
      if ($currentlevel === 2) {
        $toc .= '<li class="toc__item --child"><a class="toc__link --child" href="#' . $id . '"'. $custom_id .'><svg class="toc__icon"><use href="#fa-chevron"/></svg><span class="toc__text --child">' . $element[1] . '</span></a>';
      }else{
        $toc .= '<li class="toc__item --parent"><a class="toc__link --parent" href="#' . $id . '"'. $custom_id .'><span class="toc__text --parent">' . $element[1] . '</span></a>';
      }
      $i++;
      $id = 'chapter-';
    } // foreach

    // 目次の最後の項目をどの要素から作成したかによりタグの閉じ方を変更
    while ($currentlevel > 0) {
      $toc .= '</li></ul>';
      $currentlevel--;
    }

    $modifierName = $isSide ? "--side" : "";
    $result = '<div class="toc '. $modifierName .'"><div class="toc__header">タップできるもくじ</div><div class="toc__content">' .$toc. '</div></div>';
  }
  return array('new_content' => $content, 'toc' => $result);
}

/* ---------------------------------------
  ページネーション出力関数
    $paged : 現在のページ
    $pages : 全ページ数
    $range : 左右に何ページ表示するか
--------------------------------------- */
function pagination( $pages, $paged, $range = 2 ) {

  $pages = ( int ) $pages;    //float型で渡ってくるので明示的に int型 へ
  $paged = $paged ?: 1;       //get_query_var('paged')をそのまま投げても大丈夫なように

  // １ページだけしかない場合
  if ( $pages === 1 ) return;

  // ２ページ以上ある場合
  if ( 1 !== $pages ) {
      echo '<div class="pagination">';
      
      // range：2 の場合
      // paged が3より大きかったら、ページネーション「最初へ」を表示
      if($paged > $range + 1){
        // 「最初へ」 の表示
        echo '<a href="', get_pagenum_link(1) ,'" class="pagination__pager --first">', '« 最初へ' ,'</a>';
      }

      //「前１ページ、現在ページ、後２ページ」を組み立てる
      for ( $i = 1; $i <= $pages; $i++ ) {

        // iが範囲外なら即break
        if($i > $paged + $range) break;
        
        // beforeRange：現在ページより遡って表示する数(デフォルト1)
        // paged：8、range：2、pages：10 の場合
        // 7,8,9,10をページネーションする
        $beforeRange = 1;
        if($paged > $pages - $range)
          $beforeRange = ($paged + $range + 1) - $pages;
        
        // paged：4、range：2、beforeRange：1 の場合
        // 3,4,5,6をページネーションする
        if($i >= $paged - $beforeRange && $i <= $paged + $range) {
          if ( $paged === $i ) {
            echo '<span class="pagination__pager --current">', $i ,'</span>';
          } else {
            echo '<a href="', get_pagenum_link( $i ) ,'" class="pagination__pager">', $i ,'</a>';
          }
        }
      }

      // range：2、pages：10 の場合
      // paged が8より小さかったら、ページネーション10 を表示
      if( $paged + $range < $pages){
        echo '・・・<a href="', get_pagenum_link( $pages ) ,'" class="pagination__pager">', $pages ,'</a>';
      }
      echo '</div>';
  }
}

/* ---------------------------------------
  検索結果をカスタマイズ
--------------------------------------- */
// サイト内検索の範囲に、カテゴリー名、タグ名、を含める
function custom_search($search, $wp_query) {
  global $wpdb;
   
  //サーチページ以外だったら終了
  if (!$wp_query->is_search)
    return $search;
  
  if (!isset($wp_query->query_vars))
    return $search;
   
  // タグ名・カテゴリ名も検索対象に
  $search_words = explode(' ', isset($wp_query->query_vars['s']) ? $wp_query->query_vars['s'] : '');
  if ( count($search_words) > 0 ) {
    $search = '';
    foreach ( $search_words as $word ) {
      if ( !empty($word) ) {
        $search_word = $wpdb->prepare("%{$word}%");
        $search .= " AND (
            {$wpdb->posts}.post_title LIKE '{$search_word}'
            OR {$wpdb->posts}.ID IN (
              SELECT distinct r.object_id
              FROM {$wpdb->term_relationships} AS r
              INNER JOIN {$wpdb->term_taxonomy} AS tt ON r.term_taxonomy_id = tt.term_taxonomy_id
              INNER JOIN {$wpdb->terms} AS t ON tt.term_id = t.term_id
              WHERE t.name LIKE '{$search_word}'
            OR t.slug LIKE '{$search_word}'
            OR tt.description LIKE '{$search_word}'
            )
        ) ";
      }
    }
  }  
  return $search;
}
add_filter('posts_search','custom_search', 10, 2);

// 検索結果のクエリーに好みの条件を追加
function change_posts_paging($query) {

  // 管理画面やメインクエリーでない場合は除外
  if ( is_admin() || ! $query->is_main_query() ) {
    return;
  }
  // 検索結果ページ
  if ( $query->is_search() ) {
    // 公開されてる記事のみ検索
    $query->set( 'post_status', 'publish' );
    // 投稿のみ検索
    $query->set( 'post_type', 'post' );
    // 表示したくないカテゴリーID
    //$query->set( 'category__not_in', 1 );
    // 表示したくない投稿ID。arrayで複数指定可。
    //$query->set( 'post__not_in', array( 1, 2, 3, 4, 5 ) );
    // 検索結果の表示順
    $query->set( 'order', 'DESC' );
    return;
  }
}
add_action( 'pre_get_posts', 'change_posts_paging' );

/* ---------------------------------------
  デバイス判別
  アクセス端末がスマホかそれ以外(タブレット＆PC)かどうか判別する
--------------------------------------- */
function is_mobile() {
  //ユーザーエージェントを取得（上のような文字列が取得される）
  $ua = $_SERVER['HTTP_USER_AGENT'];

  //スマホ、タブレット、それ以外（PC）を判定する
  //スマホの判定（Android且つMobileまたはiPhoneを含む文字列の場合）
  if ((strpos($ua, 'Android') !== false) && (strpos($ua, 'Mobile') !== false) || (strpos($ua, 'iPhone') !== false)) {
    return 'sp';  
  } elseif ((strpos($ua, 'Android') !== false) || (strpos($ua, 'iPad') !== false)) {
    return 'tab';
  } else {
    return 'pc';
  }
}

// function is_mobile() {
//   $useragents = array(
//     'iPhone',
//     'iPod',
//     'Android.*Mobile',
//     'Windows.*Phone',
//     'dream', // Pre 1.5 Android
//     'CUPCAKE', // 1.5+ Android
//     'blackberry9500', // Storm
//     'blackberry9530', // Storm
//     'blackberry9520', // Storm v2
//     'blackberry9550', // Storm v2
//     'blackberry9800', // Torch
//     'webOS', // Palm Pre Experimental
//     'incognito', // Other iPhone browser
//     'webmate' // Other iPhone browser
//   );  
//   $pattern = '/' . implode('|', $useragents) . '/i';
//   return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
// }

/* ---------------------------------------
  ACF プラグインの設定
--------------------------------------- */

/*【管理画面】ACF Options Page の設定 */
if( function_exists('acf_add_options_page') ) {
  acf_add_options_page(array(
    'page_title'  => '',
    'menu_title'  => 'カスタマイズ',
    'menu_slug'   => 'theme-general-settings',
    'redirect'    => false,
  ));
}

/* ACF block 登録 */
add_action('acf/init', 'my_acf_init_block_types');
function my_acf_init_block_types() {
  if( function_exists('acf_register_block') ) {

    /* 商品リンク */
    acf_register_block_type(array(
      'name'            => 'external-link',
      'title'           => __( '商品リンク' ),
      'description'     => __( '商品リンク' ),
      'render_callback'	=> 'my_acf_block_render_callback',
      'category'        => 'formatting',
      'icon'            => 'admin-comments',
      'mode'            => 'edit'
    ));

    /* 関連記事リンク */
    acf_register_block_type(array(
      'name'            => 'internal-link',
      'title'           => __( '関連記事リンク' ),
      'description'     => __( '関連記事リンク' ),
      'render_callback'	=> 'my_acf_block_render_callback',
      'category'        => 'formatting',
      'icon'            => 'admin-comments',
      'mode'            => 'edit'
    ));

    /* メディア画像 */
    acf_register_block_type(array(
      'name'            => 'picture',
      'title'           => __( '挿入画像' ),
      'description'     => __( '挿入画像' ),
      'render_callback'	=> 'my_acf_block_render_callback',
      'category'        => 'formatting',
      'icon'            => 'admin-comments',
      'mode'            => 'edit'
    ));

    /* コメント（汎用的なテキストボックス） */
    acf_register_block_type(array(
      'name'            => 'comment-box',
      'title'           => __( 'コメントボックス' ),
      'description'     => __( 'コメントボックス' ),
      'render_callback'	=> 'my_acf_block_render_callback',
      'category'        => 'formatting',
      'icon'            => 'admin-comments',
      'mode'            => 'edit'
    ));

    /* ゲージ */
    acf_register_block_type(array(
      'name'            => 'gauge',
      'title'           => __( '評価ゲージ' ),
      'description'     => __( '評価ゲージ' ),
      'render_callback'	=> 'my_acf_block_render_callback',
      'category'        => 'formatting',
      'icon'            => 'admin-comments',
      'mode'            => 'edit'
    ));

    /* 引用 */
    acf_register_block_type(array(
      'name'            => 'quote',
      'title'           => __( '引用' ),
      'description'     => __( '引用' ),
      'render_callback'	=> 'my_acf_block_render_callback',
      'category'        => 'formatting',
      'icon'            => 'admin-comments',
      'mode'            => 'edit'
    ));

    /* 埋め込み */
    acf_register_block_type(array(
      'name'            => 'embed',
      'title'           => __( '埋め込み' ),
      'description'     => __( '埋め込み' ),
      'render_callback'	=> 'my_acf_block_render_callback',
      'category'        => 'formatting',
      'icon'            => 'admin-comments',
      'mode'            => 'edit'
    ));
  }
}
function my_acf_block_render_callback( $block ) {
  // $block['name']に含まれる'acf/'文字列を除去
  $slug = str_replace( 'acf/', '', $block['name'] );
	if( file_exists( get_theme_file_path("/template-parts/acf-blocks/{$slug}.php") ) ) {
          include( get_theme_file_path("/template-parts/acf-blocks/{$slug}.php") );
	}
}

/* ACF Groupフィールドのデータを整形（type,label,valueを返す） */
function get_acf_group_subfields_data($field_name, $post_id) {
  $field = get_field_object($field_name, $post_id);
  $data = array();
  foreach ($field['sub_fields'] as $i => $subfield) {
    $data[] = array(
      'type' => $subfield['type'],
      'label' => $subfield['label'],
    );
    if ($subfield['type'] == 'taxonomy') {
      $data[$i]['value'] = array_column($field['value'][$subfield['name']], 'name', 'term_id');
    } else {
      $data[$i]['value'] = $field['value'][$subfield['name']];
    }
  }
  return $data;
}

/* ACF管理データ取得関数 */
function get_option_post_list_reccomend() {
  // 管理：おすすめ記事リスト
  $data = array();
  if (have_rows('post-list-reccomend', 'option')) {
    while (have_rows('post-list-reccomend', 'option')) { the_row();
      $index = get_row_index();
      $data[$index] = get_sub_field('post-object');
    }
  }
  return $data;
}

function get_option_post_list_new_by_category() {
  // 管理：カテゴリ別最新記事の表示オプション
  $data = array();
  if (have_rows('post-list-new-by-category', 'option')) {
    while (have_rows('post-list-new-by-category', 'option')) { the_row();
      $index = get_row_index();
      $data[$index]['title'] = get_sub_field('title');
      $data[$index]['category'] = get_sub_field('category');
      $data[$index]['count'] = get_sub_field('count');
    }
  }
  return $data;
}

// 管理情報 -> フィールドデータを取得
function get_option_field($field_name) {
  $data = get_field($field_name, 'option');
  return $data;
}

function get_option_banner($banner_pos) {
  $data = array();

  // 管理：バナーリンク設定リスト
  if (have_rows('banner-settings', 'option')) {
    while (have_rows('banner-settings', 'option')) { the_row();
      // １：表示許可かチェック
      $is_display = get_sub_field('display');
      if (!$is_display) {
        continue;
      }

      // ３：期間限定かチェック
      $is_limited = get_sub_field('limited');
      if ($is_limited) {
        $today = new DateTime('now', new DateTimeZone('Asia/Tokyo'));
        $promo_end = new DateTime(get_sub_field('end'), new DateTimeZone('Asia/Tokyo'));
        $promo_start = new DateTime(get_sub_field('start'), new DateTimeZone('Asia/Tokyo'));
        
        // キャンペーン期間中かチェック
        if ($promo_start > $today || $promo_end < $today) {
          continue;
        }
      }
      
      // バナー情報リスト取得
      if (have_rows('banner-list', 'option')) {
        while (have_rows('banner-list', 'option')) { the_row();

          // 広告の表示位置が引数と一致するなら、返却データに追加する
          $positions = get_sub_field('position');
          foreach ($positions as $pos) {
            if ($pos == $banner_pos) {
              $data[]['body'] = get_sub_field('body');
            }
          }
        }
      }      
    }
    // 歯抜けになった配列を圧縮
    $data = array_values($data);
  }

  return $data;
}