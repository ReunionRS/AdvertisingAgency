<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?></title>
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <!-- Navigation -->
    <nav class="navbar" id="navbar">
        <div class="container">
            <div class="nav-content">
                <!-- Logo -->
                <div class="nav-logo">
                    <div class="logo-icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/png/Logo.png">
                    </div>
                    <span class="logo-text">НеРекламное агентство</span>
                </div>

                <!-- Desktop Navigation -->
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container' => false,
                    'menu_class' => 'nav-links',
                    'fallback_cb' => false,
                    'walker' => new Nereklamnoe_Walker_Nav_Menu()
                ));
                ?>

                <!-- Mobile menu button -->
                <button class="mobile-menu-toggle" id="mobile-menu-toggle">
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                </button>
            </div>

            <!-- Mobile Navigation -->
            <?php
            wp_nav_menu(array(
                'theme_location' => 'mobile',
                'container' => false,
                'menu_class' => 'mobile-nav',
                'menu_id' => 'mobile-nav',
                'fallback_cb' => false,
                'items_wrap' => '<div id="%1$s" class="%2$s">%3$s</div>'
            ));
            ?>
        </div>
    </nav>