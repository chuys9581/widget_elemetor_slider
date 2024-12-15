<?php
/*
Plugin Name: Elementor Image Slider Widget
Plugin URI: https://tudominio.com/plugins/elementor-image-slider-widget
Description: Un widget de slider de imágenes para Elementor
Version: 1.0
Author: Tu Nombre
Author URI: https://tudominio.com
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

function register_image_slider_widget($widgets_manager) {
    require_once(__DIR__ . '/widgets/image-slider-widget.php');
    $widgets_manager->register(new \Elementor_Image_Slider_Widget());
}
add_action('elementor/widgets/register', 'register_image_slider_widget');

function enqueue_image_slider_widget_scripts() {
    wp_enqueue_script('swiper', 'https://unpkg.com/swiper/swiper-bundle.min.js', [], null, true);
    wp_enqueue_style('swiper', 'https://unpkg.com/swiper/swiper-bundle.min.css');
    
    wp_enqueue_script('image-slider-widget-js', plugins_url('assets/js/image-slider-widget.js', __FILE__), ['swiper'], '1.0.0', true);
    wp_enqueue_style('image-slider-widget-css', plugins_url('assets/css/image-slider-widget.css', __FILE__));
}
add_action('wp_enqueue_scripts', 'enqueue_image_slider_widget_scripts');