import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

if (!prefersReducedMotion) {
    document.documentElement.classList.add('js');

    const revealTargets = document.querySelectorAll('[data-reveal]');
    const revealObserver = new IntersectionObserver(
        (entries, observer) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) {
                    return;
                }

                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            });
        },
        {
            threshold: 0.2,
            rootMargin: '0px 0px -6% 0px',
        },
    );

    revealTargets.forEach((el) => revealObserver.observe(el));
}
