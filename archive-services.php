<?php get_header(); ?>

<main class="services-archive">
    <div class="container">
        <div class="section-header">
            <h1 class="section-title">Наши услуги</h1>
            <p class="section-description">
                Полный спектр digital-маркетинга для роста вашего бизнеса.
            </p>
        </div>

        <div class="services-grid">
            <?php
            if (have_posts()) :
                while (have_posts()) : the_post();
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
                
                the_posts_pagination(array(
                    'prev_text' => __('Назад', 'nereklamnoe'),
                    'next_text' => __('Вперед', 'nereklamnoe'),
                ));
                
            else :
                echo '<p>Услуги не найдены.</p>';
            endif;
            ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>