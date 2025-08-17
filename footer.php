    <!-- Footer -->
    <footer class="footer" id="contacts">
        <!-- Contact Form Section -->
        <div class="footer-form-section">
            <div class="container">
                <div class="footer-content">
                    <div class="footer-info">
                        <h3 class="footer-title">Готовы начать?</h3>
                        <p class="footer-description">
                            Оставьте заявку, и мы проведем бесплатный аудит вашего проекта 
                            и предложим решения для роста бизнеса.
                        </p>
                        <div class="contact-info">
                            <div class="contact-item">
                                <i data-lucide="phone" class="contact-icon"></i>
                                <span><?php echo get_theme_mod('phone_number', '+7 (999) 123-45-67'); ?></span>
                            </div>
                            <div class="contact-item">
                                <i data-lucide="mail" class="contact-icon"></i>
                                <span><?php echo get_theme_mod('email_address', 'hello@nereklamnoe.ru'); ?></span>
                            </div>
                            <div class="contact-item">
                                <i data-lucide="map-pin" class="contact-icon"></i>
                                <span><?php echo get_theme_mod('address', 'Москва, ул. Примерная, 123'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="footer-form">
                        <h4 class="form-subtitle">Бесплатная консультация</h4>
                        <?php echo do_shortcode('[contact-form-7 id="5846c68" title="Контактная форма 1"]'); ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Links Section -->
        <div class="footer-links">
            <div class="container">
                <div class="links-grid">
                    <div class="footer-column">
                        <h5 class="footer-column-title">НеРекламное агентство</h5>
                        <p class="footer-column-text">
                            Комплексный маркетинг для вашего бизнеса с упором на результат.
                        </p>
                        <div class="social-links">
                            <a href="<?php echo get_theme_mod('facebook_url', '#'); ?>" class="social-link">
                                <i data-lucide="facebook"></i>
                            </a>
                            <a href="<?php echo get_theme_mod('instagram_url', '#'); ?>" class="social-link">
                                <i data-lucide="instagram"></i>
                            </a>
                            <a href="<?php echo get_theme_mod('linkedin_url', '#'); ?>" class="social-link">
                                <i data-lucide="linkedin"></i>
                            </a>
                        </div>
                    </div>

                    <div class="footer-column">
                        <h5 class="footer-column-title">Услуги</h5>
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'services',
                            'container' => false,
                            'menu_class' => 'footer-links-list',
                            'fallback_cb' => false
                        ));
                        ?>
                    </div>

                    <div class="footer-column">
                        <h5 class="footer-column-title">Компания</h5>
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'company',
                            'container' => false,
                            'menu_class' => 'footer-links-list',
                            'fallback_cb' => false
                        ));
                        ?>
                    </div>

                    <div class="footer-column">
                        <h5 class="footer-column-title">Поддержка</h5>
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'support',
                            'container' => false,
                            'menu_class' => 'footer-links-list',
                            'fallback_cb' => false
                        ));
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Section -->
        <div class="footer-bottom">
            <div class="container">
                <div class="footer-bottom-content">
                    <p>&copy; <?php echo date('Y'); ?> НеРекламное агентство. Все права защищены.</p>
                </div>
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>