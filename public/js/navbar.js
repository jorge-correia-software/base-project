/**
 * BASE - Navbar Functionality (React Clone)
 */

document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.getElementById('mainNav');
    const logo = document.getElementById('navbar-logo');
    const navLinks = document.querySelectorAll('.nav-link');
    const mobileNavLinks = document.querySelectorAll('.mobile-nav-link');
    const sections = document.querySelectorAll('section[id]');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenuClose = document.querySelectorAll('.mobile-menu-close');
    const mobileMenuOverlay = document.querySelector('.mobile-menu-overlay');
    const allScrollLinks = document.querySelectorAll('[data-scroll-to]');

    // Detect if we're on homepage
    const isHomepage = navbar ? navbar.classList.contains('navbar-other-page') === false : true;

    // Track scroll state
    let isScrolled = false;

    // Navbar scroll effect - triggers at 0px (ANY scroll)
    function handleNavbarScroll() {
        const scrolled = window.scrollY > 0;

        if (scrolled !== isScrolled) {
            isScrolled = scrolled;

            if (isScrolled) {
                navbar.classList.add('scrolled');
                // Switch to dark logo when scrolled
                if (logo) {
                    logo.src = '/img/logo.png';
                }
            } else {
                navbar.classList.remove('scrolled');
                // Switch to pink logo when not scrolled
                if (logo) {
                    logo.src = '/img/logo_pink.png';
                }
            }
        }
    }

    // Active section highlighting (only on homepage)
    function highlightActiveSection() {
        // Skip if not on homepage
        if (!isHomepage) return;

        const scrollPosition = window.scrollY + (navbar ? navbar.offsetHeight : 0) + 100;
        let activeFound = false;

        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;
            const sectionId = section.getAttribute('id');

            if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                activeFound = true;
                navLinks.forEach(link => {
                    link.classList.remove('active');
                    const href = link.getAttribute('href');
                    const scrollTo = link.getAttribute('data-scroll-to');

                    // Match section with link
                    if ((href === `#${sectionId}`) ||
                        (scrollTo === sectionId) ||
                        (sectionId === 'home' && (href === '#' || scrollTo === 'hero'))) {
                        link.classList.add('active');
                    }
                });

                mobileNavLinks.forEach(link => {
                    link.classList.remove('active', 'text-brand-pink', 'bg-gray-50');
                    const href = link.getAttribute('href');
                    const scrollTo = link.getAttribute('data-scroll-to');

                    if ((href === `#${sectionId}`) ||
                        (scrollTo === sectionId) ||
                        (sectionId === 'home' && (href === '#' || scrollTo === 'hero'))) {
                        link.classList.add('active', 'text-brand-pink', 'bg-gray-50');
                    }
                });
            }
        });

        // If no section active (top of page), activate home link
        if (!activeFound && window.scrollY < 100) {
            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === '#' || link.getAttribute('data-scroll-to') === 'hero') {
                    link.classList.add('active');
                }
            });

            mobileNavLinks.forEach(link => {
                link.classList.remove('active', 'text-brand-pink', 'bg-gray-50');
                if (link.getAttribute('href') === '#' || link.getAttribute('data-scroll-to') === 'hero') {
                    link.classList.add('active', 'text-brand-pink', 'bg-gray-50');
                }
            });
        }
    }

    // Smooth scroll function
    function smoothScrollTo(targetId) {
        let target;

        if (targetId === 'hero' || targetId === '' || targetId === '#') {
            // Scroll to top for hero/home
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
            return;
        }

        target = document.getElementById(targetId);

        if (target) {
            const navbarHeight = navbar ? navbar.offsetHeight : 0;
            const targetPosition = target.offsetTop - navbarHeight;

            window.scrollTo({
                top: targetPosition,
                behavior: 'smooth'
            });
        }
    }

    // Mobile menu functions
    function openMobileMenu() {
        if (mobileMenu) {
            mobileMenu.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeMobileMenu() {
        if (mobileMenu) {
            mobileMenu.classList.add('hidden');
            document.body.style.overflow = '';
        }
    }

    // Listen to scroll events
    window.addEventListener('scroll', function() {
        handleNavbarScroll();
        highlightActiveSection();
    });

    // Initial checks
    handleNavbarScroll();
    highlightActiveSection();

    // Mobile menu button click
    if (mobileMenuButton) {
        mobileMenuButton.addEventListener('click', openMobileMenu);
    }

    // Mobile menu close button clicks
    mobileMenuClose.forEach(button => {
        button.addEventListener('click', closeMobileMenu);
    });

    // Mobile menu overlay click
    if (mobileMenuOverlay) {
        mobileMenuOverlay.addEventListener('click', closeMobileMenu);
    }

    // Handle all scroll-to links (desktop and mobile) - only on homepage
    if (isHomepage) {
        allScrollLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('data-scroll-to');
                smoothScrollTo(targetId);
                closeMobileMenu();
            });
        });
    } else {
        // On other pages, just close mobile menu when links are clicked
        allScrollLinks.forEach(link => {
            link.addEventListener('click', function() {
                closeMobileMenu();
            });
        });
    }
});
