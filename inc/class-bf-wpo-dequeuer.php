<?php
 
/*
 * @link       https://www.dariobf.com
 * @since      0.1.0
 *
 * @package    BF_WPO_Dequeuer
 */

class BF_WPO_Dequeuer {
    protected $loader;
    protected $runner;
    protected $plugin_slug;
    protected $version;

    public function __construct() {

        $this->plugin_slug = 'bf-wpo-dequeuer';
        $this->version = '1.1.0';

        $this->load_dependencies();
        $this->define_admin_hooks();
    }

    private function load_dependencies() {
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-bf-wpo-admin.php';

        require_once plugin_dir_path( __FILE__ ) . 'class-bf-wpo-loader.php';
        $this->loader = new BF_WPO_Loader();

        require_once plugin_dir_path( __FILE__ ) . 'class-bf-wpo-runner.php';
        $this->runner = new BF_WPO_Runner();
    }

    private function define_admin_hooks() {
        $admin = new BF_WPO_Dequeuer_Admin( $this->get_version() );
        $this->loader->add_action( 'admin_enqueue_scripts', $admin, 'enqueue_styles' );
        $this->loader->add_action( 'add_meta_boxes', $admin, 'add_meta_box' );
    }

    public function run() {
        $this->loader->run();
    }

    public function get_version() {
        return $this->version;
    }
}
?>