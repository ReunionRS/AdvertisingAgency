<?php
// inc/class-walker-nav-menu.php

if (!class_exists('Nereklamnoe_Walker_Nav_Menu')) {
    class Nereklamnoe_Walker_Nav_Menu extends Walker_Nav_Menu {
        
        // Открытие подменю
        public function start_lvl(&$output, $depth = 0, $args = array()) {
            $indent = str_repeat("\t", $depth);
            $output .= "\n$indent<ul class=\"sub-menu\">\n";
        }

        // Закрытие подменю
        public function end_lvl(&$output, $depth = 0, $args = array()) {
            $indent = str_repeat("\t", $depth);
            $output .= "$indent</ul>\n";
        }

        // Элемент меню
        public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
            $indent = ($depth) ? str_repeat("\t", $depth) : '';

            $classes = empty($item->classes) ? array() : (array) $item->classes;
            $classes[] = 'menu-item-' . $item->ID;

            $class_names = join(' ', array_filter($classes));
            $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

            $id = 'menu-item-' . $item->ID;
            $id = $id ? ' id="' . esc_attr($id) . '"' : '';

            $output .= $indent . '<li' . $id . $class_names . '>';

            $atts = array();
            $atts['href']   = !empty($item->url) ? $item->url : '';
            $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
            $atts['target'] = !empty($item->target) ? $item->target : '';
            $atts['rel']    = !empty($item->xfn) ? $item->xfn : '';

            $attributes = '';
            foreach ($atts as $attr => $value) {
                if (!empty($value)) {
                    $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }

            $title = apply_filters('the_title', $item->title, $item->ID);

            $item_output  = $args->before;
            $item_output .= '<a' . $attributes . ' class="nav-link">';
            $item_output .= $args->link_before . $title . $args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;

            $output .= $item_output;
        }

        // Закрытие элемента меню
        public function end_el(&$output, $item, $depth = 0, $args = array()) {
            $output .= "</li>\n";
        }
    }
}
