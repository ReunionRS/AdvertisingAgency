<?php
/* Template Name: Контакты */
get_header();
?>

<main class="contacts-page">
    <div class="container">
        <nav class="breadcrumbs">
            <a href="<?php echo home_url(); ?>">Главная</a> — <span>Контакты</span>
        </nav>
        
        <div class="contacts-header">
            <h1 class="contacts-title">Свяжитесь с нами</h1>
            <p class="contacts-description">
                Готовы начать проект? Оставьте заявку, и мы проведем бесплатный аудит вашего проекта 
                и предложим решения для роста бизнеса.
            </p>
        </div>

        <div class="contacts-content">
            <div class="contacts-info">
                <div class="contact-card">
                    <div class="contact-icon-large gradient-blue">
                        <i data-lucide="phone"></i>
                    </div>
                    <h3>Телефон</h3>
                    <p><?php echo get_theme_mod('phone_number', '+7 (922) 503 1853'); ?></p>
                </div>

                <div class="contact-card">
                    <div class="contact-icon-large gradient-green">
                        <i data-lucide="mail"></i>
                    </div>
                    <h3>Email</h3>
                    <p><?php echo get_theme_mod('email_address', 'aleksanrmol4@notagancy.ru'); ?></p>
                </div>

                <div class="contact-card">
                    <div class="contact-icon-large gradient-purple">
                        <i data-lucide="clock"></i>
                    </div>
                    <h3>Режим работы</h3>
                    <p>Круглосуточно</p>
                </div>
            </div>

            <div class="contacts-form">
                <div class="form-wrapper">
                    <h2 class="form-title">Бесплатная консультация</h2> 
                    <?php echo do_shortcode('[contact-form-7 id="8791bd9" title="Консультация-контакты"]'); ?>
                </div>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>