<?php
/*
Template Name: Политика конфиденциальности
Description: Шаблон страницы Политика конфиденциальности
*/

get_header(); ?>

<main id="site-content" role="main" class="privacy-policy-page">
    <div class="container">
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) : the_post(); ?>
                
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                    </header>

                    <div class="entry-content">
                        <?php
                        the_content(); 
                        ?>
                    </div>
                </article>

            <?php endwhile;
        else :
            echo '<p>Контент не найден.</p>';
        endif;
        ?>
    </div>
</main>

<?php get_footer(); ?>
