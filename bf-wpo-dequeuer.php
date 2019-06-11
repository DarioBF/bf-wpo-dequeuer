<?php
/**
 * Plugin Name:       BF WPO Dequeuer
 * Plugin URI:        https://www.dariobf.com/wpo-dequeuer
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.1.1
 * Author:            DarioBF
 * Author URI:        https://www.dariobf.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       bf-wpo-dequeuer
 * Domain Path:       /languages
 * 
 * @link       https://www.dariobf.com
 * @since      0.1.0
 *
 * @package    BF_WPO_Dequeuer
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once plugin_dir_path( __FILE__ ) . 'inc/class-bf-wpo-dequeuer.php';
 
function run_bf_wpo_dequeuer() {
    $bwd = new BF_WPO_Dequeuer();
    $bwd->run();
}
run_bf_wpo_dequeuer();