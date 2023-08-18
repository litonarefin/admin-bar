<?php
namespace JLTADMINBAR\Inc\Classes;

class AdminBarRemover {

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
            add_action('wp_ajax_update_form',  [$this, 'update_form']);
            add_action('admin_menu',  [$this,'menu_pages_init']);
            add_action('init', [$this,'load_text_domain']);
        }
    }

    /**
     * Register a custom menu page.
     */
    function menu_pages_init() {
        add_submenu_page(
            'options-general.php',
            __('Admin Bar','admin-bar'),
            __('Admin Bar','admin-bar'),
            'administrator',
            'admin-bar',
            [$this,'jlt_admin_bar_remover_contents']
        );
    }


    // Menu Callback Function
    function jlt_admin_bar_remover_contents() {
        $option = !empty( get_option('show-ab') ) ? get_option('show-ab') : 0;
        ?>

        <div class="wrap">
            <div class="updated" id="ab-update"></div>
            <div id="icon-tools" class="icon32"><br/></div>
            <h2>
                <?php esc_html_e('Admin Bar','admin-bar'); ?>
            </h2>
            <div class="ab-content">
                <form id="ab-form" action="" method="post">
                    <ul class="ab-form-controlls">
                        <li>
                            <label for="ab-show" class="ab-control-title"><?php esc_html_e('Show Admin Bar in frontend', 'admin-bar'); ?></label>
                            <input value="1" class="checkbox" type="checkbox" name="ab-show" <?php echo (( (bool) $option===true)? 'checked' : null); ?> />
                        </li>
                    </ul>
                    <input type="hidden" name="action" value="update_form" />
                    <input type="submit" class="button-primary alignleft" value="<?php esc_html_e('Save', 'admin-bar'); ?>" />
                    <?php wp_nonce_field('admin_bar_security_nonce'); ?>
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

    function update_form() {
        check_ajax_referer('admin_bar_security_nonce', 'security');
        if(!empty($_POST['ab-show']) && isset( $_POST['ab-show'] )) {
            update_option('show-ab', true);
        } else {
            update_option('show-ab', false);
        }
        esc_html_e('Option saved!','admin-bar');
        die();
    }

    public function load_text_domain() {
        load_plugin_textdomain( $this->textdomain , false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
    }


        /**
         * Returns the singleton instance of the class.
         */

        public static function get_instance()
        {
            if (!isset(self::$instance) && !(self::$instance instanceof AdminBarRemover)) {
                self::$instance = new AdminBarRemover();
                self::$instance->jlt_admin_bar_init();
            }

            return self::$instance;
        }
}
