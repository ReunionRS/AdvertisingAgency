<?php
/* Шаблон: single-cases.php */
get_header(); ?>

<main class="single-case">

    <!-- Хлебные крошки -->
    <nav class="breadcrumbs container">
        <a href="<?php echo home_url(); ?>">Главная</a> &raquo;
        <a href="<?php echo get_post_type_archive_link('cases'); ?>">Кейсы</a> &raquo;
        <span><?php the_title(); ?></span>
    </nav>

    <div class="container">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                // Получаем метаданные для кейса
                $details = get_post_meta(get_the_ID(), '_case_details', true);
                $details_list = $details ? explode("\n", $details) : array();
                $lead = get_post_meta(get_the_ID(), '_case_lead', true);
        ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <!-- Шапка кейса: заголовок слева, картинка справа -->
            <div class="service-header">
                <div class="service-header-text">
                    <h1 class="service-title"><?php the_title(); ?></h1>
                    <?php if ($lead) : ?>
                        <p class="service-lead"><?php echo esc_html($lead); ?></p>
                    <?php endif; ?>
                    
                    
                    <div class="service-cta">
                        <a href="#contact-form" class="btn btn-primary">Обсудить проект</a>
                        <a href="<?php echo get_post_type_archive_link('cases'); ?>" class="btn btn-outline">Все кейсы</a>
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
            <!-- Вывод перечня деталей кейса -->
                    <?php if (!empty($details_list)) : ?>
                    <div class="service-includes">
                        <h3>Что было выполнено в работе?</h3>
                        <ul class="service-list">
                            <?php foreach ($details_list as $item) : ?>
                                <?php if (trim($item)) : ?>
                                <li><?php echo esc_html(trim($item)); ?></li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>

            <!-- Доп. секции через ACF -->
            <?php if (function_exists('have_rows') && have_rows('case_sections')) : ?>
                <?php while (have_rows('case_sections')) : the_row(); ?>
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

            <!-- Блок "Другие кейсы" -->
            <div class="related-services">
                <h3>Другие кейсы</h3>
                <div class="services-grid">
                    <?php
                    $related = get_posts([
                        'post_type' => 'cases',
                        'posts_per_page' => 3,
                        'post__not_in' => [get_the_ID()],
                        'orderby' => 'rand'
                    ]);
                    
                    foreach ($related as $r) :
                        $thumbnail = get_the_post_thumbnail_url($r->ID) ?: get_template_directory_uri().'/png/Starship_Troopers_Morita_Side_ortho.jpg';
                        $category = get_post_meta($r->ID, '_case_category', true) ?: 'Кейс';
                    ?>
                    <div class="case-card">
                        <a href="<?php echo get_permalink($r); ?>">
                            <div class="case-thumb">
                                <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php echo get_the_title($r); ?>">
                            </div>
                            <div class="case-info">
                                <span class="case-category"><?php echo esc_html($category); ?></span>
                                <h3 class="case-title"><?php echo get_the_title($r); ?></h3>
                            </div>
                        </a>
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