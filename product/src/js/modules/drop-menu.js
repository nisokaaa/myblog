import * as scroll from '../lib/scroll';
import * as mediaQuery from '../lib/media-query';

document.addEventListener("DOMContentLoaded", function()
{
  const bg = document.getElementById('header__drop-menu-bg');

  const searchMenu = document.getElementById('header__search-menu');
  const mobileMenu = document.getElementById('header__mobile-menu');

  const searchMenuToggleCheckbox = document.getElementById('search-menu-toggle__checkbox');
  const mobileMenuToggleCheckbox = document.getElementById('mobile-menu-toggle__checkbox');

  const searchInput = document.querySelector('#header__search-menu .search-menu__input');
  const searchMenuToggleIcon = document.getElementById('search-menu-toggle__icon');
  const searchMenuToggleBtnText1 = document.getElementById('search-menu-toggle__text-1');
  const searchMenuToggleBtnText2 = document.getElementById('search-menu-toggle__text-2');
  
  const mobileMenuToggleBtnLine1 = document.getElementById('mobile-menu-toggle__btn-line-1');
  const mobileMenuToggleBtnLine2 = document.getElementById('mobile-menu-toggle__btn-line-2');
  const mobileMenuToggleBtnLine3 = document.getElementById('mobile-menu-toggle__btn-line-3');
  const mobileMenuToggleBtnText1 = document.getElementById('mobile-menu-toggle__text-1');
  const mobileMenuToggleBtnText2 = document.getElementById('mobile-menu-toggle__text-2');

  // ------------------------------------------------------------
  // 開閉ボタン(チェックボックス)のON/OFFによって、メニューを開閉する
  // ------------------------------------------------------------
  searchMenuToggleCheckbox.addEventListener('change', function() {
    if (searchMenuToggleCheckbox.checked) {
      closeMobileMenu();
      openSearchMenu();
    } else {
      closeSearchMenu();
    }
  });
  mobileMenuToggleCheckbox.addEventListener('change', function() {
    if (mobileMenuToggleCheckbox.checked) {
      closeSearchMenu();
      openMobileMenu();
    } else {
      closeMobileMenu();
    }
  });

  // ------------------------------------------------------------
  // メニューが開いている状態で「スクロールしたら」メニューを閉じる
  // ------------------------------------------------------------
  window.addEventListener('scroll', function()
  {
    if ((searchMenuToggleCheckbox.checked || mobileMenuToggleCheckbox.checked ) && scroll.getScrolled() > 300) {
      closeSearchMenu();
      closeMobileMenu();
    }
  });

  // ------------------------------------------------------------
  // メニューが開いている状態で「背景をクリックしたら」メニューを閉じる
  // ------------------------------------------------------------
  bg.addEventListener('click', function(){
    closeSearchMenu();
    closeMobileMenu();
  });

  function openSearchMenu() {
    bg.classList.add('--show');
    searchMenu.classList.add('--show');

    // 検索窓に自動フォーカス
    searchInput.focus();

    // ボタンの「文言とアイコン」を変更
    searchMenuToggleIcon.innerHTML = '<use href="#fa-times"/>';
    searchMenuToggleIcon.classList.add('--active');
    searchMenuToggleBtnText1.classList.remove('--active');
    searchMenuToggleBtnText2.classList.add('--active');
  }

  function closeSearchMenu() {
    bg.classList.remove('--show');
    searchMenu.classList.remove('--show');
    searchMenuToggleIcon.innerHTML = '<use href="#fa-search"/>';
    searchMenuToggleIcon.classList.remove('--active');
    searchMenuToggleCheckbox.checked = false;
    searchMenuToggleBtnText1.classList.add('--active');
    searchMenuToggleBtnText2.classList.remove('--active');
  }

  function openMobileMenu() {
    bg.classList.add('--show');
    mobileMenu.classList.add('--show');

    // ボタンの「マークと文言を変更」
    mobileMenuToggleBtnLine1.classList.add('--active');
    mobileMenuToggleBtnLine2.classList.add('--active');
    mobileMenuToggleBtnLine3.classList.add('--active');
    mobileMenuToggleBtnText1.classList.remove('--active');
    mobileMenuToggleBtnText2.classList.add('--active');
  }

  function closeMobileMenu() {
    bg.classList.remove('--show');
    mobileMenu.classList.remove('--show');
    mobileMenuToggleCheckbox.checked = false;

    mobileMenuToggleBtnLine1.classList.remove('--active');
    mobileMenuToggleBtnLine2.classList.remove('--active');
    mobileMenuToggleBtnLine3.classList.remove('--active');
    mobileMenuToggleBtnText1.classList.add('--active');
    mobileMenuToggleBtnText2.classList.remove('--active');
  }
});
