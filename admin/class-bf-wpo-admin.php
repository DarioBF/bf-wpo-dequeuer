<?php

/*
 * @link       https://www.dariobf.com
 * @since      0.1.0
 *
 * @package    BF_WPO_Dequeuer
 */
 
class BF_WPO_Dequeuer_Admin {
    protected $version;
    public function __construct( $version ) {
        $this->version = $version;

        // create custom plugin settings menu
        add_action( 'admin_menu', array($this, 'create_menu') );
    }
 
    public static function create_menu() {

        //create new top-level menu
        add_menu_page( 'BF WPO Dequeuer Settings', 'BF WPO Dequeuer', 'administrator', 'bf_wpo_options', array( $this, 'settings_page' ), 'data:image/svg+xml;base64,' . base64_encode('<svg width="100%" height="100%" viewBox="0 0 33 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:1.41421;"><g transform="matrix(0.169038,0,0,0.169038,-10.4483,-11.2925)"><g transform="matrix(15.7756,0,0,15.7756,-411.007,-616.707)"><path d="M37.098,52.841L36.17,51.912C36.06,51.803 35.882,51.803 35.773,51.912L34.726,52.96C34.068,53.617 32.997,53.617 32.339,52.96C31.681,52.302 31.681,51.231 32.339,50.573L33.386,49.526C33.496,49.416 33.496,49.238 33.386,49.128L32.458,48.2C32.348,48.09 32.17,48.09 32.06,48.2L31.013,49.247C29.624,50.636 29.624,52.896 31.013,54.285C32.402,55.674 34.662,55.674 36.051,54.285L37.098,53.238C37.208,53.128 37.208,52.95 37.098,52.841ZM35.773,46.742C35.882,46.852 36.06,46.852 36.17,46.742L37.217,45.695C37.875,45.037 38.946,45.037 39.604,45.695C40.262,46.353 40.262,47.423 39.604,48.081L38.557,49.128C38.447,49.238 38.447,49.416 38.557,49.526L39.485,50.454C39.595,50.564 39.773,50.564 39.883,50.454L40.93,49.407C42.319,48.018 42.319,45.758 40.93,44.369C39.541,42.98 37.281,42.98 35.892,44.369L34.845,45.416C34.735,45.526 34.735,45.704 34.845,45.814L35.773,46.742ZM39.154,53.836L41.807,53.837L31.462,43.492L30.136,44.818L39.154,53.836Z" style="fill:white;fill-rule:nonzero;"/></g></g></svg>' ) );
    
        //call register settings function
        add_action( 'admin_init', array( $this, 'register_settings' ) );
    }

    public static function register_settings() {
        //register our settings
        register_setting( 'bf_wpo_scripts', 'bf_wpo_scripts' );
    }

