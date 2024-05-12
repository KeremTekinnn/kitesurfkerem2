window.addEventListener('scroll', function() {
    var navbar = document.getElementById('navbar');
    if (window.scrollY > 800) {
        navbar.classList.add('bg-opacity-30');
    } else {
        navbar.classList.remove('bg-opacity-30');
    }
});
