<?php 
/*
    Plugin Name: Our Team Elementor Addon
    Version:     1.0.0
    Description: Add addon Our Team for Elementor
    Author: KochetovaKseniya
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function our_team_enqueue_styles( $widgets_manager ) {

	require_once( __DIR__ . '/widgets/our-team-elementor-widget.php' );

	$widgets_manager->register( new \Our_Team_Elementor_Widget() );

}
add_action( 'elementor/widgets/register', 'our_team_enqueue_styles' );

// function our_team_enqueue_styles() {
//     wp_enqueue_style('our-team-styles', plugin_dir_url(__FILE__) . 'our-team-styles.css');
// }
// add_action('wp_enqueue_scripts', 'our_team_enqueue_styles');

?>
