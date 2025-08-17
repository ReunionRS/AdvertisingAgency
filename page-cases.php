<?php
/* Template Name: Кейсы */
get_header();
?>

<div class="cases-page container">

    <!-- Хлебные крошки -->
    <nav class="breadcrumbs">
        <a href="<?php echo home_url(); ?>">Главная</a> — <span>Кейсы</span>
    </nav>

    <!-- Заголовок -->
    <h1 class="cases-title">Кейсы</h1>


    <!-- Сетка кейсов -->
    <div class="cases-grid">
        <?php
        $args = array(
            'post_type' => 'cases', 
            'posts_per_page' => -1
        );
        $query = new WP_Query($args);

        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
        ?>
            <div class="case-card">
                <a href="<?php the_permalink(); ?>">
                    <div class="case-thumb">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                    <div class="case-info">
                        <span class="case-category"><?php echo get_the_category_list(', '); ?></span>
                        <h3 class="case-title"><?php the_title(); ?></h3>
                    </div>
                </a>
            </div>
        <?php
            endwhile;
            wp_reset_postdata();
        else :
            echo '<p>Кейсов пока нет.</p>';
        endif;
        ?>
    </div>
</div>

<?php get_footer(); ?>
