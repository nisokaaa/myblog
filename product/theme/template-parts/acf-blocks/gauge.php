<?php
/*--------------------------------------------------------------
>>> [AFC block] 「評価ゲージ」ブロック
--------------------------------------------------------------*/ ?>
<?php 
$title = get_field('gauge-title');
$rate = get_field('gauge-rate');
?>

<div class="gauge">
  <span class="gauge__title"><?php echo $title; ?></span>
  <span class="gauge__rate --rate-w-<?php echo $rate * 10; ?>"></span>
  <span class="gauge__point"><?php echo $rate; ?><span style="font-size:75%;">点</span></span>
</div>