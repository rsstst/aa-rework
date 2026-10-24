import './cart';

const searchInput = document.querySelector('#site-search');
const searchClear = document.querySelector('[data-search-clear]');

if (searchInput && searchClear) {
    const updateSearchClear = () => {
        searchClear.dataset.visible = String(searchInput.value.length > 0);
    };

    searchInput.addEventListener('input', updateSearchClear);
    searchClear.addEventListener('click', () => {
        searchInput.value = '';
        updateSearchClear();
        searchInput.focus();
    });
    updateSearchClear();
}

const mobileToggle = document.querySelector('[data-mobile-toggle]');
const mobileNavigation = document.querySelector('[data-mobile-navigation]');
const menuOpenIcon = document.querySelector('[data-menu-open]');
const menuCloseIcon = document.querySelector('[data-menu-close]');

if (mobileToggle && mobileNavigation && menuOpenIcon && menuCloseIcon) {
    mobileToggle.addEventListener('click', () => {
        const isOpen = mobileToggle.getAttribute('aria-expanded') === 'true';

        mobileToggle.setAttribute('aria-expanded', String(!isOpen));
        mobileToggle.setAttribute('aria-label', isOpen ? 'Buka menu navigasi' : 'Tutup menu navigasi');
        mobileNavigation.classList.toggle('hidden', isOpen);
        menuOpenIcon.classList.toggle('hidden', !isOpen);
        menuCloseIcon.classList.toggle('hidden', isOpen);
    });
}

const siteHeader = document.querySelector('[data-site-header]');
const tagline = document.querySelector('[data-tagline]');

if (siteHeader && tagline) {
    const updateHeaderOnScroll = () => {
        const isScrolled = window.scrollY > 12;

        siteHeader.classList.toggle('bg-white/70', isScrolled);
        siteHeader.classList.toggle('backdrop-blur-xl', isScrolled);
        siteHeader.classList.toggle('shadow-[0_8px_30px_rgba(15,23,42,0.08)]', isScrolled);
        siteHeader.classList.toggle('border-white/40', isScrolled);
        siteHeader.classList.toggle('bg-white/95', !isScrolled);
        siteHeader.classList.toggle('shadow-[0_6px_24px_rgba(15,23,42,0.06)]', !isScrolled);
        siteHeader.classList.toggle('border-slate-200/80', !isScrolled);

        tagline.classList.toggle('max-h-0', isScrolled);
        tagline.classList.toggle('py-0', isScrolled);
        tagline.classList.toggle('opacity-0', isScrolled);
        tagline.classList.toggle('max-h-12', !isScrolled);
        tagline.classList.toggle('opacity-100', !isScrolled);
    };

    window.addEventListener('scroll', updateHeaderOnScroll, { passive: true });
    updateHeaderOnScroll();
}
