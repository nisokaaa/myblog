<?php
/*--------------------------------------------------------------
>>> header.php：ヘッダーテンプレートパーツ
--------------------------------------------------------------*/ 
// twitter_idを取得
$twitter_id = get_option_field('twitter-id');
?>

<header class="header">
  
  <!-- ribbon-menu -->
  <div class="header__ribbon-menu">
    <div class="header__ribbon-menu-wrapper">
      
      <!-- logo -->
      <div class="header__logo">
        <?php echo_custom_logo("header__logo-link", "header__logo-img"); ?>
      </div>

      <!-- sns -->
      <div class="header__sns">
        <a class="header__sns-btn" href="https://twitter.com/<?php echo $twitter_id; ?>" target="_blank" rel="noopener" aria-label="Twitterリンクボタン" onclick="gtag('event', 'click', {'event_category':'twitter_link', 'value':'1'});">
          <svg class="header__sns-icon"><use href="#fa-twitter"/></svg>
        </a>
      </div>

      <!-- search-menu-toggle -->
      <div class="header__search-menu-toggle">
        <div class="search-menu-toggle">
          <input class="search-menu-toggle__checkbox" id="search-menu-toggle__checkbox" type="checkbox">
          <label class="search-menu-toggle__btn" for="search-menu-toggle__checkbox" aria-label="検索メニュー開閉ボタン">
            <svg class="search-menu-toggle__icon" id="search-menu-toggle__icon"><use href="#fa-search"/></svg>
            <p class="search-menu-toggle__text-box">
              <span class="search-menu-toggle__text --text-1 --active" id="search-menu-toggle__text-1">SEARCH</span>
              <span class="search-menu-toggle__text --text-2" id="search-menu-toggle__text-2">CLOSE</span>
            </p>
          </label>
        </div>
      </div>

      <!-- mobile-menu-toggle -->
      <div class="header__mobile-menu-toggle">
        <div class="mobile-menu-toggle">
          <input class="mobile-menu-toggle__checkbox" id="mobile-menu-toggle__checkbox" type="checkbox" style="display:none;">
          <label class="mobile-menu-toggle__btn" id="mobile-menu-toggle__btn" for="mobile-menu-toggle__checkbox" aria-label="ドロワーメニュー開閉ボタン">
            <span class="mobile-menu-toggle__btn-line-1" id="mobile-menu-toggle__btn-line-1"></span>
            <span class="mobile-menu-toggle__btn-line-2" id="mobile-menu-toggle__btn-line-2"></span>
            <span class="mobile-menu-toggle__btn-line-3" id="mobile-menu-toggle__btn-line-3"></span>
            <p class="mobile-menu-toggle__text-box">
              <span class="mobile-menu-toggle__text --text-1 --active" id="mobile-menu-toggle__text-1">MENU</span>
              <span class="mobile-menu-toggle__text --text-2" id="mobile-menu-toggle__text-2">CLOSE</span>
            </p>
          </label>
        </div>
      </div>
    </div>
  </div>

  <!-- drop-menu -->
  <div class="header__drop-menu">
    <div class="header__drop-menu-bg" id="header__drop-menu-bg"></div>

    <!-- search-menu -->
    <div class="header__search-menu" id="header__search-menu">
      <div class="search-menu">
        <form class="search-menu__form" role="search" method="get" action="/">
          <svg class="search-menu__symbol-icon"><use href="#fa-search"/></svg>
          <input class="search-menu__input" type="search" name="s" placeholder="検索ワードを入力してください" maxlength="100">
          <button class="search-menu__submit-btn" type="submit">
            <span class="search-menu__submit-text">検索</span>
          </button>
        </form>
      </div>
    </div>

    <!-- mobile-menu -->
    <div class="header__mobile-menu" id="header__mobile-menu">
      <nav class="mobile-menu" id="mobile-menu">
        <a class="mobile-menu__link" href="<?php echo esc_url(home_url('/')); ?>">
          <span class="mobile-menu__text">ホーム</span>
          <svg class="mobile-menu__icon"><use href="#fa-chevron"/></svg>
        </a>
        <a class="mobile-menu__link" href="<?php echo esc_url(home_url().'/about'); ?>">
          <span class="mobile-menu__text">このサイトについて</span>
          <svg class="mobile-menu__icon"><use href="#fa-chevron"/></svg>
        </a>
      </nav>
    </div>
  </div>
</header>

<!-- scroll-btn -->
<div class="scroll-btn" id="scroll-btn-sticky">
  <svg class="scroll-btn__icon"><use href="#fa-chevron"/></svg>
</div>
