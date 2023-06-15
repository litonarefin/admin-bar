<?php
if (!class_exists('JltAdminBarRemover')) {

class JltAdminBarRemover {

    private $textdomain = 'admin-bar';
    private static $instance = null;

    public function __construct() {
        $this->jlt_admin_bar_constants();
        $this->jlt_admin_bar_init();
    }

    public function jlt_admin_bar_constants(){
        if (!defined('JLT_ADMIN_BAR_PLUGIN_URL')) {
            define('JLT_ADMIN_BAR_PLUGIN_URL', trailingslashit(plugins_url('/', __FILE__)));
        }
    }

    public function jlt_admin_bar_init(){
        if(! is_admin()) {
            if(! get_option('show-ab')) {
                add_action('show_admin_bar', '__return_false');
            }
        } else {
            add_action('wp_ajax_update_form',  [$this, 'UpdateForm']);
            add_action('admin_menu',  [$this,'MenuPagesInit']);
            add_action('admin_init', [$this,'Attachments']);
            add_action('init', [$this,'LoadTextDomain']);
        }
    }

    /**
     * Register a custom menu page.
     */
    function MenuPagesInit() {
        add_submenu_page(
            'options-general.php',
            __('Admin Bar','admin-bar'),
            __('Admin Bar','admin-bar'),
            'administrator',
            'admin-bar',
            [$this,'JltAdminBarContents']
        );
    }

    function Attachments() {
        wp_register_script('admin-bar-plugin', JLT_ADMIN_BAR_PLUGIN_URL .'/js/admin-bar.js', array('jquery-form'));
        wp_enqueue_script('admin-bar-plugin');
    }

    // Menu Callback Function
    function JltAdminBarContents() {
        $option = get_option('show-ab');
        ?>

        <div class="wrap">
            <div class="updated" id="ab-update"></div>
            <div id="icon-tools" class="icon32"><br/></div>
            <h2>
                <?php _e('Admin Bar','admin-bar'); ?>
            </h2>
            <div class="ab-content">
                <form id="ab-form" action="" method="post">
                    <ul class="ab-form-controlls">
                        <li>
                            <label for="ab-show" class="ab-control-title"><?php _e('Show Admin Bar in frontend', 'admin-bar'); ?></label>
                            <input value="1" class="checkbox" type="checkbox" name="ab-show" <?php echo (( (bool) $option===true)? 'checked' : null); ?> />
                        </li>
                    </ul>
                    <input type="hidden" name="action" value="update_form" />
                    <input type="submit" class="button-primary alignleft" value="<?php _e('Save', 'admin-bar'); ?>" />
                </form>
            </div>
        </div>
        <style>
            #ab-update {
            display: none;
            padding: 5px;
        }
        </style>
        <?php
    }

    function UpdateForm() {
        if(!empty($_POST['ab-show'])) {
            update_option('show-ab', true);
        } else {
            update_option('show-ab', false);
        }
        _e('Option saved!','admin-bar');
        die();
    }

    public function LoadTextDomain() {
        load_plugin_textdomain( $this->textdomain , false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
    }


        /**
         * Returns the singleton instance of the class.
         */

        public static function get_instance()
        {
            if (!isset(self::$instance) && !(self::$instance instanceof JltAdminBarRemover)) {
                self::$instance = new JltAdminBarRemover();
                self::$instance->jlt_admin_bar_init();
            }

            return self::$instance;
        }
}

    JltAdminBarRemover::get_instance();
}
