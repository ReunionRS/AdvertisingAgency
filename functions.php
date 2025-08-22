<?php

require_once get_template_directory() . '/inc/class-walker-nav-menu.php';
function nereklamnoe_scripts() {
    wp_enqueue_style('nereklamnoe-style', get_stylesheet_uri());
    wp_enqueue_style('nereklamnoe-main', get_template_directory_uri() . '/assets/css/style.css');
    wp_enqueue_style('nereklamnoe-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap');
    wp_enqueue_style('nereklamnoe-lucide', 'https://cdnjs.cloudflare.com/ajax/libs/lucide/0.462.0/lucide.min.css');
    wp_enqueue_script('lucide-icons', 'https://unpkg.com/lucide@latest/dist/umd/lucide.js', array(), null, true);
    wp_enqueue_script('nereklamnoe-scripts', get_template_directory_uri() . '/assets/js/script.js', array(), '1.0', true);
}
add_action('wp_enqueue_scripts', 'nereklamnoe_scripts');

function nereklamnoe_setup() {
    add_theme_support('title-tag');
    
    add_theme_support('post-thumbnails');
    
    register_nav_menus(array(
            'primary' => __('Primary Menu', 'nereklamnoe'),
            'mobile' => __('Mobile Menu', 'nereklamnoe'),
            'footer' => __('Footer Menu', 'nereklamnoe') 
        ));
}
add_action('after_setup_theme', 'nereklamnoe_setup');

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