    public static function settings_page() {
        $bf_wpo_options = get_option('bf_wpo_scripts');
    ?>
        <div class="wrap">
            <h1>BF WPO Dequeuer</h1>
        
            <p><?php _e('You should add the handles of the styles/scripts (comma separated) you want to dequeue in each front template and the plugin will do the magic.', 'bf-wpo-dequeuer') ?></p>
            <small><?php _e('Handle is the name of the style/script, should be unique (<a href="https://developer.wordpress.org/reference/functions/wp_enqueue_script/">as specified in the WordPress Developers Handbook</a>)', 'bf-wpo-dequeuer'); ?></small>
            <p><?php _e('<strong style="color: red;">*Disclaimer:</strong> If you don\'t know what you are doing, please uninstall this plugin.', 'bf-wpo-dequeuer') ?></p>
    
            <form method="post" action="options.php">
                <?php settings_fields( 'bf_wpo_scripts' ); ?>
                <?php do_settings_sections( 'bf_wpo_scripts' ); ?>
                <table class="form-table">
                    <tr valign="top">
                        <?php if( !empty($bf_wpo_options['list-styles']) && $bf_wpo_options['list-styles'] ) $checked_styles = ' checked="checked"'; ?>
                        <th scope="row"><?php _e('Display enqueued styles (frontend debug)', 'bf-wpo-dequeuer'); ?></th>
                        <td><input type="checkbox" name="bf_wpo_scripts[list-styles]" <?php print (isset($checked_styles) && !empty($checked_styles)) ? $checked_styles : '' ?> /></td>
                    </tr>

                    <tr valign="top">
                        <?php if( !empty($bf_wpo_options['list-scripts']) && $bf_wpo_options['list-scripts'] ) $checked_scripts = ' checked="checked"'; ?>
                        <th scope="row"><?php _e('Display enqueued scripts (frontend debug)', 'bf-wpo-dequeuer'); ?></th>
                        <td><input type="checkbox" name="bf_wpo_scripts[list-scripts]" <?php print ( isset($checked_scripts ) && !empty( $checked_scripts ) ) ? $checked_scripts : '' ?> /></td>
                    </tr>
                    
                    <tr valign="top">
                        <th scope="row"><?php _e('Styles everywhere', 'bf-wpo-dequeuer') ?></th>
                        <td><textarea rows="5" cols="50" name="bf_wpo_scripts[styles-all]"><?php echo esc_attr( $bf_wpo_options['styles-all'] ); ?></textarea></td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><?php _e('Styles for Frontpage or Home', 'bf-wpo-dequeuer'); ?><br> <small><?php _e('(if no static page set as frontpage)', 'bf-wpo-dequeuer'); ?></small></th>
                        <td><textarea rows="5" cols="50" name="bf_wpo_scripts[styles-frontpage]"><?php echo esc_attr( $bf_wpo_options['styles-frontpage'] ); ?></textarea></td>
                    </tr>
        
                    <tr valign="top">
                        <th scope="row"><?php _e('Styles for Single', 'bf-wpo-dequeuer'); ?></th>
                        <td><textarea rows="5" cols="50" name="bf_wpo_scripts[styles-single]"><?php echo esc_attr( $bf_wpo_options['styles-single'] ); ?></textarea></td>
                    </tr>
        
                    <tr valign="top">
                        <th scope="row"><?php _e('Styles for Pages', 'bf-wpo-dequeuer'); ?></th>
                        <td><textarea rows="5" cols="50" name="bf_wpo_scripts[styles-page]"><?php echo esc_attr( $bf_wpo_options['styles-page'] ); ?></textarea></td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><?php _e('Styles for Archives', 'bf-wpo-dequeuer'); ?></th>
                        <td><textarea rows="5" cols="50" name="bf_wpo_scripts[styles-archive]"><?php echo esc_attr( $bf_wpo_options['styles-archive'] ); ?></textarea></td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><?php _e('Scripts everywhere', 'bf-wpo-dequeuer'); ?></th>
                        <td><textarea rows="5" cols="50" name="bf_wpo_scripts[scripts-all]"><?php echo esc_attr( $bf_wpo_options['scripts-all'] ); ?></textarea></td>
                    </tr>
                    
                    <tr valign="top">
                        <th scope="row"><?php _e('Scripts for Frontpage or Home', 'bf-wpo-dequeuer'); ?><br> <small><?php _e('(if no static page set as frontpage)', 'bf-wpo-dequeuer'); ?></small></th>
                        <td><textarea rows="5" cols="50" name="bf_wpo_scripts[scripts-frontpage]"><?php echo esc_attr( $bf_wpo_options['scripts-frontpage'] ); ?></textarea></td>
                    </tr>
        
                    <tr valign="top">
                        <th scope="row"><?php _e('Scripts Single', 'bf-wpo-dequeuer'); ?></th>
                        <td><textarea rows="5" cols="50" name="bf_wpo_scripts[scripts-single]"><?php echo esc_attr( $bf_wpo_options['scripts-single'] ); ?></textarea></td>
                    </tr>
        
                    <tr valign="top">
                        <th scope="row"><?php _e('Scripts Page', 'bf-wpo-dequeuer'); ?></th>
                        <td><textarea rows="5" cols="50" name="bf_wpo_scripts[scripts-page]"><?php echo esc_attr( $bf_wpo_options['scripts-page'] ); ?></textarea></td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><?php _e('Scripts Archive', 'bf-wpo-dequeuer'); ?></th>
                        <td><textarea rows="5" cols="50" name="bf_wpo_scripts[scripts-archive]"><?php echo esc_attr( $bf_wpo_options['scripts-archive'] ); ?></textarea></td>
                    </tr>
                </table>
                
                <?php submit_button(); ?>
        
            </form>

            <h2><?php _e('Generated code', 'bf-wpo-dequeuer'); ?></h2>
            <p><?php _e('You can copy&paste it wherever you want (I recommend a plugin instead of your theme\'s functions.php)', 'bf-wpo-dequeuer'); ?></p>
            <p><?php _e('BTW, you don\'t need this code if you keep <em>BF WPO Dequeuer</em> activated!', 'bf-wpo-dequeuer'); ?></p>
            <br>
            <pre><?php
                print "/* Code generated by BF WPO Dequeuer */\n";
                if( !empty($this->get_handles( 'styles-frontpage' )) ) {
                    print "if( is_front_page() ){\n";
                    print $this->get_handles( 'styles-frontpage' );
                    print "}\n";
                }
                if( !empty($this->get_handles( 'styles-single' )) ) {
                    print "if( is_single() ){\n";
                    print $this->get_handles( 'styles-single' );
                    print "}\n";
                }
                if( !empty($this->get_handles( 'styles-page' )) ) {
                    print "if( is_page() ){\n";
                    print $this->get_handles( 'styles-page' );
                    print "}\n";
                }
                if( !empty($this->get_handles( 'styles-all' )) ) {
                    print "/* Applies to all templates */\n";
                    print $this->get_handles( 'styles-all' );
                }
                
                if( !empty($this->get_handles( 'scripts-frontpage' )) ) {
                    print "if( is_front_page() ){\n";
                    print $this->get_handles( 'scripts-frontpage' );
                    print "}\n";
                }
                if( !empty($this->get_handles( 'scripts-single' )) ) {
                    print "if( is_single() ){\n";
                    print $this->get_handles( 'scripts-single' );
                    print "}\n";
                }
                if( !empty($this->get_handles( 'scripts-page' )) ) {
                    print "if( is_page() ){\n";
                    print $this->get_handles( 'scripts-page' );
                    print "}\n";
                }
                if( !empty($this->get_handles( 'scripts-all' )) ) {
                    print "/* Applies to all templates */\n";
                    print $this->get_handles( 'scripts-all' );
                }
            ?></pre>
        </div>
    <?php
    }

    /**
     * Returns a string with the 'dequeue list' of an area
     */
    private function get_handles( $area ){
        $bf_wpo_options = get_option('bf_wpo_scripts');

        $return = "";
        

        if ( strpos($area, 'style') !== false )
            $style = true;
        
        if( isset($bf_wpo_options[$area]) && !empty($bf_wpo_options[$area]) ) {
            $handles = explode ( ",", $bf_wpo_options[$area] );
            $handles = array_map( 'trim', $handles );
            foreach( $handles as $handle ) {
                if( $style == true )
                    $return .= "\twp_dequeue_style('". $handle ."');\n";
                else
                    $return .= "\twp_dequeue_script('". $handle ."');\n";
            }
        }

        return $return;
    }
}
?>