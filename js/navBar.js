export const navSlide = () => {
    const burger = document.querySelector('.burger');
    const nav = document.querySelector('.navigation-list');
    const navLinks = document.querySelectorAll('.navigation-item');

    // Toggle Navigation
    burger.addEventListener('click', () => {
        nav.classList.toggle('navigation-active');
        navLinks.forEach((link, index) => {
            if(link.style.animation){
                link.style.animation = '';
            }else{
                link.style.animation = `navLinkFade 0.5s ease forwards ${(index/7) + 0.5}s`;
            }
        })
    });
}
