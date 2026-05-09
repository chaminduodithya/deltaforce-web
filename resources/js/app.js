import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

/* ── Motion system: scroll-reveal ── */
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

                // Trigger counter animations inside revealed elements
                entry.target
                    .querySelectorAll('[data-count-to]')
                    .forEach(animateCounter);
            });
        },
        {
            threshold: 0.2,
            rootMargin: '0px 0px -6% 0px',
        },
    );

    revealTargets.forEach((el) => revealObserver.observe(el));

    // Also observe standalone counters not inside a [data-reveal] wrapper
    document.querySelectorAll('[data-count-to]').forEach((el) => {
        if (!el.closest('[data-reveal]')) {
            const counterObserver = new IntersectionObserver(
                (entries, obs) => {
                    entries.forEach((e) => {
                        if (e.isIntersecting) {
                            animateCounter(e.target);
                            obs.unobserve(e.target);
                        }
                    });
                },
                { threshold: 0.5 },
            );
            counterObserver.observe(el);
        }
    });
}

/* ── Animated counter ── */
function animateCounter(el) {
    if (el.dataset.counted) return;
    el.dataset.counted = '1';

    const target = parseInt(el.dataset.countTo, 10) || 0;
    const duration = 1200;
    const start = performance.now();

    function step(now) {
        const elapsed = now - start;
        const progress = Math.min(elapsed / duration, 1);
        // ease-out cubic
        const eased = 1 - Math.pow(1 - progress, 3);
        el.textContent = Math.floor(target * eased).toLocaleString();

        if (progress < 1) {
            requestAnimationFrame(step);
        } else {
            el.textContent = target.toLocaleString();
        }
    }

    requestAnimationFrame(step);
}

/* ── Toast system ── */
window.dfToast = function (message, durationMs = 2500) {
    const container = document.getElementById('df-toast-container');
    if (!container) return;

    const toast = document.createElement('div');
    toast.className = 'df-toast';
    toast.innerHTML = `
        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
        </svg>
        <span>${message}</span>
    `;

    container.appendChild(toast);

    setTimeout(() => {
        toast.classList.add('is-hiding');
        toast.addEventListener('animationend', () => toast.remove());
    }, durationMs);
};
