<?php
get_header();
?>

<main class="single-service">

    <!-- Хлебные крошки -->
    <nav class="breadcrumbs container">
        <a href="<?php echo home_url(); ?>">Главная</a> &raquo;
        <a href="<?php echo get_post_type_archive_link('services'); ?>">Услуги</a> &raquo;
        <span><?php the_title(); ?></span>
    </nav>

    <div class="container">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                $details = get_post_meta(get_the_ID(), '_service_details', true);
                $details_list = $details ? explode("\n", $details) : array();
        ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <!-- Шапка услуги: заголовок слева, картинка справа -->
            <div class="service-header">
                <div class="service-header-text">
                    <h1 class="service-title-header"><?php the_title(); ?></h1>
                    <?php if ($lead = get_post_meta(get_the_ID(), '_service_lead', true)) : ?>
                        <p class="service-lead"><?php echo esc_html($lead); ?></p>
                    <?php endif; ?>
                    
                    <!-- Вывод перечня услуг (что входит) -->
                    <?php if (!empty($details_list)) : ?>
                    <div class="service-includes">
                        <h3>Что входит в услугу:</h3>
                        <ul class="service-list">
                            <?php foreach ($details_list as $item) : ?>
                                <?php if (trim($item)) : ?>
                                <li><?php echo esc_html(trim($item)); ?></li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                    
                    <div class="service-cta">
                        <a href="#contact-form" class="btn btn-primary">Заказать услугу</a>
                        <a href="<?php echo get_post_type_archive_link('services'); ?>" class="btn btn-outline">Все услуги</a>
                    </div>
                </div>
                <?php if (has_post_thumbnail()) : ?>
                <div class="service-header-image">
                    <?php the_post_thumbnail('large'); ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- Основной контент -->
            <div class="service-content">
                <?php the_content(); ?>
            </div>

            <!-- Доп. секции через ACF -->
            <?php if (function_exists('have_rows') && have_rows('service_sections')) : ?>
                <?php while (have_rows('service_sections')) : the_row(); ?>
                    <section class="service-section">
                        <?php if (get_sub_field('title')) : ?>
                            <h2><?php the_sub_field('title'); ?></h2>
                        <?php endif; ?>
                        <div class="section-body">
                            <div class="section-text">
                                <?php the_sub_field('content'); ?>
                            </div>
                            <?php if ($img = get_sub_field('image')) : ?>
                                <div class="section-image">
                                    <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>">
                                </div>
                            <?php endif; ?>
                        </div>
                    </section>
                <?php endwhile; ?>
            <?php endif; ?>

            <!-- Блок "Другие услуги" -->
<div class="related-services">
    <h3>Другие услуги</h3>
    <div class="services-grid">
        <?php
        $related = get_posts([
            'post_type' => 'services',
            'posts_per_page' => 3, // Выводим только 3 услуги
            'post__not_in' => [get_the_ID()],
            'orderby' => 'rand'
        ]);
        
        foreach ($related as $r) :
            $icon = get_post_meta($r->ID, '_service_icon', true) ?: 'target';
            $gradient = get_post_meta($r->ID, '_service_gradient', true) ?: 'gradient-blue';
            $services_list = get_post_meta($r->ID, '_services_list', true);
            $services_array = $services_list ? explode("\n", $services_list) : array();
        ?>
        <div class="service-card" data-service="<?php echo sanitize_title(get_the_title($r)); ?>">
            <div class="service-icon <?php echo esc_attr($gradient); ?>">
                <i data-lucide="<?php echo esc_attr($icon); ?>"></i>
            </div>
            <h3 class="service-title"><?php echo get_the_title($r); ?></h3>
            <p class="service-description"><?php echo get_the_excerpt($r); ?></p>
            <div class="service-footer">
                <a href="<?php echo get_permalink($r); ?>" class="service-more">
                    Подробнее
                    <i data-lucide="arrow-right"></i>
                </a>
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
        <?php endforeach; ?>
    </div>
</div>

        </article>

        <?php
            endwhile;
        endif;
        ?>
    </div>

</main>

<?php
get_footer();