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

<!-- About Us Section -->
<section class="about-us" id="about">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Кто мы такие</h2>
            <p class="section-description">
                Команда профессионалов, которая превращает идеи в результаты. Мы не просто выполняем задачи — 
                мы создаем стратегии, которые работают и приносят реальный доход вашему бизнесу.
            </p>
        </div>

        <div class="about-content">
            <div class="about-text">
                <div class="about-highlights">
                    <div class="highlight-item">
                        <div class="highlight-number">50+</div>
                        <div class="highlight-label">Успешных проектов</div>
                    </div>
                    <div class="highlight-item">
                        <div class="highlight-number">3</div>
                        <div class="highlight-label">Года на рынке</div>
                    </div>
                    <div class="highlight-item">
                        <div class="highlight-number">15+</div>
                        <div class="highlight-label">Направлений маркетинга</div>
                    </div>
                </div>
                
                <p class="about-description">
                    Мы — это не обычное агентство, которое просто делает красивые картинки. Каждый участник команды — 
                    это эксперт в своей области, который понимает, как превратить креатив в конверсии, а идеи в прибыль. 
                    Наш подход основан на данных, аналитике и глубоком понимании потребностей бизнеса.
                </p>
            </div>
        </div>

        <div class="team-grid">
            <!-- Александр Молчанов -->
            <div class="team-member">
                <div class="member-photo">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/team/Sasha.jpg" 
                         alt="Александр Молчанов" 
                         onerror="this.src='<?php echo get_template_directory_uri(); ?>/assets/png/placeholder-person.jpg'">
                    <div class="member-overlay">
                        <div class="member-social">
                            <a href="#" class="social-link">
                                <i data-lucide="linkedin"></i>
                            </a>
                            <a href="#" class="social-link">
                                <i data-lucide="mail"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="member-info">
                    <h3 class="member-name">Александр Молчанов</h3>
                    <p class="member-position">Главный маркетолог</p>
                    <p class="member-description">
                        Стратег и аналитик. Разрабатывает комплексные маркетинговые стратегии, 
                        которые увеличивают продажи и строят долгосрочные отношения с клиентами.
                    </p>
                </div>
            </div>

            <!-- Илья Смирнов -->
            <div class="team-member">
                <div class="member-photo">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/team/Ilya.jpg" 
                         alt="Илья Смирнов"
                         onerror="this.src='<?php echo get_template_directory_uri(); ?>/assets/png/placeholder-person.jpg'">
                    <div class="member-overlay">
                        <div class="member-social">
                            <a href="https://t.me/ReunionRS" class="social-link">
                                <svg class="social-icon" width="20" height="20" viewBox="0 0 50 50" fill="currentColor">
                                <path d="M25,2c12.703,0,23,10.297,23,23S37.703,48,25,48S2,37.703,2,25S12.297,2,25,2z M32.934,34.375	c0.423-1.298,2.405-14.234,2.65-16.783c0.074-0.772-0.17-1.285-0.648-1.514c-0.578-0.278-1.434-0.139-2.427,0.219	c-1.362,0.491-18.774,7.884-19.78,8.312c-0.954,0.405-1.856,0.847-1.856,1.487c0,0.45,0.267,0.703,1.003,0.966	c0.766,0.273,2.695,0.858,3.834,1.172c1.097,0.303,2.346,0.04,3.046-0.395c0.742-0.461,9.305-6.191,9.92-6.693	c0.614-0.502,1.104,0.141,0.602,0.644c-0.502,0.502-6.38,6.207-7.155,6.997c-0.941,0.959-0.273,1.953,0.358,2.351	c0.721,0.454,5.906,3.932,6.687,4.49c0.781,0.558,1.573,0.811,2.298,0.811C32.191,36.439,32.573,35.484,32.934,34.375z"/>
                            </svg>
                            </a>
                            <a href="https://github.com/ReunionRS" class="social-link">
                                <i data-lucide="github"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="member-info">
                    <h3 class="member-name">Илья Смирнов</h3>
                    <p class="member-position">Веб-разработчик, 3D художник</p>
                    <div class="member-skills">
                        <span class="skill-tag">Веб-разработка</span>
                        <span class="skill-tag">3D моделирование</span>
                        <span class="skill-tag">Unreal Engine</span>
                        <span class="skill-tag">CGI</span>
                        <span class="skill-tag">3D анимация</span>
                        <span class="skill-tag">Монтаж</span>
                    </div>
                    <p class="member-description">
                        Технический гений команды. Создает сайты, 3D визуализации и интерактивные решения, 
                        которые поражают воображение и конвертируют посетителей в клиентов.
                    </p>
                </div>
            </div>

            <!-- Кирилл Бабушкин -->
            <div class="team-member">
                <div class="member-photo">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/team/Kirill.jpg" 
                         alt="Кирилл Бабушкин"
                         onerror="this.src='<?php echo get_template_directory_uri(); ?>/assets/png/placeholder-person.jpg'">
                    <div class="member-overlay">
                        <div class="member-social">
                            <a href="#" class="social-link">
                                <i data-lucide="linkedin"></i>
                            </a>
                            <a href="#" class="social-link">
                                <i data-lucide="instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="member-info">
                    <h3 class="member-name">Кирилл Бабушкин</h3>
                    <p class="member-position">Креативный директор</p>
                    <div class="member-skills">
                        <span class="skill-tag">Видеомонтаж</span>
                        <span class="skill-tag">Съемка</span>
                        <span class="skill-tag">Маркетинг</span>
                        <span class="skill-tag">Фотография</span>
                    </div>
                    <p class="member-description">
                        Визионер и создатель контента. Превращает обычные идеи в вирусные кампании, 
                        которые заставляют аудиторию говорить о вашем бренде.
                    </p>
                </div>
            </div>
        </div>
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
                            <a href="<?php the_permalink(); ?>" class="service-more">
                                Подробнее
                                <i data-lucide="arrow-right"></i>
                            </a>
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
            <a href="<?php echo get_post_type_archive_link('services'); ?>" class="btn btn-outline btn-lg">Посмотреть все услуги</a>
            <a href="https://notagancy.ru/contacts/" class="btn btn-primary btn-lg">Получить консультацию</a>
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
                'order' => 'DESC',
                'post_status' => 'publish'
            ));
            
            if ($cases->have_posts()) :
                while ($cases->have_posts()) : $cases->the_post();
                    $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'large');
                    if (!$thumbnail) {
                        $thumbnail = get_template_directory_uri() . '/assets/png/Starship_Troopers_Morita_Side_ortho.jpg';
                    }
                    
                    $categories = get_the_category(get_the_ID());
                    $category_display = !empty($categories) ? $categories[0]->name : 'Кейс';
                    ?>
                    <a href="<?php the_permalink(); ?>" class="case-card">
                        <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php the_title_attribute(); ?>">
                        <div class="case-info">
                            <span class="case-category"><?php echo esc_html($category_display); ?></span>
                            <h3 class="case-title"><?php the_title(); ?></h3>
                        </div>
                    </a>
                <?php
                endwhile;
                wp_reset_postdata();
            else : ?>
                <div class="no-cases-message">
                    <p>Скоро здесь появятся наши успешные кейсы. Следите за обновлениями!</p>
                </div>
            <?php endif; ?>
        </div>

        <div class="section-footer">
            <a href="<?php echo get_post_type_archive_link('cases'); ?>" class="btn btn-outline btn-lg">Посмотреть все кейсы</a>
        </div>
    </div>
</section>

<?php get_footer(); ?>