function nereklamnoe_add_case_meta() {
    add_meta_box(
        'case_details',
        'Что мы сделали в этой работе?',
        'nereklamnoe_case_meta_callback',
        'cases',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'nereklamnoe_add_case_meta');

function nereklamnoe_case_meta_callback($post) {
    wp_nonce_field('nereklamnoe_save_case_meta', 'nereklamnoe_case_meta_nonce');
    
    $lead = get_post_meta($post->ID, '_case_lead', true);
    $details = get_post_meta($post->ID, '_case_details', true);
    ?>
    <p>
        <label for="case_lead">Краткое описание:</label>
        <input type="text" id="case_lead" name="case_lead" value="<?php echo esc_attr($lead); ?>" class="widefat">
    </p>
    <p>
        <label for="case_details">Пункты которые выполнены в ходе работы над кейсом:</label>
        <textarea id="case_details" name="case_details" class="widefat" rows="5"><?php echo esc_textarea($details); ?></textarea>
    </p>
    <?php
}

function nereklamnoe_save_case_meta($post_id) {
    if (!isset($_POST['nereklamnoe_case_meta_nonce']) || 
        !wp_verify_nonce($_POST['nereklamnoe_case_meta_nonce'], 'nereklamnoe_save_case_meta')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    if (isset($_POST['case_lead'])) {
        update_post_meta($post_id, '_case_lead', sanitize_text_field($_POST['case_lead']));
    }
    
    if (isset($_POST['case_details'])) {
        update_post_meta($post_id, '_case_details', sanitize_textarea_field($_POST['case_details']));
    }
}
add_action('save_post', 'nereklamnoe_save_case_meta');

function nereklamnoe_add_categories_to_cases() {
    register_taxonomy_for_object_type('category', 'cases');
}
add_action('init', 'nereklamnoe_add_categories_to_cases');

// Добавьте этот код в functions.php вашей темы

// Обработка AJAX запросов для заказа услуг
add_action('wp_ajax_handle_service_order', 'handle_service_order');
add_action('wp_ajax_nopriv_handle_service_order', 'handle_service_order');

function handle_service_order() {
    // Проверяем nonce для безопасности (опционально)
    // if (!wp_verify_nonce($_POST['nonce'], 'service_order_nonce')) {
    //     wp_die('Security check failed');
    // }
    
    // Получаем данные из формы
    $name = sanitize_text_field($_POST['name'] ?? '');
    $phone = sanitize_text_field($_POST['phone'] ?? '');
    $email = sanitize_email($_POST['email'] ?? '');
    $company = sanitize_text_field($_POST['company'] ?? '');
    $description = sanitize_textarea_field($_POST['description'] ?? '');
    $budget = sanitize_text_field($_POST['budget'] ?? '');
    $timeline = sanitize_text_field($_POST['timeline'] ?? '');
    $service = sanitize_text_field($_POST['service'] ?? '');
    $consent = isset($_POST['consent']) ? 'Да' : 'Нет';
    
    // Валидация обязательных полей
    if (empty($name) || empty($phone) || empty($description) || empty($service)) {
        wp_send_json_error('Не заполнены обязательные поля');
        return;
    }
    
    if (!isset($_POST['consent'])) {
        wp_send_json_error('Необходимо согласие на обработку персональных данных');
        return;
    }
    
    // Подготавливаем данные для отправки email
    $admin_email = get_option('admin_email');
    $site_name = get_bloginfo('name');
    
    // Тема письма
    $subject = "Новая заявка на услугу: {$service}";
    
    // Тело письма для администратора
    $admin_message = "
    <html>
    <head>
        <meta charset='UTF-8'>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .header { background: #3b82f6; color: white; padding: 20px; text-align: center; }
            .content { padding: 20px; }
            .field { margin-bottom: 15px; }
            .field label { font-weight: bold; color: #555; }
            .field value { display: block; margin-top: 5px; }
            .service-highlight { background: #f3f4f6; padding: 15px; border-left: 4px solid #3b82f6; margin: 15px 0; }
        </style>
    </head>
    <body>
        <div class='header'>
            <h1>Новая заявка на услугу</h1>
            <p>Сайт: {$site_name}</p>
        </div>
        
        <div class='content'>
            <div class='service-highlight'>
                <h2>Заказанная услуга: {$service}</h2>
            </div>
            
            <div class='field'>
                <label>Имя клиента:</label>
                <div class='value'>{$name}</div>
            </div>
            
            <div class='field'>
                <label>Телефон:</label>
                <div class='value'>{$phone}</div>
            </div>
            
            " . (!empty($email) ? "
            <div class='field'>
                <label>Email:</label>
                <div class='value'>{$email}</div>
            </div>
            " : "") . "
            
            " . (!empty($company) ? "
            <div class='field'>
                <label>Компания:</label>
                <div class='value'>{$company}</div>
            </div>
            " : "") . "
            
            <div class='field'>
                <label>Описание проекта:</label>
                <div class='value'>" . nl2br($description) . "</div>
            </div>
            
            " . (!empty($budget) ? "
            <div class='field'>
                <label>Бюджет:</label>
                <div class='value'>{$budget}</div>
            </div>
            " : "") . "
            
            " . (!empty($timeline) ? "
            <div class='field'>
                <label>Желаемые сроки:</label>
                <div class='value'>{$timeline}</div>
            </div>
            " : "") . "
            
            <div class='field'>
                <label>Согласие на обработку данных:</label>
                <div class='value'>{$consent}</div>
            </div>
            
            <div class='field'>
                <label>Дата заявки:</label>
                <div class='value'>" . current_time('d.m.Y H:i') . "</div>
            </div>
        </div>
    </body>
    </html>
    ";
    
    // Заголовки для HTML письма
    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: ' . $site_name . ' <noreply@' . $_SERVER['HTTP_HOST'] . '>',
    );
    
    // Отправляем письмо администратору
    $admin_sent = wp_mail($admin_email, $subject, $admin_message, $headers);
    
    // Отправляем подтверждение клиенту (если указан email)
    $client_sent = true;
    if (!empty($email)) {
        $client_subject = "Спасибо за заявку на услугу \"{$service}\"";
        $client_message = "
        <html>
        <head>
            <meta charset='UTF-8'>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .header { background: #3b82f6; color: white; padding: 20px; text-align: center; }
                .content { padding: 20px; }
                .highlight { background: #f3f4f6; padding: 15px; border-left: 4px solid #3b82f6; margin: 15px 0; }
            </style>
        </head>
        <body>
            <div class='header'>
                <h1>Спасибо за вашу заявку!</h1>
                <p>{$site_name}</p>
            </div>
            
            <div class='content'>
                <p>Здравствуйте, <strong>{$name}</strong>!</p>
                
                <p>Мы получили вашу заявку на услугу <strong>\"{$service}\"</strong> и уже приступили к её обработке.</p>
                
                <div class='highlight'>
                    <h3>Что происходит дальше:</h3>
                    <ul>
                        <li>В течение 2 часов с вами свяжется наш менеджер</li>
                        <li>Мы обсудим детали проекта и ваши задачи</li>
                        <li>Подготовим персональное предложение</li>
                        <li>Составим план работ и договоримся о сроках</li>
                    </ul>
                </div>
                
                <p>Если у вас есть срочные вопросы, вы можете связаться с нами:</p>
                <ul>
                    <li>Телефон: +7 (922) 503 1853</li>
                    <li>Email: aleksandrmol4@notagency.ru</li>
                    <li>Telegram: @off_gold</li>
                </ul>
                
                <p>С уважением,<br>Команда НеРекламного агентства</p>
            </div>
        </body>
        </html>
        ";
        
        $client_sent = wp_mail($email, $client_subject, $client_message, $headers);
    }
    
    // Сохраняем заявку в базу данных (опционально)
    $order_data = array(
        'service' => $service,
        'name' => $name,
        'phone' => $phone,
        'email' => $email,
        'company' => $company,
        'description' => $description,
        'budget' => $budget,
        'timeline' => $timeline,
        'date_created' => current_time('mysql'),
        'ip_address' => $_SERVER['REMOTE_ADDR'] ?? '',
        'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? ''
    );
    
    // Можно сохранить в custom post type или отдельную таблицу
    save_service_order_to_db($order_data);
    
    // Отправляем ответ
    if ($admin_sent) {
        wp_send_json_success(array(
            'message' => 'Заявка успешно отправлена!',
            'client_notification_sent' => $client_sent
        ));
    } else {
        wp_send_json_error('Ошибка при отправке заявки. Попробуйте позже или свяжитесь с нами по телефону.');
    }
}

// Функция для сохранения заявки в базу данных
function save_service_order_to_db($data) {
    // Создаем запись как custom post
    $post_data = array(
        'post_title' => 'Заявка на ' . $data['service'] . ' от ' . $data['name'],
        'post_content' => $data['description'],
        'post_status' => 'private',
        'post_type' => 'service_order',
        'meta_input' => array(
            'service_name' => $data['service'],
            'client_name' => $data['name'],
            'client_phone' => $data['phone'],
            'client_email' => $data['email'],
            'client_company' => $data['company'],
            'project_budget' => $data['budget'],
            'project_timeline' => $data['timeline'],
            'client_ip' => $data['ip_address'],
            'client_user_agent' => $data['user_agent']
        )
    );
    
    $post_id = wp_insert_post($post_data);
    
    return $post_id;
}

// Регистрируем custom post type для хранения заявок
add_action('init', 'register_service_orders_post_type');

function register_service_orders_post_type() {
    register_post_type('service_order', array(
        'labels' => array(
            'name' => 'Заявки на услуги',
            'singular_name' => 'Заявка на услугу',
            'menu_name' => 'Заявки на услуги',
            'add_new' => 'Добавить заявку',
            'add_new_item' => 'Добавить новую заявку',
            'edit_item' => 'Редактировать заявку',
            'new_item' => 'Новая заявка',
            'view_item' => 'Просмотреть заявку',
            'search_items' => 'Поиск заявок',
            'not_found' => 'Заявки не найдены',
            'not_found_in_trash' => 'В корзине заявок не найдено'
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-email-alt',
        'capability_type' => 'post',
        'hierarchical' => false,
        'supports' => array('title', 'editor', 'custom-fields'),
        'has_archive' => false,
        'exclude_from_search' => true,
        'publicly_queryable' => false,
        'show_in_rest' => false
    ));
}

// Добавляем колонки в админ панели для заявок
add_filter('manage_service_order_posts_columns', 'service_order_columns');
add_action('manage_service_order_posts_custom_column', 'service_order_column_content', 10, 2);

function service_order_columns($columns) {
    return array(
        'cb' => $columns['cb'],
        'title' => 'Заявка',
        'service_name' => 'Услуга',
        'client_info' => 'Клиент',
        'budget' => 'Бюджет',
        'date' => 'Дата'
    );
}

function service_order_column_content($column, $post_id) {
    switch ($column) {
        case 'service_name':
            echo get_post_meta($post_id, 'service_name', true);
            break;
            
        case 'client_info':
            $name = get_post_meta($post_id, 'client_name', true);
            $phone = get_post_meta($post_id, 'client_phone', true);
            $email = get_post_meta($post_id, 'client_email', true);
            
            echo '<strong>' . $name . '</strong><br>';
            echo '<a href="tel:' . $phone . '">' . $phone . '</a><br>';
            if ($email) {
                echo '<a href="mailto:' . $email . '">' . $email . '</a>';
            }
            break;
            
        case 'budget':
            $budget = get_post_meta($post_id, 'project_budget', true);
            echo $budget ?: '—';
            break;
    }
}

// Обработка обычных форм консультации (для совместимости)
add_action('wp_ajax_handle_consultation_form', 'handle_consultation_form');
add_action('wp_ajax_nopriv_handle_consultation_form', 'handle_consultation_form');

function handle_consultation_form() {
    $name = sanitize_text_field($_POST['name'] ?? '');
    $contact = sanitize_text_field($_POST['contact'] ?? '');
    $message = sanitize_textarea_field($_POST['message'] ?? '');
    $consent = isset($_POST['consent']) ? 'Да' : 'Нет';
    
    if (empty($name) || empty($contact)) {
        wp_send_json_error('Не заполнены обязательные поля');
        return;
    }
    
    if (!isset($_POST['consent'])) {
        wp_send_json_error('Необходимо согласие на обработку персональных данных');
        return;
    }
    
    $admin_email = get_option('admin_email');
    $site_name = get_bloginfo('name');
    $subject = "Новая заявка на консультацию - {$site_name}";
    
    $admin_message = "
    <html>
    <head><meta charset='UTF-8'></head>
    <body>
        <h2>Новая заявка на консультацию</h2>
        <p><strong>Имя:</strong> {$name}</p>
        <p><strong>Контакт:</strong> {$contact}</p>
        " . (!empty($message) ? "<p><strong>Сообщение:</strong><br>" . nl2br($message) . "</p>" : "") . "
        <p><strong>Согласие на обработку данных:</strong> {$consent}</p>
        <p><strong>Дата:</strong> " . current_time('d.m.Y H:i') . "</p>
    </body>
    </html>
    ";
    
    $headers = array('Content-Type: text/html; charset=UTF-8');
    $sent = wp_mail($admin_email, $subject, $admin_message, $headers);
    
    if ($sent) {
        wp_send_json_success('Заявка успешно отправлена!');
    } else {
        wp_send_json_error('Ошибка при отправке заявки');
    }
}