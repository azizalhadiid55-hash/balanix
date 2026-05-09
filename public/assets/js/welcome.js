// Navbar scroll effect
window.addEventListener('scroll', function () {
    const navbar = document.querySelector('.navbar');
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});

// Navbar toggle effect
document.addEventListener('DOMContentLoaded', function () {
    const navbar = document.querySelector('.navbar');
    const toggler = document.querySelector('.navbar-toggler');
    const collapse = document.querySelector('.navbar-collapse');

    toggler.addEventListener('click', function () {
        if (collapse.classList.contains('show')) {
            navbar.classList.remove('show');
        } else {
            navbar.classList.add('show');
        }
    });
});

// Back to top functionality
function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

// Show/hide back to top button
window.addEventListener('scroll', function () {
    const backToTop = document.querySelector('.back-to-top');
    if (window.pageYOffset > 300) {
        backToTop.classList.add('show');
    } else {
        backToTop.classList.remove('show');
    }
});

// Add active class to navbar links on scroll
window.addEventListener('scroll', function () {
    let current = '';
    const sections = document.querySelectorAll('section[id]');

    sections.forEach(section => {
        const sectionTop = section.offsetTop;
        const sectionHeight = section.clientHeight;
        if (pageYOffset >= (sectionTop - 200)) {
            current = section.getAttribute('id');
        }
    });

    document.querySelectorAll('.nav-link').forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href') === `#${current}`) {
            link.classList.add('active');
        }
    });
});


// FAQ JavaScript functionality
document.addEventListener('DOMContentLoaded', function() {
    // Handle FAQ accordion clicks
    const faqQuestions = document.querySelectorAll('.faq-question');
    
    faqQuestions.forEach(question => {
        question.addEventListener('click', function() {
            const faqItem = this.closest('.faq-item');
            const isActive = faqItem.classList.contains('active');
            
            // Remove active class from all items
            document.querySelectorAll('.faq-item').forEach(item => {
                item.classList.remove('active');
            });
            
            // Add active class to current item if it wasn't active
            if (!isActive) {
                faqItem.classList.add('active');
            }
        });
    });
    
    // Handle bootstrap collapse events
    const collapseElements = document.querySelectorAll('.faq-answer');
    
    collapseElements.forEach(collapse => {
        collapse.addEventListener('shown.bs.collapse', function() {
            const faqItem = this.closest('.faq-item');
            faqItem.classList.add('active');
        });
        
        collapse.addEventListener('hidden.bs.collapse', function() {
            const faqItem = this.closest('.faq-item');
            faqItem.classList.remove('active');
        });
    });
});