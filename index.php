<?php get_header(); ?>

<!-- Hero Section with Slider -->
<section class="hero-slider" id="home">
    <div class="hero-slider-wrapper">
        <?php
        $hero_slides = new WP_Query(array(
            'post_type' => 'hero_slides',
            'posts_per_page' => -1,
            'orderby' => 'menu_order',
            'order' => 'ASC'
        ));
        
        $slide_count = 0;
        if ($hero_slides->have_posts()) : while ($hero_slides->have_posts()) : $hero_slides->the_post();
            $slide_count++;
        ?>
        <div class="hero-slide <?php echo $slide_count === 1 ? 'active' : ''; ?>">
            <div class="container">
                <div class="hero-slide-content">
                    <div class="hero-text">
                        <h1><?php the_title(); ?></h1>
                        <p><?php the_content(); ?></p>
                        <div class="hero-buttons">
                            <button class="btn btn-secondary btn-lg" onclick="scrollToSection('services')">Посмотреть услуги</button>
                            <button class="btn btn-hero btn-lg" onclick="scrollToSection('cases')">Наши кейсы</button>
                        </div>
                    </div>
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('hero-slide'); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endwhile; endif; wp_reset_postdata(); ?>
        
        <?php if ($slide_count === 0) : ?>
        <!-- Дефолтный слайд если нет кастомных -->
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
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hero-1.png" alt="Hero">
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if ($slide_count > 1) : ?>
        <!-- Slider Controls -->
        <div class="hero-slider-controls">
            <button class="prev-slide">‹</button>
            <button class="next-slide">›</button>
        </div>

        <!-- Slider Indicators -->
        <div class="hero-slider-dots"></div>
        <?php endif; ?>
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
                'posts_per_page' => 6,
                'orderby' => 'menu_order',
                'order' => 'ASC'
            ));
            
            if ($services->have_posts()) : while ($services->have_posts()) : $services->the_post();
                $icon = get_post_meta(get_the_ID(), '_service_icon', true) ?: 'target';
                $gradient = get_post_meta(get_the_ID(), '_service_gradient', true) ?: 'gradient-blue';
                $services_list = get_post_meta(get_the_ID(), '_services_list', true);
                $services_array = $services_list ? explode("\n", $services_list) : array();
            ?>
            <div class="service-card" data-service="<?php echo sanitize_title(get_the_title()); ?>">
                <div class="service-icon <?php echo esc_attr($gradient); ?>">
                    <i data-lucide="<?php echo esc_attr($icon); ?>"></i>
                </div>
                <h3 class="service-title"><?php the_title(); ?></h3>
                <p class="service-description"><?php the_excerpt(); ?></p>
                <div class="service-footer">
                    <button class="service-more">
                        Подробнее
                        <i data-lucide="arrow-right"></i>
                    </button>
                    <i data-lucide="chevron-down" class="expand-icon"></i>
                </div>
                <div class="service-details">
                    <?php if (!empty($services_array)) : ?>
                    <ul class="service-list">
                        <?php foreach ($services_array as $service_item) : ?>
                            <?php if (trim($service_item)) : ?>
                            <li><?php echo esc_html(trim($service_item)); ?></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                    <button class="btn btn-primary btn-sm btn-full" onclick="scrollToSection('contacts')">Заказать услугу</button>
                </div>
            </div>
            <?php endwhile; endif; wp_reset_postdata(); ?>
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
                'posts_per_page' => 6,
                'orderby' => 'date',
                'order' => 'DESC'
            ));
            
            if ($cases->have_posts()) : while ($cases->have_posts()) : $cases->the_post();
                $category = get_post_meta(get_the_ID(), '_case_category', true) ?: 'Маркетинг';
            ?>
            <a href="<?php the_permalink(); ?>" class="case-card">
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('case-preview'); ?>
                <?php else : ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/case-placeholder.jpg" alt="<?php the_title(); ?>">
                <?php endif; ?>
                <div class="case-info">
                    <span class="case-category"><?php echo esc_html($category); ?></span>
                    <h3 class="case-title"><?php the_title(); ?></h3>
                </div>
            </a>
            <?php endwhile; endif; wp_reset_postdata(); ?>
        </div>
        
        <div class="section-footer">
            <a href="<?php echo get_post_type_archive_link('cases'); ?>" class="btn btn-outline btn-lg">Все кейсы</a>
        </div>
    </div>
</section>

<?php get_footer(); ?>