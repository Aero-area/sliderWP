<?php
/**
 * Plugin Name: SliderWP Before/After Slider for Elementor
 * Description: Elementor widget for a before/after image comparison slider.
 * Version: 1.0.0
 * Author: SliderWP
 * Text Domain: cempur-before-after-slider
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

final class Cempur_Before_After_Slider_Plugin {
    const VERSION = '1.0.0';

    public function __construct() {
        add_action( 'plugins_loaded', array( $this, 'init' ) );
    }

    public function init() {
        if ( ! did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', array( $this, 'admin_notice_missing_elementor' ) );
            return;
        }

        add_action( 'elementor/widgets/register', array( $this, 'register_widgets' ) );
        add_action( 'elementor/frontend/after_register_scripts', array( $this, 'register_scripts' ) );
        add_action( 'elementor/frontend/after_register_styles', array( $this, 'register_styles' ) );
    }

    public function register_widgets( $widgets_manager ) {
        require_once plugin_dir_path( __FILE__ ) . 'includes/class-cempur-before-after-widget.php';

        $widgets_manager->register( new \Cempur_Before_After_Widget() );
    }

    public function register_scripts() {
        wp_register_script(
            'cempur-before-after-slider',
            plugin_dir_url( __FILE__ ) . 'assets/js/cempur-before-after.js',
            array(),
            self::VERSION,
            true
        );
    }

    public function register_styles() {
        wp_register_style(
            'cempur-before-after-slider',
            plugin_dir_url( __FILE__ ) . 'assets/css/cempur-before-after.css',
            array(),
            self::VERSION
        );
    }

    public function admin_notice_missing_elementor() {
        if ( isset( $_GET['activate'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
            unset( $_GET['activate'] ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended
        }

        $message = sprintf(
            /* translators: 1: Plugin name, 2: Elementor */
            esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'cempur-before-after-slider' ),
            '<strong>' . esc_html__( 'SliderWP Before/After Slider for Elementor', 'cempur-before-after-slider' ) . '</strong>',
            '<strong>' . esc_html__( 'Elementor', 'cempur-before-after-slider' ) . '</strong>'
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', wp_kses_post( $message ) );
    }
}

new Cempur_Before_After_Slider_Plugin();
