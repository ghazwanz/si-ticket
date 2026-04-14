import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

document.addEventListener('DOMContentLoaded', () => {
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
				if (!entry.isIntersecting) {
					return;
				}

				const element = entry.target;
				const delay = Number(element.dataset.revealDelay ?? 0) * revealDelayScale + revealExtraDelay;

				window.setTimeout(() => {
					element.classList.remove('translate-y-6', 'scale-[0.98]', 'opacity-0', 'blur-sm');
					element.classList.add('translate-y-0', 'scale-100', 'opacity-100', 'blur-0');
				}, delay);

				observer.unobserve(element);
			});
		}, {
			threshold: 0.18,
			rootMargin: '0px 0px -8% 0px',
		});

		animatedRevealItems.forEach((element) => {
			observer.observe(element);
		});
	} else {
		revealItems.forEach((element) => {
			element.classList.remove('translate-y-6', 'scale-[0.98]', 'opacity-0', 'blur-sm');
			element.classList.add('translate-y-0', 'scale-100', 'opacity-100', 'blur-0');
		});
	}

	if (!reduceMotion && hero) {
		const parallaxLayers = hero.querySelectorAll('[data-parallax]');

		const setParallax = (clientX, clientY) => {
			const rect = hero.getBoundingClientRect();
			const offsetX = ((clientX - rect.left) / rect.width - 0.5) * 2;
			const offsetY = ((clientY - rect.top) / rect.height - 0.5) * 2;

			parallaxLayers.forEach((layer) => {
				const depth = Number(layer.dataset.parallax ?? 0.05);
				const translateX = offsetX * depth * 24;
				const translateY = offsetY * depth * 24;

				layer.style.transform = `translate3d(${translateX}px, ${translateY}px, 0)`;
			});
		};

		const resetParallax = () => {
			parallaxLayers.forEach((layer) => {
				layer.style.transform = 'translate3d(0, 0, 0)';
			});
		};

		hero.addEventListener('mousemove', (event) => {
			const { clientX, clientY } = event;

			window.requestAnimationFrame(() => setParallax(clientX, clientY));
		});

		hero.addEventListener('mouseleave', resetParallax);
		resetParallax();
	}

	document.querySelectorAll('[data-tilt]').forEach((tiltElement) => {
		const resetTilt = () => {
			tiltElement.style.transform = 'rotateY(0deg) rotateX(0deg)';
		};

		tiltElement.style.transitionDuration = revealDuration;
		tiltElement.style.transitionTimingFunction = 'cubic-bezier(0.22, 1, 0.36, 1)';

		if (reduceMotion) {
			resetTilt();
			return;
		}

		tiltElement.addEventListener('mousemove', (event) => {
			const rect = tiltElement.getBoundingClientRect();
			const offsetX = (event.clientX - rect.left) / rect.width - 0.5;
			const offsetY = (event.clientY - rect.top) / rect.height - 0.5;
			tiltElement.style.transform = `rotateY(${offsetX * 6}deg) rotateX(${offsetY * -6}deg)`;
		});

		tiltElement.addEventListener('mouseleave', resetTilt);
		resetTilt();
	});
});

Alpine.start();
