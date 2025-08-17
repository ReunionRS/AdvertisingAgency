<?php get_header(); ?>

<!-- Hero Section with Slider -->
<section class="hero-slider" id="home">
    <div class="hero-slider-wrapper">
        <!-- Slide 1 -->
        <div class="hero-slide active">
            <div class="container">
                <div class="hero-slide-content">
                    <div class="hero-text">
                        <h1>Мы не рекламируем.<br><span class="text-accent">Мы заставляем</span><br> говорить о вас.</h1>
                        <p>Комплексный маркетинг для вашего бизнеса с упором на результат — <span class="text-accent font-semibold">деньги в кассе</span></p>
                        <div class="hero-buttons">
                            <button class="btn btn-secondary btn-lg" onclick="scrollToSection('services')">Посмотреть услуги</button>
                            <button class="btn btn-hero btn-lg" onclick="scrollToSection('cases')">Наши кейсы</button>
                        </div>
                    </div>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/png/1.png">
                </div>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="hero-slide">
            <div class="container">
                <div class="hero-slide-content">
                    <div class="hero-text">
                        <h1>Запускаем <span class="text-accent">эффективные кампании</span></h1>
                        <p>Таргет, SEO, сайты, SMM — всё для роста продаж.</p>
                        <div class="hero-buttons">
                            <button class="btn btn-secondary btn-lg" onclick="scrollToSection('services')">Наши услуги</button>
                        </div>
                    </div>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/png/2.png">
                </div>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="hero-slide">
            <div class="container">
                <div class="hero-slide-content">
                    <div class="hero-text">
                        <h1><span class="text-accent">Digital-агентство</span>, которому доверяют</h1>
                        <p>Реальные кейсы и рост бизнеса клиентов.</p>
                        <div class="hero-buttons">
                            <button class="btn btn-hero btn-lg" onclick="scrollToSection('cases')">Смотреть кейсы</button>
                        </div>
                    </div>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/png/3.png">
                </div>
            </div>
        </div>

        <!-- Slider Controls -->
        <div class="hero-slider-controls">
            <button class="prev-slide">‹</button>
            <button class="next-slide">›</button>
        </div>

        <!-- Slider Indicators -->
        <div class="hero-slider-dots"></div>
    </div>
</section>

<!-- Services Section -->
<section class="services" id="services">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Наши услуги</h2>
            <p class="section-description">
                Полный спектр digital-маркетинга для роста вашего бизнеса. 
                Каждая услуга направлена на получение конкретного результата.
            </p>
        </div>

        <div class="services-grid">
            <?php
            $services = new WP_Query(array(
                'post_type' => 'services',
                'posts_per_page' => -1,
                'orderby' => 'menu_order',
                'order' => 'ASC'
            ));
            
            if ($services->have_posts()) :
                while ($services->have_posts()) : $services->the_post();
                    $icon = get_post_meta(get_the_ID(), '_service_icon', true);
                    $details = get_post_meta(get_the_ID(), '_service_details', true);
                    $details_list = explode("\n", $details);
                    ?>
                    <div class="service-card" data-service="<?php echo sanitize_title(get_the_title()); ?>">
                        <div class="service-icon gradient-blue">
                            <i data-lucide="<?php echo esc_attr($icon); ?>"></i>
                        </div>
                        <h3 class="service-title"><?php the_title(); ?></h3>
                        <p class="service-description"><?php echo get_the_excerpt(); ?></p>
                        <div class="service-footer">
                            <button class="service-more">
                                Подробнее
                                <i data-lucide="arrow-right"></i>
                            </button>
                            <i data-lucide="chevron-down" class="expand-icon"></i>
                        </div>
                        <div class="service-details">
                            <?php if (!empty($details_list)) : ?>
                                <ul class="service-list">
                                    <?php foreach ($details_list as $item) : ?>
                                        <li><?php echo esc_html($item); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                            <button class="btn btn-primary btn-sm btn-full">Заказать услугу</button>
                        </div>
                    </div>
                <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>

        <div class="section-footer">
            <button class="btn btn-outline btn-lg" onclick="scrollToSection('contacts')">Получить консультацию</button>
        </div>
    </div>
</section>

<!-- Cases Preview Section -->
<section class="cases-preview" id="cases">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Кейсы наших клиентов</h2>
            <p class="section-description">
                Реальные результаты реальных проектов. Каждый кейс — это история успеха и конкретные цифры роста бизнеса.
            </p>
        </div>

        <div class="cases-grid">
            <?php
            $cases = new WP_Query(array(
                'post_type' => 'cases',
                'posts_per_page' => 3,
                'orderby' => 'date',
                'order' => 'DESC'
            ));
            
            if ($cases->have_posts()) :
                while ($cases->have_posts()) : $cases->the_post();
                    $thumbnail = get_the_post_thumbnail_url() ?: get_template_directory_uri().'/png/Starship_Troopers_Morita_Side_ortho.jpg';
                    ?>
                    <a href="<?php the_permalink(); ?>" class="case-card">
                        <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php the_title(); ?>">
                        <div class="case-info">
                            <span class="case-category"><?php echo get_the_category_list(', '); ?></span>
                            <h3 class="case-title"><?php the_title(); ?></h3>
                        </div>
                    </a>
                <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>