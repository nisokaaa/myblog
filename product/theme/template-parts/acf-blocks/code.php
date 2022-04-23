<?php
/*--------------------------------------------------------------
>>> [AFC block] 「コード」ブロック
--------------------------------------------------------------*/
// エスケープ処理を行う。
// 
// 特殊文字が含まれた文字列をHTMLエンティティに変換する。
// 「<script></script>」→「&lt;script&gt;&lt;/script&gt;」にしてエラーを回避する。
//
// 特殊文字とは「 , ' " & < > 」のこと。
// HTMLエンティティとは「アンパサンド & で始まりセミコロン ; で終わるテキスト」のこと。
?>
<?php 
$body = get_field('code-body');
$escaped_code = htmlspecialchars($body, ENT_QUOTES, 'UTF-8');
?>
<div class="code">
  <div class="code__inner">
    <pre><code class="code__body"><?php echo $escaped_code; ?></code></pre>
  </div>
</div>