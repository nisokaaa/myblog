import Swiper, { Navigation, Autoplay, Lazy } from 'swiper';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/autoplay';
import 'swiper/css/lazy';

document.addEventListener("DOMContentLoaded", function() {
  // configure Swiper to use modules
  Swiper.use([Navigation, Autoplay, Lazy]);

  const heroSlider = new Swiper('#hero .swiper-container', {
    loop: true,
    preloadImages: false, //画像の先読みを無効に
    lazy: { // Lazy Loading を有効に
      loadPrevNext: true, //前後の画像を先に読み込んでおく
    },
    watchSlidesProgress: true,//各スライドの進行状況を監視（lazyがOnならtrue必須）
    autoplay: {
      delay: 3500,
      disableOnInteraction: false,
    },
    breakpoints: {
      // Sp/Tabの場合
      passiveListeners: true,
      
      // Pcの場合
      960: {
        grabCursor: true,
      }
    },
    navigation: {
      nextEl: '#hero .swiper-button-next',
      prevEl: '#hero .swiper-button-prev',
    },
    // 1画面に見えるスライドの数を設定
    slidesPerView: 'auto',
  });
}, {passive: true});