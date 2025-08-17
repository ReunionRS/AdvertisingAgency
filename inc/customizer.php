<?php
function nereklamnoe_customize_register($wp_customize) {
    // Контактная информация
    $wp_customize->add_section('nereklamnoe_contact_info', array(
        'title' => __('Контактная информация', 'nereklamnoe'),
        'priority' => 30,
    ));
    
    // Телефон
    $wp_customize->add_setting('phone_number', array(
        'default' => '+7 (999) 123-45-67',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('phone_number', array(
        'label' => __('Телефон', 'nereklamnoe'),
        'section' => 'nereklamnoe_contact_info',
        'type' => 'text',
    ));
    
    // Email
    $wp_customize->add_setting('email_address', array(
        'default' => 'hello@nereklamnoe.ru',
        'sanitize_callback' => 'sanitize_email',
    ));
    
    $wp_customize->add_control('email_address', array(
        'label' => __('Email', 'nereklamnoe'),
        'section' => 'nereklamnoe_contact_info',
        'type' => 'email',
    ));
    
    // Адрес
    $wp_customize->add_setting('address', array(
        'default' => 'Москва, ул. Примерная, 123',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('address', array(
        'label' => __('Адрес', 'nereklamnoe'),
        'section' => 'nereklamnoe_contact_info',
        'type' => 'text',
    ));
    
    // ID контактной формы
    $wp_customize->add_setting('contact_form_id', array(
        'default' => '',
        'sanitize_callback' => 'absint',
    ));
    
    $wp_customize->add_control('contact_form_id', array(
        'label' => __('ID контактной формы (Contact Form 7)', 'nereklamnoe'),
        'section' => 'nereklamnoe_contact_info',
        'type' => 'number',
    ));
    
    // Социальные сети
    $wp_customize->add_section('nereklamnoe_social_media', array(
        'title' => __('Социальные сети', 'nereklamnoe'),
        'priority' => 35,
    ));
    
    // Facebook
    $wp_customize->add_setting('facebook_url', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('facebook_url', array(
        'label' => __('Facebook URL', 'nereklamnoe'),
        'section' => 'nereklamnoe_social_media',
        'type' => 'url',
    ));
    
    // Instagram
    $wp_customize->add_setting('instagram_url', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('instagram_url', array(
        'label' => __('Instagram URL', 'nereklamnoe'),
        'section' => 'nereklamnoe_social_media',
        'type' => 'url',
    ));
    
    // LinkedIn
    $wp_customize->add_setting('linkedin_url', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('linkedin_url', array(
        'label' => __('LinkedIn URL', 'nereklamnoe'),
        'section' => 'nereklamnoe_social_media',
        'type' => 'url',
    ));
}
add_action('customize_register', 'nereklamnoe_customize_register');