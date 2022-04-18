<?php
/*--------------------------------------------------------------
>>> 広告テンプレートパーツ PC・タブレット版サイドバー下部
--------------------------------------------------------------*/ ?>
<div class="adsense --pc-tab-side-bottom">
  <?php 
  $banners = get_option_banner('pc-tab-side-bottom');
  foreach ($banners as $banner) { ?>
  <div class="adsense__box">
    <?php echo $banner['body']; ?>
  </div>
  <?php } ?>
</div>