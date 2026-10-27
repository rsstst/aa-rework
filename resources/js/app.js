import './cart';

const searchInput = document.querySelector('#site-search');
const searchClear = document.querySelector('[data-search-clear]');

if (searchInput && searchClear) {
    const updateSearchClear = () => {
        searchClear.dataset.visible = String(searchInput.value.trim().length > 0);
    };

    searchInput.addEventListener('input', updateSearchClear);
    searchClear.addEventListener('click', () => {
        searchInput.value = '';
        updateSearchClear();
        searchInput.focus();
        searchInput.form?.dispatchEvent(new Event('submit', { cancelable: true }));
    });
    updateSearchClear();

    let searchTimer = null;
    const submitSearch = () => {
        if (!searchInput.form) {
            return;
        }

        if (searchTimer) {
            window.clearTimeout(searchTimer);
        }

        searchTimer = window.setTimeout(() => {
            if (searchInput.value.trim().length >= 2 || searchInput.value.trim().length === 0) {
                searchInput.form.submit();
            }
        }, 200);
    };

    searchInput.addEventListener('input', () => {
        if (searchTimer) {
            window.clearTimeout(searchTimer);
        }
    });

    searchInput.addEventListener('keydown', (event) => {
        if (event.key === 'Enter') {
            if (searchTimer) {
                window.clearTimeout(searchTimer);
            }

            if (!searchInput.form) {
                return;
            }

            searchInput.form.submit();
        }
    });
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

const priceFilter = document.querySelector('[data-price-filter]');

if (priceFilter) {
    const minInput = priceFilter.querySelector('[data-price-input="min"]');
    const maxInput = priceFilter.querySelector('[data-price-input="max"]');
    const minSlider = priceFilter.querySelector('[data-price-slider="min"]');
    const maxSlider = priceFilter.querySelector('[data-price-slider="max"]');
    const rangeFill = priceFilter.querySelector('[data-price-range-fill]');

    if (minInput && maxInput && minSlider && maxSlider && rangeFill) {
        const minimum = Number(minSlider.min);
        const maximum = Number(minSlider.max);

        const updateRange = () => {
            const minValue = Math.min(Number(minSlider.value), Number(maxSlider.value));
            const maxValue = Math.max(Number(maxSlider.value), minValue);
            const minPercentage = ((minValue - minimum) / (maximum - minimum)) * 100;
            const maxPercentage = ((maxValue - minimum) / (maximum - minimum)) * 100;

            rangeFill.style.cssText = `
                left: ${minPercentage}%;
                width: ${Math.max(maxPercentage - minPercentage, 0)}%;
            `;
        };

        const syncSliderValue = (input, slider, fallback) => {
            const rawValue = input.value.trim();

            if (rawValue === '') {
                slider.value = fallback;
                return;
            }

            const value = Number(rawValue);

            slider.value = Number.isFinite(value)
                ? Math.min(Math.max(value, minimum), maximum)
                : fallback;
        };

        const syncInputRange = (input, slider, otherSlider, otherInput, fallback) => {
            syncSliderValue(input, slider, fallback);

            if (Number(slider.value) > Number(otherSlider.value)) {
                otherSlider.value = slider.value;
                otherInput.value = slider.value;
            }

            updateRange();
        };

        const adjustInput = (input, direction) => {
            const fallback = input === maxInput ? maximum : minimum;
            const currentValue = Number(input.value);
            const nextValue = Math.min(
                Math.max((Number.isFinite(currentValue) ? currentValue : fallback) + direction * 5000, minimum),
                maximum,
            );

            input.value = nextValue;
            input.dispatchEvent(new Event('change', { bubbles: true }));
        };

        minSlider.addEventListener('input', () => {
            const nextMin = Math.min(Number(minSlider.value), Number(maxSlider.value));

            minSlider.value = nextMin;
            minInput.value = nextMin;
            updateRange();
        });

        maxSlider.addEventListener('input', () => {
            const nextMax = Math.max(Number(maxSlider.value), Number(minSlider.value));

            maxSlider.value = nextMax;
            maxInput.value = nextMax;
            updateRange();
        });

        minInput.addEventListener('change', () => {
            syncInputRange(minInput, minSlider, maxSlider, maxInput, minimum);
        });

        maxInput.addEventListener('change', () => {
            syncSliderValue(maxInput, maxSlider, maximum);

            if (Number(maxSlider.value) < Number(minSlider.value)) {
                minSlider.value = maxSlider.value;
                minInput.value = minSlider.value;
            }

            updateRange();
        });

        [minInput, maxInput].forEach((input) => {
            input.addEventListener('pointerdown', (event) => {
                const bounds = input.getBoundingClientRect();
                const isSpinnerArea = event.clientX >= bounds.right - 24;

                if (!isSpinnerArea) {
                    return;
                }

                event.preventDefault();
                input.focus();
                const direction = event.clientY < bounds.top + bounds.height / 2 ? 1 : -1;
                adjustInput(input, direction);
            });

            input.addEventListener('keydown', (event) => {
                if (event.key !== 'ArrowUp' && event.key !== 'ArrowDown') {
                    return;
                }

                event.preventDefault();
                const direction = event.key === 'ArrowUp' ? 1 : -1;
                adjustInput(input, direction);
            });
        });

        syncSliderValue(minInput, minSlider, minimum);
        syncSliderValue(maxInput, maxSlider, maximum);
        updateRange();
    }
}
