import hljs from 'highlight.js/lib/core';
import javascript from 'highlight.js/lib/languages/javascript';
import 'highlight.js/styles/github-dark.css'; //CSSスタイル変更はここ

hljs.registerLanguage('javascript', javascript);

document.addEventListener("DOMContentLoaded", function() {
  const highlightBlocks = document.getElementsByClassName('code__body');

  for (let i = 0; i < highlightBlocks.length; i++) {
    // ハイライト後のコードを取得し、既存コードと入れ替え
    const highlightedCode = hljs.highlightAuto(highlightBlocks[i].innerHTML).value;
    highlightBlocks[i].innerHTML = highlightedCode;
  }
}, {passive: true});