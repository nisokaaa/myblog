import hljs from 'highlight.js/lib/core';
import javascript from 'highlight.js/lib/languages/javascript';
import css from 'highlight.js/lib/languages/css';
import php from 'highlight.js/lib/languages/php';
import scss from 'highlight.js/lib/languages/scss';
import xml from 'highlight.js/lib/languages/xml';
import bash from 'highlight.js/lib/languages/bash';

import 'highlight.js/styles/github-dark.css'; //CSSスタイル変更はここ

hljs.registerLanguage('javascript', javascript);
hljs.registerLanguage('css', css);
hljs.registerLanguage('php', php);
hljs.registerLanguage('scss', scss);
hljs.registerLanguage('xml', xml);
hljs.registerLanguage('bash', bash);

document.addEventListener("DOMContentLoaded", function() {
  const highlightBlocks = document.getElementsByClassName('code__body');

  for (let i = 0; i < highlightBlocks.length; i++) {
    // ハイライト後のコードを取得し、既存コードと入れ替え
    const highlightedCode = hljs.highlightAuto(highlightBlocks[i].innerText).value;
    highlightBlocks[i].innerHTML = highlightedCode;
  }
  
}, {passive: true});