<?php
/* Шаблон: single-cases.php */
get_header(); ?>

<div class="single-case container">
    <?php if (function_exists('yoast_breadcrumb')) {
        yoast_breadcrumb('<nav class="breadcrumbs">','</nav>');
    } else { ?>
        <nav class="breadcrumbs">
            <a href="<?php echo home_url(); ?>">Главная</a> —
            <a href="<?php echo get_post_type_archive_link('cases'); ?>">Кейсы</a> —
            <span><?php the_title(); ?></span>
        </nav>
    <?php } ?>

    <h1 class="case-title"><?php the_title(); ?></h1>

    <div class="case-content">
        <?php if (has_post_thumbnail()) : ?>
            <div class="case-banner">
                <?php the_post_thumbnail('full'); ?>
            </div>
        <?php endif; ?>

        <div class="case-body">
            <?php the_content(); ?>
        </div>
    </div>

    <div class="case-footer">
        <a href="<?php echo get_post_type_archive_link('cases'); ?>" class="back-link">← Назад к списку</a>
    </div>
</div>

<?php get_footer(); ?>
