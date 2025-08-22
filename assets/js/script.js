// ===== GLOBAL VARIABLES =====
let mobileMenuOpen = false;
let expandedServiceCard = null;
let currentServiceName = '';

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
    initAnimatedCounters();
    initServiceModal();
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
            if (
                e.target.tagName === 'BUTTON' || e.target.closest('button') ||
                e.target.tagName === 'A' || e.target.closest('a')
            ) {
                return; // разрешаем переход по ссылке
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

// ===== SERVICE MODAL =====
function initServiceModal() {
    // Create modal HTML
    const modalHTML = `
        <div id="service-modal" class="modal">
            <div class="modal-overlay"></div>
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Заказать услугу</h2>
                    <button class="modal-close" type="button">
                        <i data-lucide="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="service-info">
                        <h3 id="modal-service-name"></h3>
                        <p class="service-note">Заполните форму ниже, и мы свяжемся с вами для обсуждения деталей проекта</p>
                    </div>
                    <form class="service-order-form" id="service-order-form">
                        <div class="form-group">
                            <label for="client-name">Ваше имя *</label>
                            <input type="text" id="client-name" name="name" required>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="client-phone">Телефон *</label>
                                <input type="tel" id="client-phone" name="phone" required>
                            </div>
                            <div class="form-group">
                                <label for="client-email">Email</label>
                                <input type="email" id="client-email" name="email">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="company-name">Название компании</label>
                            <input type="text" id="company-name" name="company">
                        </div>
                        
                        <div class="form-group">
                            <label for="project-description">Описание проекта *</label>
                            <textarea id="project-description" name="description" rows="4" 
                                      placeholder="Расскажите подробнее о ваших задачах и целях..." required></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="budget-range">Предполагаемый бюджет</label>
                            <select id="budget-range" name="budget">
                                <option value="">Выберите диапазон</option>
                                <option value="до 50000">до 50 000 руб.</option>
                                <option value="50000-100000">50 000 - 100 000 руб.</option>
                                <option value="100000-300000">100 000 - 300 000 руб.</option>
                                <option value="300000-500000">300 000 - 500 000 руб.</option>
                                <option value="500000+">свыше 500 000 руб.</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="timeline">Желаемые сроки</label>
                            <select id="timeline" name="timeline">
                                <option value="">Выберите срок</option>
                                <option value="срочно">Срочно (в течение недели)</option>
                                <option value="1-2 недели">1-2 недели</option>
                                <option value="1 месяц">1 месяц</option>
                                <option value="2-3 месяца">2-3 месяца</option>
                                <option value="больше 3 месяцев">Больше 3 месяцев</option>
                            </select>
                        </div>
                        
                        <div class="form-group checkbox-group">
                            <label class="checkbox-label">
                                <input type="checkbox" name="consent" required>
                                <span class="checkmark"></span>
                                Согласен на <a href="/privacy-policy" target="_blank">обработку персональных данных</a> *
                            </label>
                        </div>
                        
                        <input type="hidden" name="service" id="service-field">
                        <input type="hidden" name="form_type" value="service_order">
                        
                        <button type="submit" class="btn btn-primary btn-lg btn-full">
                            Отправить заявку
                        </button>
                    </form>
                </div>
            </div>
        </div>
    `;
    
    // Add modal to body
    document.body.insertAdjacentHTML('beforeend', modalHTML);
    
    // Add modal styles
    const modalStyles = `
        <style id="modal-styles">
            .modal {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: 9999;
                display: none;
                align-items: center;
                justify-content: center;
                padding: 20px;
            }
            
            .modal.active {
                display: flex;
            }
            
            .modal-overlay {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                backdrop-filter: blur(4px);
            }
            
            .modal-content {
                position: relative;
                background: white;
                border-radius: 12px;
                width: 100%;
                max-width: 600px;
                max-height: 90vh;
                overflow-y: auto;
                box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
                animation: modalSlideIn 0.3s ease-out;
            }
            
            @keyframes modalSlideIn {
                from {
                    opacity: 0;
                    transform: translateY(-20px) scale(0.95);
                }
                to {
                    opacity: 1;
                    transform: translateY(0) scale(1);
                }
            }
            
            .modal-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 24px 24px 0;
                border-bottom: 1px solid #e5e7eb;
                margin-bottom: 24px;
            }
            
            .modal-title {
                font-size: 24px;
                font-weight: 600;
                color: var(--color-text-primary);
                margin: 0;
            }
            
            .modal-close {
                background: none;
                border: none;
                width: 32px;
                height: 32px;
                border-radius: 6px;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                color: var(--color-text-secondary);
                transition: all 0.2s ease;
            }
            
            .modal-close:hover {
                background: #f3f4f6;
                color: var(--color-text-primary);
            }
            
            .modal-body {
                padding: 0 24px 24px;
            }
            
            .service-info {
                margin-bottom: 32px;
            }
            
            .service-info h3 {
                font-size: 20px;
                font-weight: 600;
                color: var(--color-primary);
                margin: 0 0 8px;
            }
            
            .service-note {
                color: var(--color-text-secondary);
                margin: 0;
            }
            
            .service-order-form .form-group {
                margin-bottom: 20px;
            }
            
            .service-order-form .form-row {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 16px;
            }
            
            .service-order-form label {
                display: block;
                font-weight: 500;
                color: var(--color-text-primary);
                margin-bottom: 6px;
            }
            
            .service-order-form input,
            .service-order-form select,
            .service-order-form textarea {
                width: 100%;
                padding: 12px 16px;
                border: 2px solid #e5e7eb;
                border-radius: 8px;
                font-size: 16px;
                transition: border-color 0.2s ease;
                font-family: inherit;
            }
            
            .service-order-form input:focus,
            .service-order-form select:focus,
            .service-order-form textarea:focus {
                outline: none;
                border-color: var(--color-primary);
                box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            }
            
            .service-order-form textarea {
                resize: vertical;
                min-height: 100px;
            }
            
            .checkbox-group {
                margin-top: 24px;
            }
            
            .checkbox-label {
                display: flex;
                align-items: flex-start;
                gap: 12px;
                cursor: pointer;
                font-size: 14px;
                line-height: 1.5;
            }
            
            .checkbox-label input[type="checkbox"] {
                display: none;
            }
            
            .checkmark {
                flex-shrink: 0;
                width: 20px;
                height: 20px;
                border: 2px solid #d1d5db;
                border-radius: 4px;
                position: relative;
                transition: all 0.2s ease;
            }
            
            .checkbox-label input[type="checkbox"]:checked + .checkmark {
                background: var(--color-primary);
                border-color: var(--color-primary);
            }
            
            .checkbox-label input[type="checkbox"]:checked + .checkmark::after {
                content: '';
                position: absolute;
                left: 6px;
                top: 2px;
                width: 6px;
                height: 10px;
                border: solid white;
                border-width: 0 2px 2px 0;
                transform: rotate(45deg);
            }
            
            .checkbox-label a {
                color: var(--color-primary);
                text-decoration: none;
            }
            
            .checkbox-label a:hover {
                text-decoration: underline;
            }
            
            @media (max-width: 768px) {
                .modal-content {
                    margin: 20px;
                    max-height: calc(100vh - 40px);
                }
                
                .service-order-form .form-row {
                    grid-template-columns: 1fr;
                    gap: 20px;
                }
                
                .modal-header {
                    padding: 20px 20px 0;
                }
                
                .modal-body {
                    padding: 0 20px 20px;
                }
            }
        </style>
    `;
    
    document.head.insertAdjacentHTML('beforeend', modalStyles);
    
    // Initialize modal event listeners
    const modal = document.getElementById('service-modal');
    const modalClose = modal.querySelector('.modal-close');
    const modalOverlay = modal.querySelector('.modal-overlay');
    const orderForm = document.getElementById('service-order-form');
    
    // Close modal events
    modalClose.addEventListener('click', closeServiceModal);
    modalOverlay.addEventListener('click', closeServiceModal);
    
    // Close on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal.classList.contains('active')) {
            closeServiceModal();
        }
    });
    
    // Handle form submission
    orderForm.addEventListener('submit', handleServiceOrderSubmit);
    
    // Initialize service order buttons
    initServiceOrderButtons();
    
    // Re-initialize Lucide icons in modal
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
}

