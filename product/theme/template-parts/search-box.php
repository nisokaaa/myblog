<?php
/*--------------------------------------------------------------
>>> search-box.php：検索ボックス テンプレートパーツ
--------------------------------------------------------------*/
?>
<?php
  // captionの有無(デフォTRUE)
  $caption = isset($args['option']['caption']) ? $args['option']['caption'] : true;
  // modifire
  $mod = isset($args['option']['mod']) ? $args['option']['mod'] : '';
?>

<?php if ($caption) { ?>
<div class="caption --mb-unset">
  <svg class="caption__icon"><use href="#fa-search"/></svg>
  <h2 class="caption__text">サイト検索</h2>
</div>
<?php } ?>

<form class="search-box <?php echo $mod; ?>" role="search" method="get" action="/">
  <input class="search-box__input js_search-input" type="search" name="s" placeholder="検索ワードを入力" maxlength="100">
  <button class="search-box__submit-btn" type="submit" aria-label="検索ボタン">
    <svg class="search-box__submit-icon"><use href="#fa-search"/></svg>
  </button>
</form>