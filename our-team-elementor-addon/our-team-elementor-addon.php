<?php 
/*
    Plugin Name: Our Team Elementor Addon
    Version:     1.0.0
    Description: Add addon Our Team for Elementor
    Author: Kochetova Kseniya
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function our_team_enqueue_widget( $widgets_manager ) {

	require_once( __DIR__ . '/widgets/our-team-elementor-widget.php' );

	$widgets_manager->register( new \Our_Team_Elementor_Widget() );

}
add_action( 'elementor/widgets/register', 'our_team_enqueue_widget' );

function our_team_enqueue_styles() {
    wp_enqueue_style('our-team-styles', plugin_dir_url(__FILE__) . 'our-team-elementor-addon.css');
}
add_action('wp_enqueue_scripts', 'our_team_enqueue_styles');

function enqueue_swiper_scripts() {
    wp_enqueue_style('swiper-css', 'https://unpkg.com/swiper/swiper-bundle.min.css', array(), '6.8.4');
    wp_enqueue_script('swiper-js', 'https://unpkg.com/swiper/swiper-bundle.min.js', array(), '6.8.4', true);
}

add_action('wp_enqueue_scripts', 'enqueue_swiper_scripts');
?>
