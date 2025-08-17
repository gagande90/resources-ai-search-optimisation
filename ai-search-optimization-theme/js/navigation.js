/**
 * Navigation functionality for AI Search Optimization theme
 */

(function() {
    'use strict';

    // Mobile menu toggle functionality
    document.addEventListener('DOMContentLoaded', function() {
        
        // Smooth scrolling for anchor links
        const anchorLinks = document.querySelectorAll('a[href^="#"]');
        anchorLinks.forEach(function(link) {
            link.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href === '#') return;
                
                const target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add active class to current menu item
        const currentLocation = location.pathname;
        const menuItems = document.querySelectorAll('.main-navigation a');
        
        menuItems.forEach(function(item) {
            const href = item.getAttribute('href');
            if (href && currentLocation.includes(href.replace(location.origin, ''))) {
                item.classList.add('current');
            }
        });

        // Back to top functionality
        const backToTop = document.createElement('button');
        backToTop.innerHTML = '↑';
        backToTop.className = 'back-to-top';
        backToTop.style.cssText = `
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #6366f1;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 1.5rem;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 1000;
        `;

        document.body.appendChild(backToTop);

        // Show/hide back to top button
        window.addEventListener('scroll', function() {
            if (window.scrollY > 500) {
                backToTop.style.opacity = '1';
                backToTop.style.visibility = 'visible';
            } else {
                backToTop.style.opacity = '0';
                backToTop.style.visibility = 'hidden';
            }
        });

        // Back to top click handler
        backToTop.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    });

})(); 