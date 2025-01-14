document.addEventListener('DOMContentLoaded', function(){

    // BURGER MENU
    const mobileMenuButton = document.querySelector('.mobile-menu-button');
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenuButton.addEventListener('click', function() {
        mobileMenu.classList.toggle('hidden');
        if (!mobileMenu.classList.contains('hidden')) {
            mobileMenu.style.opacity = '0';
            setTimeout(() => {
                mobileMenu.style.opacity = '1';
            }, 100);
        }
    });

});