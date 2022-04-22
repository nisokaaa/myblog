<?php
/*--------------------------------------------------------------
>>> [AFC block] 「コード」ブロック
--------------------------------------------------------------*/ ?>
<?php 
$body = get_field('code-body');
?>
<div class="code">
  <div class="code__inner">
    <pre><code class="code__body"><?php echo $body; ?></code></pre>
  </div>
</div>