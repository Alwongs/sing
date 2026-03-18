document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.querySelector('.mobile-menu-toggle');
    const aside = document.querySelector('.aside');

    if (!toggleBtn || !aside) return;

    toggleBtn.addEventListener('click', function(e) {
        e.preventDefault();
        toggleBtn.classList.toggle('is-open');
        aside.classList.toggle('open');
    });

    aside.addEventListener('click', function(e) {
        const link = e.target.closest('.aside-nav-link');
        if (!link) return;
        toggleBtn.classList.remove('is-open');
        aside.classList.remove('open');
    });
});