function initServiceOrderButtons() {
    // Use event delegation for dynamically generated buttons
    document.addEventListener('click', function(e) {
        if (e.target.matches('.service-details button') || e.target.closest('.service-details button')) {
            const button = e.target.matches('button') ? e.target : e.target.closest('button');
            if (button.textContent.includes('Заказать услугу')) {
                e.preventDefault();
                const serviceCard = button.closest('.service-card');
                const serviceName = serviceCard.querySelector('.service-title').textContent;
                openServiceModal(serviceName);
            }
        }
    });
}

function openServiceModal(serviceName) {
    const modal = document.getElementById('service-modal');
    const serviceNameElement = document.getElementById('modal-service-name');
    const serviceField = document.getElementById('service-field');
    
    serviceNameElement.textContent = serviceName;
    serviceField.value = serviceName;
    currentServiceName = serviceName;
    
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
    
    // Focus first input
    setTimeout(() => {
        const firstInput = modal.querySelector('input[type="text"]');
        if (firstInput) firstInput.focus();
    }, 300);
}

function closeServiceModal() {
    const modal = document.getElementById('service-modal');
    const form = document.getElementById('service-order-form');
    
    modal.classList.remove('active');
    document.body.style.overflow = '';
    
    // Reset form after animation
    setTimeout(() => {
        form.reset();
    }, 300);
}

