<?php get_header(); ?>

<main class="cases-archive">
    <div class="container">
        <div class="section-header">
            <h1 class="section-title">Наши кейсы</h1>
            <p class="section-description">
                Реальные результаты реальных проектов. Каждый кейс — это история успеха и конкретные цифры роста бизнеса.
            </p>
        </div>

        <!-- Фильтр по категориям -->
        <div class="cases-filters">
            <button class="filter-btn active" data-category="all">Все кейсы</button>
            <?php
            // Получаем категории для кастомного типа постов cases
            $categories = get_terms(array(
                'taxonomy' => 'category',
                'hide_empty' => true,
                'object_ids' => get_posts(array(
                    'post_type' => 'cases',
                    'posts_per_page' => -1,
                    'fields' => 'ids'
                ))
            ));
            
            if (!is_wp_error($categories) && !empty($categories)) :
                foreach ($categories as $category) : ?>
                    <button class="filter-btn" data-category="<?php echo esc_attr($category->slug); ?>">
                        <?php echo esc_html($category->name); ?>
                    </button>
                <?php endforeach;
            endif;
            ?>
        </div>

        <!-- Сетка кейсов -->
        <div class="cases-grid">
            <?php
            $cases_query = new WP_Query(array(
                'post_type' => 'cases',
                'posts_per_page' => -1, 
                'orderby' => 'date',
                'order' => 'DESC',
                'post_status' => 'publish'
            ));
            
            if ($cases_query->have_posts()) :
                while ($cases_query->have_posts()) : $cases_query->the_post();
                    $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'large');
                    if (!$thumbnail) {
                        $thumbnail = get_template_directory_uri() . '/assets/png/Starship_Troopers_Morita_Side_ortho.jpg';
                    }
                    
                    $categories = get_the_category(get_the_ID());
                    $category_classes = '';
                    $category_names = array();
                    
                    if (!empty($categories)) {
                        foreach ($categories as $category) {
                            $category_classes .= ' category-' . $category->slug;
                            $category_names[] = $category->name;
                        }
                    }
                    
                    $category_display = !empty($category_names) ? implode(', ', $category_names) : 'Кейс';
                    ?>
                    <a href="<?php the_permalink(); ?>" class="case-card<?php echo esc_attr($category_classes); ?>">
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
                    <p>Кейсы не найдены. Возможно, они еще не добавлены или находятся в черновиках.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const caseCards = document.querySelectorAll('.case-card');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Убираем активный класс со всех кнопок
            filterButtons.forEach(btn => btn.classList.remove('active'));
            // Добавляем активный класс к нажатой кнопке
            this.classList.add('active');
            
            const category = this.getAttribute('data-category');
            
            caseCards.forEach(card => {
                if (category === 'all' || card.classList.contains('category-' + category)) {
                    card.style.display = 'block';
                    // Добавляем анимацию появления
                    card.style.opacity = '0';
                    setTimeout(() => {
                        card.style.opacity = '1';
                    }, 100);
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
});
</script>

<?php get_footer(); ?>