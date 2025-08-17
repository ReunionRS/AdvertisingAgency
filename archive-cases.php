<?php get_header(); ?>

<main class="cases-archive">
    <div class="container">
        <div class="section-header">
            <h1 class="section-title">Наши кейсы</h1>
            <p class="section-description">
                Реальные результаты реальных проектов. Каждый кейс — это история успеха и конкретные цифры роста бизнеса.
            </p>
        </div>

        <div class="cases-grid">
            <?php
            if (have_posts()) :
                while (have_posts()) : the_post();
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
                
                the_posts_pagination(array(
                    'prev_text' => __('Назад', 'nereklamnoe'),
                    'next_text' => __('Вперед', 'nereklamnoe'),
                ));
                
            else :
                echo '<p>Кейсы не найдены.</p>';
            endif;
            ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>