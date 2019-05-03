<?php
/**
 * BF WPO Dequeuer Runner
 * @link              https://www.dariobf.com
 * @since             0.1.0
 * @package           BF_WPO_Scripts
 */

class BF_WPO_Runner {
    public function __construct() {
        $bf_wpo_options = get_option('bf_wpo_scripts');

        add_action( 'wp_print_styles', array( $this, 'styles_runner'), 9999 );
        add_action( 'wp_print_scripts', array( $this, 'scripts_runner'), 9999 );

        if( !empty($bf_wpo_options['list-styles']) && $bf_wpo_options['list-styles'] ) {
            add_action( 'wp_footer', array( $this, 'print_styles') );
        }
        if( !empty($bf_wpo_options['list-scripts']) && $bf_wpo_options['list-scripts'] ) {
            add_action( 'wp_footer', array( $this, 'print_scripts') );
        }
    }

    public static function styles_runner(){
        if( is_admin() ) return;
    
        /* Retrieving the plugin options */
        $bf_wpo_options = get_option('bf_wpo_scripts');
    
        if( is_front_page() ) {
            $styles_front = explode ( ",", $bf_wpo_options['styles-frontpage'] );
            $styles_front = array_map( 'trim', $styles_front );
            foreach( $styles_front as $handle ) {
                wp_dequeue_style( $handle );
            }
        }
    
        if( is_single() ) {
            $styles_front = explode ( ",", $bf_wpo_options['styles-single'] );
            $styles_front = array_map( 'trim', $styles_front );
            foreach( $styles_front as $handle ) {
                wp_dequeue_style( $handle );
            }
        }
    
        if( is_page() ) {
            $styles_front = explode ( ",", $bf_wpo_options['styles-page'] );
            $styles_front = array_map( 'trim', $styles_front );
            foreach( $styles_front as $handle ) {
                wp_dequeue_style( $handle );
            }
        }

        if( is_archive() ) {
            $styles_front = explode ( ",", $bf_wpo_options['styles-archive'] );
            $styles_front = array_map( 'trim', $styles_front );
            foreach( $styles_front as $handle ) {
                wp_dequeue_style( $handle );
            }
        }

        if( !empty( $bf_wpo_options['styles-all'] ) ) {
            $styles_front = explode ( ",", $bf_wpo_options['styles-all'] );
            $styles_front = array_map( 'trim', $styles_front );
            foreach( $styles_front as $handle ) {
                wp_dequeue_style( $handle );
            }
        }
        
    }

    public static function scripts_runner(){
        if( is_admin() ) return;
    
        /* Retrieving the plugin options */
        $bf_wpo_options = get_option('bf_wpo_scripts');
    
        if( is_front_page() ) {
            $scripts_front = explode ( ",", $bf_wpo_options['scripts-frontpage'] );
            $scripts_front = array_map( 'trim', $scripts_front );
            foreach( $scripts_front as $handle ) {
                wp_dequeue_script( $handle );
            }
        }
    
        if( is_single() ) {
            $scripts_front = explode ( ",", $bf_wpo_options['scripts-single'] );
            $scripts_front = array_map( 'trim', $scripts_front );
            foreach( $scripts_front as $handle ) {
                wp_dequeue_script( $handle );
            }
        }
    
        if( is_page() ) {
            $scripts_front = explode ( ",", $bf_wpo_options['scripts-page'] );
            $scripts_front = array_map( 'trim', $scripts_front );
            foreach( $scripts_front as $handle ) {
                wp_dequeue_script( $handle );
            }
        }

        if( is_archive() ) {
            $scripts_front = explode ( ",", $bf_wpo_options['scripts-archive'] );
            $scripts_front = array_map( 'trim', $scripts_front );
            foreach( $scripts_front as $handle ) {
                wp_dequeue_script( $handle );
            }
        }

        if( !empty( $bf_wpo_options['scripts-all'] ) ) {
            $scripts_front = explode ( ",", $bf_wpo_options['scripts-all'] );
            $scripts_front = array_map( 'trim', $scripts_front );
            foreach( $scripts_front as $handle ) {
                wp_dequeue_script( $handle );
            }
        }
    }

    public static function print_styles(){
        global $wp_styles;
        $bf_wpo_options = get_option('bf_wpo_scripts');
        $styles = array();

        $bottom = 0;

        if( !empty($bf_wpo_options['list-scripts']) && $bf_wpo_options['list-scripts'] ) $bottom = "2.5rem";

        if( $wp_styles && current_user_can('administrator') ) {
            print '<div style="display: block; width: 100%; line-height: 2rem; padding: .3rem 1rem; background-color: #ccc; position:fixed; bottom:'. $bottom .'; left:0; z-index: 999;">';
            _e ('Styles list: ', 'bf-wpo-dequeuer');
            foreach( $wp_styles->queue as $style ) {
                if( $count > 0 ) print ", ";
                array_push( $styles, $style );
                print $style;
                $count++;
            }
            print '</div>';
        }
    }

    public static function print_scripts(){
        global $wp_scripts;
        $scripts = array();

        $count = 0;

        if( $wp_scripts && current_user_can('administrator') ) {
            print '<div style="display: block; width: 100%; line-height: 2rem; padding: .3rem 1rem; background-color: #ccc; position:fixed; bottom:0; left:0; z-index: 999;">';
            _e ('Scripts list: ', 'bf-wpo-dequeuer');
            foreach( $wp_scripts->queue as $script ) {
                if( $count > 0 ) print ", ";
                array_push( $scripts, $script );
                print $script;
                $count++;
            }
            print '</div>';
        }
    }
}
?>