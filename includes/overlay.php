<?php
/**
 * SW_Overlay
 * 
 * Wordpress plugin that will display an ad takeover as an overlay.
 *
 */
class SW_Overlay
{

    /**
     * String that will hold the plugin directory
     * Is set by the constructor
     */
    private static $_pluginDir = '';

    /**
     * Constructor for the plugin, will set up all the hooks
     *
     * @param string $dir
     * @access public
     * @return void
     */
    public function __construct($dir)
    {
        self::$_pluginDir = $dir;
        add_action( 'wp_footer', array('SW_Overlay', 'addFooterDiv'), 100 );
        add_action('admin_menu', array('SW_Overlay', 'addAdminMenu'));
        add_action('init'      , array('SW_Overlay', 'init'));
    }

    /**
     * Init hook
     * Will show the popup if needed
     *
     * @access public
     * @return void
     */
    public static function init()
    {
		$admin = is_admin();
		$overz = get_option('sw_overlay_active');
        if(!is_admin() && get_option('sw_overlay_active') == 'true') {
            self::displayPopup();
        }
    }

    /**
     * Install hook, responsible for writing all settings to the database
     *
     * @static
     * @access public
     * @return void
     */
    public static function installation()
    {
        add_option('sw_overlay_link', '');
		add_option('sw_overlay_repeat_duration', '');
		add_option('sw_overlay_image', '');
        add_option('sw_overlay_close_text', 'Close');
        add_option('sw_overlay_show_always', '');
		add_option('sw_overlay_active', '');
    }


    /**
     * Method that will add our administrator menu to wordpress
     *
     * @static
     * @access public
     * @return void
     */
    public static function addAdminMenu()
    {
        add_menu_page('Overlay Options',
                      'Overlay',
                      'administrator', 
                      'sw_overlay_settings',
                      array('SW_Overlay', 'admin_settings'));

    }


    /**
     * Method that is responsible for rendering the settings page
     *
     * @static
     * @access public
     * @return void
     */
    public static function admin_settings()
    {
        $link               =  get_option('sw_overlay_link');
		$image              =  get_option('sw_overlay_image');
		$repeatDuration     =  get_option('sw_overlay_repeat_duration');
        $closeText          =  get_option('sw_overlay_close_text', 'Close');
        $showAlways         = (get_option('sw_overlay_show_always') == 'true') ? 'checked="checked"' : '';
		$active             = (get_option('sw_overlay_active') == 'true') ? 'checked="checked"' : '';

        include(self::$_pluginDir.'includes/view_admin.php');
    }

    /**
     * Method that will enqueue all the needed js and css
     * so that the plugin can render succesfully 
     *
     * @static
     * @access public
     * @return void
     */
    public static function displayPopup()
    {
        $jsUrl  = plugins_url( 'js/popup.js'   , dirname(__FILE__) );
        $cssUrl = plugins_url( 'css/popup.css' , dirname(__FILE__) );

        $params = array('link'           => get_option('sw_overlay_link'),
                        'image'          => get_option('sw_overlay_image'),
						'repeatDuration' => get_option('sw_overlay_repeat_duration'),
                        'showAlways'     => get_option('sw_overlay_show_always'),
                        'close'          => get_option('sw_overlay_close_text'),
                    );

        wp_enqueue_script( 'jquery' );
        wp_enqueue_script( 'overlay_popup', $jsUrl,  array(), '1.0.0', true );
        wp_enqueue_style ( 'overlay_popup', $cssUrl, array());
        wp_localize_script( 'overlay_popup', 'sw_overlay_settings', $params );
    }

    /**
     * Method that is hooked to the footer hook, will add a div that can hold the popup
     *
     * @static
     * @access public
     * @return void
     */
    public static function addFooterDiv()
    {
        echo '<div id="sw_overlay"></div>';
    }
}
