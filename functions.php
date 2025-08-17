<?php
// Загрузка стилей и скриптов

require_once get_template_directory() . '/inc/class-walker-nav-menu.php';
function nereklamnoe_scripts() {
    // Основной стиль темы
    wp_enqueue_style('nereklamnoe-style', get_stylesheet_uri());
    
    // Дополнительные стили
    wp_enqueue_style('nereklamnoe-main', get_template_directory_uri() . '/assets/css/style.css');
    wp_enqueue_style('nereklamnoe-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap');
    wp_enqueue_style('nereklamnoe-lucide', 'https://cdnjs.cloudflare.com/ajax/libs/lucide/0.462.0/lucide.min.css');
    
    // Скрипты
    wp_enqueue_script('lucide-icons', 'https://unpkg.com/lucide@latest/dist/umd/lucide.js', array(), null, true);
    wp_enqueue_script('nereklamnoe-scripts', get_template_directory_uri() . '/assets/js/script.js', array(), '1.0', true);
}
add_action('wp_enqueue_scripts', 'nereklamnoe_scripts');

// Поддержка WordPress
function nereklamnoe_setup() {
    // Поддержка title tag
    add_theme_support('title-tag');
    
    // Поддержка миниатюр
    add_theme_support('post-thumbnails');
    
    // Меню
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'nereklamnoe'),
        'mobile' => __('Mobile Menu', 'nereklamnoe')
    ));
}
add_action('after_setup_theme', 'nereklamnoe_setup');

// Создание Custom Post Type для кейсов
function nereklamnoe_create_cases_cpt() {
    register_post_type('cases',
        array(
            'labels' => array(
                'name' => __('Кейсы', 'nereklamnoe'),
                'singular_name' => __('Кейс', 'nereklamnoe')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'cases'),
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
            'menu_icon' => 'dashicons-portfolio'
        )
    );
}
add_action('init', 'nereklamnoe_create_cases_cpt');

// Создание Custom Post Type для услуг
function nereklamnoe_create_services_cpt() {
    register_post_type('services',
        array(
            'labels' => array(
                'name' => __('Услуги', 'nereklamnoe'),
                'singular_name' => __('Услуга', 'nereklamnoe')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'services'),
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
            'menu_icon' => 'dashicons-admin-tools'
        )
    );
}
add_action('init', 'nereklamnoe_create_services_cpt');

// Добавление метаполей для услуг
function nereklamnoe_add_service_meta() {
    add_meta_box(
        'service_details',
        'Детали услуги',
        'nereklamnoe_service_meta_callback',
        'services',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'nereklamnoe_add_service_meta');

function nereklamnoe_service_meta_callback($post) {
    wp_nonce_field('nereklamnoe_save_service_meta', 'nereklamnoe_service_meta_nonce');
    
    $icon = get_post_meta($post->ID, '_service_icon', true);
    $details = get_post_meta($post->ID, '_service_details', true);
    ?>
    <p>
        <label for="service_icon">Иконка услуги:</label>
        <input type="text" id="service_icon" name="service_icon" value="<?php echo esc_attr($icon); ?>" class="widefat">
        <small>Используйте названия иконок из Lucide: https://lucide.dev/icons/</small>
    </p>
    <p>
        <label for="service_details">Детали услуги (каждая строка - отдельный пункт):</label>
        <textarea id="service_details" name="service_details" class="widefat" rows="5"><?php echo esc_textarea($details); ?></textarea>
    </p>
    <?php
}

function nereklamnoe_save_service_meta($post_id) {
    if (!isset($_POST['nereklamnoe_service_meta_nonce']) || 
        !wp_verify_nonce($_POST['nereklamnoe_service_meta_nonce'], 'nereklamnoe_save_service_meta')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    if (isset($_POST['service_icon'])) {
        update_post_meta($post_id, '_service_icon', sanitize_text_field($_POST['service_icon']));
    }
    
    if (isset($_POST['service_details'])) {
        update_post_meta($post_id, '_service_details', sanitize_textarea_field($_POST['service_details']));
    }
}
add_action('save_post', 'nereklamnoe_save_service_meta');