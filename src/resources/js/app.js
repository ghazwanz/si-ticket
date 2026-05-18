import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

const initAppLogic = () => {
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const header = document.querySelector('[data-site-header]');
    const hero = document.querySelector('[data-hero]');
    const explicitRevealItems = Array.from(document.querySelectorAll('[data-reveal]'));
    const fallbackRevealItems = Array.from(document.querySelectorAll('main > *:not(script):not(style):not([data-no-reveal])'));
    const revealItems = explicitRevealItems.length > 0 ? explicitRevealItems : fallbackRevealItems;
    const revealDuration = '780ms';
    const revealStaggerStep = 45;
    const revealDelayScale = 0.5;
    const revealExtraDelay = 500;

    if (header) {
        const handleScroll = () => {
            if (window.scrollY > 12) {
                header.dataset.scrolled = 'true';
            } else {
                header.dataset.scrolled = 'false';
            }
        };
        handleScroll();
        window.addEventListener('scroll', handleScroll, { passive: true });
    }

    revealItems.forEach((element, index) => {
        element.style.transitionDuration = revealDuration;
        element.style.transitionTimingFunction = 'cubic-bezier(0.22, 1, 0.36, 1)';
        if (!element.dataset.revealDelay) {
            element.dataset.revealDelay = String(index * revealStaggerStep);
        }
    });

    const animatedRevealItems = revealItems.filter((element) => {
        return element.classList.contains('opacity-0')
            || element.classList.contains('translate-y-6')
            || element.classList.contains('scale-[0.98]')
            || element.classList.contains('blur-sm');
    });

    if (!reduceMotion && animatedRevealItems.length > 0 && 'IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                const element = entry.target;
                const delay = Number(element.dataset.revealDelay ?? 0) * revealDelayScale + revealExtraDelay;
                window.setTimeout(() => {
                    element.classList.remove('translate-y-6', 'scale-[0.98]', 'opacity-0', 'blur-sm');
                    element.classList.add('translate-y-0', 'scale-100', 'opacity-100', 'blur-0');
                }, delay);
                observer.unobserve(element);
            });
        }, { threshold: 0.18, rootMargin: '0px 0px -8% 0px' });

        animatedRevealItems.forEach((element) => observer.observe(element));
    } else {
        revealItems.forEach((element) => {
            element.classList.remove('translate-y-6', 'scale-[0.98]', 'opacity-0', 'blur-sm');
            element.classList.add('translate-y-0', 'scale-100', 'opacity-100', 'blur-0');
        });
    }

    // Parallax & Tilt Logic...
    if (!reduceMotion && hero) {
        const parallaxLayers = hero.querySelectorAll('[data-parallax]');
        const setParallax = (clientX, clientY) => {
            const rect = hero.getBoundingClientRect();
            const offsetX = ((clientX - rect.left) / rect.width - 0.5) * 2;
            const offsetY = ((clientY - rect.top) / rect.height - 0.5) * 2;
            parallaxLayers.forEach((layer) => {
                const depth = Number(layer.dataset.parallax ?? 0.05);
                layer.style.transform = `translate3d(${offsetX * depth * 24}px, ${offsetY * depth * 24}px, 0)`;
            });
        };
        hero.addEventListener('mousemove', (e) => window.requestAnimationFrame(() => setParallax(e.clientX, e.clientY)));
        hero.addEventListener('mouseleave', () => parallaxLayers.forEach(l => l.style.transform = 'translate3d(0, 0, 0)'));
    }

    document.querySelectorAll('[data-tilt]').forEach((tiltElement) => {
        tiltElement.style.transitionDuration = revealDuration;
        tiltElement.style.transitionTimingFunction = 'cubic-bezier(0.22, 1, 0.36, 1)';
        tiltElement.addEventListener('mousemove', (event) => {
            const rect = tiltElement.getBoundingClientRect();
            const offsetX = (event.clientX - rect.left) / rect.width - 0.5;
            const offsetY = (event.clientY - rect.top) / rect.height - 0.5;
            tiltElement.style.transform = `rotateY(${offsetX * 6}deg) rotateX(${offsetY * -6}deg)`;
        });
        tiltElement.addEventListener('mouseleave', () => tiltElement.style.transform = 'rotateY(0deg) rotateX(0deg)');
    });
};

// SPA Logic
const mainElement = document.querySelector('main');
const loader = document.getElementById('spa-loader');

function updateActiveLinks(newDoc) {
    const currentSidebarLinks = document.querySelectorAll('aside a[data-link]');
    const newSidebarLinks = newDoc.querySelectorAll('aside a[data-link]');
    
    // Create a map of href -> classes from the new document
    const linkMap = new Map();
    newSidebarLinks.forEach(link => {
        linkMap.set(link.getAttribute('href'), link.getAttribute('class'));
    });

    // Update existing sidebar links
    currentSidebarLinks.forEach(link => {
        const href = link.getAttribute('href');
        if (linkMap.has(href)) {
            link.setAttribute('class', linkMap.get(href));
        }
    });
}

window.loadPage = function loadPage(url, push = true) {
    if (loader) loader.classList.remove('hidden');
    if (mainElement) mainElement.classList.add('opacity-50');

    const activeElementId = document.activeElement?.id;
    const selectionStart = document.activeElement?.selectionStart;
    const selectionEnd = document.activeElement?.selectionEnd;

    fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
        .then(response => response.text())
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const newContent = doc.querySelector('main')?.innerHTML;
            const newModals = doc.querySelector('#spa-modals')?.innerHTML;
            const newHeader = doc.querySelector('#spa-header')?.innerHTML;
            const newTitle = doc.querySelector('title')?.innerText;

            if (newContent) {
                mainElement.innerHTML = newContent;
                
                const modalContainer = document.getElementById('spa-modals');
                if (modalContainer) {
                    modalContainer.innerHTML = newModals || '';
                }

                const headerContainer = document.getElementById('spa-header');
                if (headerContainer && newHeader) {
                    headerContainer.innerHTML = newHeader;
                }

                if (newTitle) document.title = newTitle;
                if (push) history.pushState(null, '', url);
                
                // Re-initialize logic
                initAppLogic();
                updateActiveLinks(doc);
                
                if (window.Alpine) {
                    window.Alpine.initTree(mainElement);
                    if (modalContainer) {
                        window.Alpine.initTree(modalContainer);
                    }
                }

                // Restore focus
                if (activeElementId) {
                    const el = document.getElementById(activeElementId);
                    if (el) {
                        el.focus();
                        if (typeof selectionStart === 'number') {
                            el.setSelectionRange(selectionStart, selectionEnd);
                        }
                    }
                }
                
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        })
        .catch(err => {
            console.error('Page load failed', err);
            window.location.href = url; // Fallback to full reload
        })
        .finally(() => {
            if (loader) loader.classList.add('hidden');
            if (mainElement) mainElement.classList.remove('opacity-50');
        });
}

document.addEventListener('DOMContentLoaded', () => {
    initAppLogic();
    Alpine.start();

    document.body.addEventListener('click', e => {
        const link = e.target.closest('a[data-link]');
        if (link && link.getAttribute('href') && !link.getAttribute('href').startsWith('#')) {
            e.preventDefault();
            loadPage(link.getAttribute('href'));
        }
    });

    window.addEventListener('popstate', () => {
        loadPage(location.pathname + location.search, false);
    });
});
