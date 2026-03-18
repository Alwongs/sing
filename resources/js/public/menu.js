document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.querySelector('.mobile-menu-toggle');
    const mobileMenu = document.querySelector('#mobileMenu');

    if (!toggleBtn || !mobileMenu) return;

    toggleBtn.addEventListener('click', function(e) {
        e.preventDefault();
        toggleBtn.classList.toggle('is-open');
        mobileMenu.classList.toggle('hidden');
    });

    mobileMenu.addEventListener('click', function(e) {
        const link = e.target.closest('.mobile-menu-nav__link');
        if (!link) return;
        toggleBtn.classList.remove('is-open');
        mobileMenu.classList.add('hidden');
    });
});
