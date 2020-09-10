<?php

/**
 * Plugin Name: Postico
 */

define( 'DIR_PATH', plugin_dir_path( __FILE__ ) );

if ( ! class_exists( 'Postico' ) ) {
    class Postico {
        
        public function __construct() {
            add_action( 'admin_menu', array( $this, 'setup_actions' ) );     
            add_action('wp_ajax_postico_use_icon', array( $this, 'postico_use_icon'));		
            add_filter( 'the_title', 'Postico::postico_title_icon', 10, 2 );	
            add_action('admin_enqueue_scripts', 'Postico::postico_enqueue_scripts');     
        }
        
        public function setup_actions() {           
            add_submenu_page('options-general.php', 'Post icon', 'Post icon', 'manage_options', 'postico', 'Postico::postico_page');   
            register_setting( 'postico-settings-group', 'icons_radio' );			
			register_setting( 'postico-settings-group', 'placement_radio' );					
				
        }

        public function postico_use_icon() {
        	update_post_meta($_POST['post_id'], 'use_icon', $_POST['y_n']);
        	echo 'Done';
        	die;
        }

        function postico_enqueue_scripts() {
        	wp_enqueue_script('custom', plugin_dir_url( __FILE__ ) . 'js/custom.js' );
        	wp_enqueue_script('datatables', 'https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js');
        	wp_enqueue_style('datatables', 'https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css');
        }

        function postico_title_icon( $title, $id = null ) {

		    if ( ! is_admin() ) {
		       
	            if(in_the_loop()){
	                $current_post_id = get_the_ID();
	                if(get_post_meta($current_post_id, 'use_icon', true) == 1 && $id == $current_post_id){
	                	if(get_option('placement_radio') == 1){
		                	$new_titile = $title . ' <span class="dashicons-before wp-menu-image '.get_option('icons_radio').'"></span>';
		                } else {
		                	$new_titile = '<span class="dashicons-before wp-menu-image '.get_option('icons_radio').'"></span> ' . $title;
		                }
	                	return $new_titile;  
	                }	                
	            }                     		        
		    }

		    return $title;
		}
		        
        public function postico_page() {

        	$args = array(
			    'post_type' => ['post', 'product']
			);
			$query = new WP_Query($args);
			$relevant_posts = $query->posts;

			$d_icons = ['dashicons-smiley', 'dashicons-youtube', 'dashicons-drumstick'];

			$chosen_icon = get_option('icons_radio');
			$chosen_place = get_option('placement_radio');

			include_once( plugin_dir_path( __FILE__ ) . 'admin_page.php'); 			 
        }
        
    }
    
    $postico = new Postico();
}