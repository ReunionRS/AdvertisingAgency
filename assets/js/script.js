        // ===== GLOBAL VARIABLES =====
        let mobileMenuOpen = false;
        let expandedServiceCard = null;

        // ===== INITIALIZATION =====
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Lucide icons
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
            
            // Initialize components
            initMobileMenu();
            initServiceCards();
            initForms();
            initSmoothScroll();
            initScrollEffects();
            initDropdowns();
            initHeroSlider();
            initCTAButtons();
        });

        // ===== MOBILE MENU =====
        function initMobileMenu() {
            const mobileToggle = document.getElementById('mobile-menu-toggle');
            const mobileNav = document.getElementById('mobile-nav');
            
            if (mobileToggle && mobileNav) {
                mobileToggle.addEventListener('click', toggleMobileMenu);
                
                // Close mobile menu when clicking on links
                const mobileLinks = mobileNav.querySelectorAll('a, button');
                mobileLinks.forEach(link => {
                    link.addEventListener('click', closeMobileMenu);
                });
                
                // Close mobile menu when clicking outside
                document.addEventListener('click', function(e) {
                    if (mobileMenuOpen && !mobileToggle.contains(e.target) && !mobileNav.contains(e.target)) {
                        closeMobileMenu();
                    }
                });
            }
        }

        function toggleMobileMenu() {
            const mobileToggle = document.getElementById('mobile-menu-toggle');
            const mobileNav = document.getElementById('mobile-nav');
            
            mobileMenuOpen = !mobileMenuOpen;
            
            mobileToggle.classList.toggle('active', mobileMenuOpen);
            mobileNav.classList.toggle('active', mobileMenuOpen);
            
            // Prevent body scroll when menu is open
            document.body.style.overflow = mobileMenuOpen ? 'hidden' : '';
        }

        function closeMobileMenu() {
            const mobileToggle = document.getElementById('mobile-menu-toggle');
            const mobileNav = document.getElementById('mobile-nav');
            
            mobileMenuOpen = false;
            mobileToggle.classList.remove('active');
            mobileNav.classList.remove('active');
            document.body.style.overflow = '';
        }

        // ===== SERVICE CARDS =====
        function initServiceCards() {
            const serviceCards = document.querySelectorAll('.service-card');
            
            serviceCards.forEach(card => {
                card.addEventListener('click', function(e) {
                    // Don't toggle if clicking on buttons inside the card
                    if (e.target.tagName === 'BUTTON' || e.target.closest('button')) {
                        return;
                    }
                    
                    toggleServiceCard(card);
                });
            });
        }

        function toggleServiceCard(card) {
            const serviceId = card.dataset.service;
            
            if (expandedServiceCard === serviceId) {
                // Close currently expanded card
                card.classList.remove('expanded');
                expandedServiceCard = null;
            } else {
                // Close any previously expanded card
                if (expandedServiceCard) {
                    const prevCard = document.querySelector(`[data-service="${expandedServiceCard}"]`);
                    if (prevCard) {
                        prevCard.classList.remove('expanded');
                    }
                }
                
                // Open clicked card
                card.classList.add('expanded');
                expandedServiceCard = serviceId;
            }
            
            // Re-initialize Lucide icons for any newly visible elements
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        }

        // ===== FORMS =====
        function initForms() {
            const forms = document.querySelectorAll('.consultation-form');
            
            forms.forEach(form => {
                form.addEventListener('submit', handleFormSubmit);
            });
        }

        function handleFormSubmit(e) {
            e.preventDefault();
            
            const form = e.target;
            const formData = new FormData(form);
            const data = Object.fromEntries(formData);
            
            // Check if consent is given
            if (!data.consent) {
                showNotification('Необходимо согласие на обработку данных', 'error');
                return;
            }
            
            // Validate required fields
            if (!data.name || !data.contact) {
                showNotification('Заполните все обязательные поля', 'error');
                return;
            }
            
            // Show loading state
            const submitButton = form.querySelector('button[type="submit"]');
            const originalText = submitButton.textContent;
            submitButton.textContent = 'Отправка...';
            submitButton.disabled = true;
            
            // Simulate API call
            setTimeout(() => {
                // Reset button
                submitButton.textContent = originalText;
                submitButton.disabled = false;
                
                // Show success message
                showNotification('Заявка отправлена! Мы свяжемся с вами в ближайшее время', 'success');
                
                // Reset form
                form.reset();
                
                // Here you would normally send the data to your backend
                console.log('Form data:', data);
            }, 1500);
        }

        // ===== NOTIFICATIONS =====
        function showNotification(message, type = 'success') {
            // Remove any existing notifications
            const existingNotification = document.querySelector('.notification');
            if (existingNotification) {
                existingNotification.remove();
            }
            
            // Create notification element
            const notification = document.createElement('div');
            notification.className = `notification notification-${type}`;
            notification.innerHTML = `
                <div class="notification-content">
                    <span>${message}</span>
                    <button class="notification-close" onclick="this.parentElement.parentElement.remove()">
                        ×
                    </button>
                </div>
            `;
            
            // Add styles if not already present
            if (!document.querySelector('#notification-styles')) {
                const styles = document.createElement('style');
                styles.id = 'notification-styles';
                styles.textContent = `
                    .notification {
                        position: fixed;
                        top: 20px;
                        right: 20px;
                        z-index: 1000;
                        padding: 16px 24px;
                        border-radius: 8px;
                        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                        font-family: var(--font-body);
                        font-size: 14px;
                        animation: slideInRight 0.3s ease-out;
                    }
                    
                    .notification-success {
                        background: #10b981;
                        color: white;
                    }
                    
                    .notification-error {
                        background: #ef4444;
                        color: white;
                    }
                    
                    .notification-content {
                        display: flex;
                        align-items: center;
                        justify-content: space-between;
                        gap: 12px;
                    }
                    
                    .notification-close {
                        background: none;
                        border: none;
                        color: inherit;
                        font-size: 20px;
                        cursor: pointer;
                        padding: 0;
                        line-height: 1;
                    }
                    
                    @keyframes slideInRight {
                        from {
                            transform: translateX(100%);
                            opacity: 0;
                        }
                        to {
                            transform: translateX(0);
                            opacity: 1;
                        }
                    }
                `;
                document.head.appendChild(styles);
            }
            
            document.body.appendChild(notification);
            
            // Auto-remove after 5 seconds
            setTimeout(() => {
                if (notification.parentElement) {
                    notification.remove();
                }
            }, 5000);
        }

        // ===== SMOOTH SCROLL =====
        function initSmoothScroll() {
            const links = document.querySelectorAll('a[href^="#"]');
            
            links.forEach(link => {
                link.addEventListener('click', function(e) {
                    const href = this.getAttribute('href');
                    
                    // Skip if it's just "#" or empty
                    if (href === '#' || href === '') {
                        return;
                    }
                    
                    const target = document.querySelector(href);
                    if (target) {
                        e.preventDefault();
                        scrollToSection(href.substring(1));
                    }
                });
            });
        }

        function scrollToSection(sectionId) {
            const target = document.getElementById(sectionId);
            if (target) {
                const headerOffset = 80; // Height of fixed header
                const elementPosition = target.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                
                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
                
                // Close mobile menu if open
                closeMobileMenu();
            }
        }

        // ===== SCROLL EFFECTS =====
        function initScrollEffects() {
            // Navbar background on scroll
            const navbar = document.getElementById('navbar');
            
            function updateNavbar() {
                if (window.scrollY > 50) {
                    navbar.style.background = 'rgba(255, 255, 255, 0.95)';
                    navbar.style.backdropFilter = 'blur(12px)';
                } else {
                    navbar.style.background = 'rgba(255, 255, 255, 0.95)';
                    navbar.style.backdropFilter = 'blur(8px)';
                }
            }
            
            window.addEventListener('scroll', updateNavbar);
            updateNavbar(); // Initial call
            
            // Intersection Observer for animations
            if ('IntersectionObserver' in window) {
                const observerOptions = {
                    threshold: 0.1,
                    rootMargin: '0px 0px -50px 0px'
                };
                
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('fade-in-up');
                        }
                    });
                }, observerOptions);
                
                // Observe elements for animation
                const animatedElements = document.querySelectorAll('.service-card, .case-card, .section-header');
                animatedElements.forEach(el => observer.observe(el));
            }
        }

        // ===== DROPDOWNS =====
        function initDropdowns() {
            const dropdowns = document.querySelectorAll('.dropdown');
            
            dropdowns.forEach(dropdown => {
                const toggle = dropdown.querySelector('.dropdown-toggle');
                const menu = dropdown.querySelector('.dropdown-menu');
                
                if (!toggle || !menu) return;
                
                // Handle hover events
                dropdown.addEventListener('mouseenter', () => {
                    menu.style.display = 'grid';
                });
                
                dropdown.addEventListener('mouseleave', () => {
                    menu.style.display = 'none';
                });
                
                // Handle touch devices
                toggle.addEventListener('click', (e) => {
                    e.preventDefault();
                    const isVisible = menu.style.display === 'grid';
                    
                    // Close all other dropdowns
                    document.querySelectorAll('.dropdown-menu').forEach(otherMenu => {
                        if (otherMenu !== menu) {
                            otherMenu.style.display = 'none';
                        }
                    });
                    
                    // Toggle current dropdown
                    menu.style.display = isVisible ? 'none' : 'grid';
                });
                
                // Close on outside click
                document.addEventListener('click', (e) => {
                    if (!dropdown.contains(e.target)) {
                        menu.style.display = 'none';
                    }
                });
            });
        }

        // ===== HERO SLIDER =====
        function initHeroSlider() {
            const slides = document.querySelectorAll('.hero-slide');
            const prevBtn = document.querySelector('.prev-slide');
            const nextBtn = document.querySelector('.next-slide');
            const dotsContainer = document.querySelector('.hero-slider-dots');
            let currentIndex = 0;
            let autoSlide;

            // Create dots
            slides.forEach((_, i) => {
                const dot = document.createElement('button');
                if (i === 0) dot.classList.add('active');
                dot.addEventListener('click', () => goToSlide(i));
                dotsContainer.appendChild(dot);
            });
            const dots = dotsContainer.querySelectorAll('button');

            function goToSlide(index) {
                slides[currentIndex].classList.remove('active');
                dots[currentIndex].classList.remove('active');
                currentIndex = (index + slides.length) % slides.length;
                slides[currentIndex].classList.add('active');
                dots[currentIndex].classList.add('active');
            }

            function nextSlide() {
                goToSlide(currentIndex + 1);
            }

            function prevSlide() {
                goToSlide(currentIndex - 1);
            }

            prevBtn.addEventListener('click', prevSlide);
            nextBtn.addEventListener('click', nextSlide);

            // Auto play
            function startAutoSlide() {
                autoSlide = setInterval(nextSlide, 5000);
            }

            function stopAutoSlide() {
                clearInterval(autoSlide);
            }

            document.querySelector('.hero-slider').addEventListener('mouseenter', stopAutoSlide);
            document.querySelector('.hero-slider').addEventListener('mouseleave', startAutoSlide);

            startAutoSlide();
        }

        // ===== CTA BUTTONS =====
        function initCTAButtons() {
            const ctaButtons = document.querySelectorAll('.nav-cta, .mobile-nav-cta');
            
            ctaButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    scrollToSection('contacts');
                });
            });
        }

        // ===== UTILITY FUNCTIONS =====
        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        function throttle(func, delay) {
            let timeoutId;
            let lastExecTime = 0;
            return function(...args) {
                const currentTime = Date.now();
                
                if (currentTime - lastExecTime > delay) {
                    func.apply(this, args);
                    lastExecTime = currentTime;
                } else {
                    clearTimeout(timeoutId);
                    timeoutId = setTimeout(() => {
                        func.apply(this, args);
                        lastExecTime = Date.now();
                    }, delay - (currentTime - lastExecTime));
                }
            };
        }

        // Performance optimizations
        const debouncedScrollHandler = debounce(function() {
            // Any expensive scroll operations can go here
        }, 100);

        window.addEventListener('scroll', debouncedScrollHandler);

        // ===== ACCESSIBILITY ENHANCEMENTS =====
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Tab') {
                document.body.classList.add('keyboard-navigation');
            }
        });
        
        document.addEventListener('mousedown', function() {
            document.body.classList.remove('keyboard-navigation');
        });
        
        // Add keyboard support for service cards
        const serviceCards = document.querySelectorAll('.service-card');
        serviceCards.forEach(card => {
            card.setAttribute('tabindex', '0');
            card.setAttribute('role', 'button');
            card.setAttribute('aria-expanded', 'false');
            
            card.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    toggleServiceCard(card);
                    
                    // Update aria-expanded
                    const isExpanded = card.classList.contains('expanded');
                    card.setAttribute('aria-expanded', isExpanded.toString());
                }
            });
        });