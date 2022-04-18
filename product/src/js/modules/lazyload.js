// import npm package
import lozad from 'lozad';

// ------------------------------------------------------------
// IntersectionObserver API 画像遅延ロードライブラリ初期化処理
// ------------------------------------------------------------
const observer = lozad('.lozad', {
  rootMargin: '100% 0px',
});
observer.observe();

// ------------------------------------------------------------
// Cumulative Layout Shift ロード前の画像の高さが分からずガクつく問題対応
// ------------------------------------------------------------
document.addEventListener("DOMContentLoaded", function() {
  
  const lozad_elements = document.getElementsByClassName("keep-ratio");
  const lozad_ratios = [];

  // アスペクト比 計算
  for (let i = 0; i < lozad_elements.length; i++) {
    const width = lozad_elements[i].getAttribute('width');
    const height = lozad_elements[i].getAttribute('height');
    lozad_ratios[i] = height / width;
  }

  // DOM構築後に最適化
  adjustRatio(lozad_elements, lozad_ratios);

  // windowサイズ変更時にも最適化
  let timer;
  window.addEventListener('resize', function() {
    clearTimeout(timer);
    timer = setTimeout(function() {
      adjustRatio(lozad_elements, lozad_ratios);
    }, 100);
  }, {passive: true});

  // ------------------------------------------------------------
  // アス比から画像高さを計算
  // ------------------------------------------------------------
  function adjustRatio(elems, ratios){
    for (let i = 0; i < elems.length; i++) {
      elems[i].style.height = elems[i].clientWidth * ratios[i] + 'px';
    }
  }
}, {passive: true});