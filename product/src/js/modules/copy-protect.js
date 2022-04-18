// 記事画像の ”ドラック” ”右クリック” を禁止する
document.addEventListener("DOMContentLoaded", function() {
  const elements = document.getElementsByClassName('copy-protect');
  for (let i = 0; i < elements.length; i++) {
    elements[i].oncontextmenu = function () {return false;}
    elements[i].onselectstart = function () {return false;}
    elements[i].onmousedown = function () {return false;}
  }
}, {passive: true});