function handleServiceOrderSubmit(e) {
    e.preventDefault();
    
    const form = e.target;
    const formData = new FormData(form);
    const data = Object.fromEntries(formData);
    
    // Validate required fields
    if (!data.name || !data.phone || !data.description || !data.consent) {
        showNotification('Заполните все обязательные поля и дайте согласие на обработку данных', 'error');
        return;
    }
    
    // Show loading state
    const submitButton = form.querySelector('button[type="submit"]');
    const originalText = submitButton.textContent;
    submitButton.textContent = 'Отправка...';
    submitButton.disabled = true;
    
    // Prepare form data for WordPress AJAX
    const ajaxData = new URLSearchParams({
        action: 'handle_service_order',
        ...data
    });
    
    // Send to WordPress AJAX handler
    fetch('/wp-admin/admin-ajax.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: ajaxData
    })
    .then(response => response.json())
    .then(result => {
        // Reset button
        submitButton.textContent = originalText;
        submitButton.disabled = false;
        
        if (result.success) {
            // Show success message
            showNotification(`Заявка на услугу "${data.service}" отправлена! Мы свяжемся с вами в ближайшее время`, 'success');
            
            // Close modal
            closeServiceModal();
        } else {
            // Show error message
            showNotification(result.data || 'Произошла ошибка при отправке заявки', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        
        // Reset button
        submitButton.textContent = originalText;
        submitButton.disabled = false;
        
        // Show error message
        showNotification('Произошла ошибка при отправке заявки. Попробуйте позже или свяжитесь с нами по телефону.', 'error');
    });
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
    
    // Prepare form data for WordPress AJAX
    const ajaxData = new URLSearchParams({
        action: 'handle_consultation_form',
        ...data
    });
    
    // Send to WordPress AJAX handler
    fetch('/wp-admin/admin-ajax.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: ajaxData
    })
    .then(response => response.json())
    .then(result => {
        // Reset button
        submitButton.textContent = originalText;
        submitButton.disabled = false;
        
        if (result.success) {
            // Show success message
            showNotification('Заявка отправлена! Мы свяжемся с вами в ближайшее время', 'success');
            
            // Reset form
            form.reset();
        } else {
            // Show error message
            showNotification(result.data || 'Произошла ошибка при отправке заявки', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        
        // Reset button
        submitButton.textContent = originalText;
        submitButton.disabled = false;
        
        // Show error message
        showNotification('Произошла ошибка при отправке заявки. Попробуйте позже.', 'error');
    });
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
                z-index: 10000;
                padding: 16px 24px;
                border-radius: 8px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                font-family: var(--font-body);
                font-size: 14px;
                animation: slideInRight 0.3s ease-out;
                max-width: 400px;
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
                align-items: flex-start;
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
                flex-shrink: 0;
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
    
    if (!slides.length || !prevBtn || !nextBtn || !dotsContainer) return;
    
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

    const heroSliderElement = document.querySelector('.hero-slider');
    if (heroSliderElement) {
        heroSliderElement.addEventListener('mouseenter', stopAutoSlide);
        heroSliderElement.addEventListener('mouseleave', startAutoSlide);
    }

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
document.addEventListener('DOMContentLoaded', function() {
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
});

// ===== ANIMATED COUNTERS =====
function initAnimatedCounters() {
    const counters = document.querySelectorAll('.highlight-number');
    let animationTriggered = false;
    
    function animateCounter(element) {
        const target = parseInt(element.textContent.replace(/\D/g, ''));
        const hasPlus = element.textContent.includes('+');
        const duration = 2000; // 2 seconds
        const steps = 60;
        const increment = target / steps;
        let current = 0;
        
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            
            // Format the number and add + if needed
            const displayValue = Math.floor(current) + (hasPlus ? '+' : '');
            element.textContent = displayValue;
            
            // Add scale animation on completion
            if (current === target) {
                element.style.transform = 'scale(1.1)';
                setTimeout(() => {
                    element.style.transform = 'scale(1)';
                }, 200);
            }
        }, duration / steps);
    }
    
    // Create intersection observer for counters
    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !animationTriggered) {
                animationTriggered = true;
                
                // Start all counters with small delays
                counters.forEach((counter, index) => {
                    setTimeout(() => {
                        animateCounter(counter);
                        
                        // Add highlight animation to the parent
                        const parent = counter.closest('.highlight-item');
                        if (parent) {
                            parent.style.transform = 'translateY(-4px)';
                            parent.style.boxShadow = 'var(--shadow-elegant)';
                            
                            setTimeout(() => {
                                parent.style.transform = '';
                                parent.style.boxShadow = '';
                            }, 300);
                        }
                    }, index * 200); // Stagger the animations
                });
            }
        });
    }, {
        threshold: 0.5,
        rootMargin: '0px 0px -100px 0px'
    });
    
    // Observe the about highlights section
    const aboutHighlights = document.querySelector('.about-highlights');
    if (aboutHighlights) {
        counterObserver.observe(aboutHighlights);
    }
}