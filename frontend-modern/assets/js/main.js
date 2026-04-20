(function () {
    'use strict';

    // Mobile menu toggle
    const menuBtn = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    if (menuBtn && mobileMenu) {
        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('open');
            const expanded = mobileMenu.classList.contains('open');
            menuBtn.setAttribute('aria-expanded', expanded);
        });

        mobileMenu.querySelectorAll('a').forEach(a => {
            a.addEventListener('click', () => mobileMenu.classList.remove('open'));
        });
    }

    // Simple hero slider
    const slider = document.querySelector('[data-slider]');
    if (slider) {
        const slides = slider.querySelectorAll('[data-slide]');
        const dots = slider.querySelectorAll('[data-dot]');
        let index = 0;
        let timer;

        function show(i) {
            slides.forEach((s, n) => s.style.opacity = n === i ? '1' : '0');
            dots.forEach((d, n) => d.classList.toggle('active', n === i));
            index = i;
        }

        function next() {
            show((index + 1) % slides.length);
        }

        dots.forEach((d, i) => d.addEventListener('click', () => {
            show(i);
            restart();
        }));

        function restart() {
            clearInterval(timer);
            timer = setInterval(next, 5000);
        }

        show(0);
        restart();
    }

    // Sticky header shadow on scroll
    const header = document.getElementById('site-header');
    if (header) {
        const onScroll = () => {
            header.classList.toggle('shadow-md', window.scrollY > 10);
        };
        window.addEventListener('scroll', onScroll, { passive: true });
        onScroll();
    }

    // Contact form client-side validation
    const form = document.getElementById('contact-form');
    if (form) {
        form.addEventListener('submit', (e) => {
            const errors = [];
            const nombre = form.nombre.value.trim();
            const email = form.email.value.trim();
            const mensaje = form.mensaje.value.trim();
            const emailRe = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (nombre.length < 2) errors.push('Ingresa tu nombre.');
            if (!emailRe.test(email)) errors.push('Correo electrónico no válido.');
            if (mensaje.length < 5) errors.push('Escribe un mensaje.');

            const errorBox = document.getElementById('form-errors');
            if (errors.length) {
                e.preventDefault();
                if (errorBox) {
                    errorBox.innerHTML = errors.map(x => `<li>${x}</li>`).join('');
                    errorBox.classList.remove('hidden');
                }
            }
        });
    }
})();
