<?php 
/*
    Plugin Name: Our Team Elementor Addon
    Version: 1.0
    Description: Add addon Our Team for Elementor.
    Author: KochetovaKseniya
*/


function enqueue_our_team_elementor_styles() {
    wp_enqueue_style('our-team-styles', plugin_dir_url(__FILE__) . 'css/our-team-styles.css');
}
add_action('wp_enqueue_scripts', 'enqueue_our_team_elementor_styles');

function register_our_team_elementor_widget() {
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \YourNamespace\Widgets\Our_Team_Elementor_Widget());
}
add_action('elementor/widgets/widgets_registered', 'register_our_team_elementor_widget');

?>