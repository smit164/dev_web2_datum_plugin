<?php
/**
 * Handle frontend scripts
 *
 * @package datum/Classes
 * @version 2.3.0
 */

use ScssPhp\ScssPhp\Compiler;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Frontend scripts class.
 */
class DM_Frontend_Scripts {

	/**
	 * Contains an array of script handles registered by DM.
	 *
	 * @var array
	 */
	private static $scripts = array();

	/**
	 * Contains an array of script handles registered by DM.
	 *
	 * @var array
	 */
	private static $styles = array();

	/**
	 * Contains an array of script handles localized by DM.
	 *
	 * @var array
	 */
	private static $wp_localize_scripts = array();

	/**
	 * Hook in methods.
	 */
	public static function init() {
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'load_scripts' ),9999 );
		//add_action( 'get_footer', array(__CLASS__, 'prefix_add_footer_styles'));
		//$this->prefix_add_footer_styles();
	}

	/**
	 * Register all DM scripts.
	 */
	private static function register_scripts() {

		$register_scripts = array(
			'jquery-2.2.0.min' => array(
				'src'     => 'https://code.jquery.com/jquery-2.2.0.min.js',
				'deps'    => array( 'jquery' ),
				'version' => '2.7.2',
			),
			'isotope.min' => array(
				'src'     => 'https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js',
				'deps'    => array( 'jquery' ),
				'version' => '2.7.2',
			),
			'validate.min' => array(
				'src'     => self::get_asset_url( 'js/jquery.validate.min.js'),
				'deps'    => array( 'jquery' ),
				'version' => '2.7.2',
			),
			'googleapis.min' => array(
				'src'     => 'https://maps.googleapis.com/maps/api/js?v=3&sensor=false&amp;libraries=drawing&key=AIzaSyDyJDEyJCzYCPQVIBhnGtxKi4uAtTTGnhA',
				'deps'    => array( 'jquery' ),
				'version' => '2.7.2',
			),
			'inputmask.js' => array(
				'src'     => self::get_asset_url( 'js/jquery.inputmask.bundle.min.js' ),
				'deps'    => array( 'jquery' ),
				'version' => '2.7.2',
			),
			'select2.min' => array(
				'src'     => 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js',
				'deps'    => array( 'jquery' ),
				'version' => '2.7.2',
			),
			'kendo.all.min' => array(
				'src'     => self::get_asset_url( 'js/kendo.all.min.js' ),
				'deps'    => array( 'jquery' ),
				'version' => '2.7.2',
			),
			'slick' => array(
				'src'     => self::get_asset_url( 'assets/js/slick.js' ),
				'deps'    => array( 'jquery' ),
				'version' => '2.7.2',
			),
			'lightgallery' => array(
				'src'     => self::get_asset_url( 'assets/js/lightgallery-all.js' ),
				'deps'    => array( 'jquery' ),
				'version' => '2.7.2',
			),
			'map.js' => array(
				'src'     => self::get_asset_url( 'js/map.js' ),
				'deps'    => array( 'jquery' ),
				'version' => '2.7.2',
			),
			'auth.js' => array(
				'src'     => self::get_asset_url( 'js/auth.js' ),
				'deps'    => array( 'jquery' ),
				'version' => '2.7.2',
			),
			'custom' => array(
				'src'     => self::get_asset_url( 'js/custom.js' ),
				'deps'    => array( 'jquery' ),
				'version' => '2.7.2',
			),
			'main' => array(
				'src'     => self::get_asset_url( 'assets/js/main.js' ),
				'deps'    => array( 'jquery' ),
				'version' => '2.7.2',
			),
			'property-single' => array(
				'src'     => self::get_asset_url( 'js/property-single.js' ),
				'deps'    => array( 'jquery' ),
				'version' => '2.7.2',
			),
            /**
             * Tag editor for search textbox
             */
            'jquery-ui.min' => array(
                'src'     => 'https://code.jquery.com/ui/1.12.1/jquery-ui.min.js',
                'deps'    => array( 'jquery' ),
                'version' => '2.7.2',
            ),
            'jquery.tagsinput-revisited' => array(
                'src'     => self::get_asset_url( 'js/jquery.tagsinput-revisited.js' ),
                'deps'    => array( 'jquery' ),
                'version' => '2.7.2',
            ),
            'jquery.inputmask.bundle' => array(
                'src'     => 'https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.2.6/jquery.inputmask.bundle.min.js',
                'deps'    => array( 'jquery' ),
                'version' => '2.7.2',
            ),
		);
		$post_name = get_option('datum_property_listing_id');
		$post_type = get_option('datum_property_type_id');
        global $post,$property,$single_property;
		//if($post_name == $post->ID || $post_type == $post->ID){		
			foreach ( $register_scripts as $name => $props ) {
				self::register_script( $name, $props['src'], $props['deps'], $props['version'] );
			}
		//}
		?>
		 <script type="text/javascript">
		 	var ajax_url = "<?php echo admin_url('admin-ajax.php'); ?>";
		 	var plugins_url = "<?php echo plugins_url('datum'); ?>";
		 	var zoom 	 = "<?php echo get_option('google_zoom_map' ,''); ?>";
		 	var latitude = "<?php echo get_option('google_zoom_latitude' ,''); ?>";
		 	var longitude = "<?php echo get_option('google_zoom_longitude' ,''); ?>";
    	</script>
    	<?php
	}

	/**
	 * Register all DM sty;es.
	 */
	private static function register_styles() {
		$version = '';

		$register_styles = array(
			'font-awesome.min.css' => array(
				'src'     => 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
				'deps'    => array(),
				'version' => $version,
				'has_rtl' => false,
			),
			'slick.css'   => array(
				'src'     => self::get_asset_url('assets/css/theme/slick.css'),
				'deps'    => array(),
				'version' => $version,
				'has_rtl' => false,
			),
			'slick-theme.css'    => array(
				'src'     => self::get_asset_url( 'assets/css/theme/slick-theme.css' ),
				'deps'    => array(),
				'version' => $version,
				'has_rtl' => false,
			),
			'kendo.default-v2.min'    => array(
				'src'     => self::get_asset_url( 'css/kendo.default-v2.min.css' ),
				'deps'    => array(),
				'version' => $version,
				'has_rtl' => false,
			),
			'lightgallery'    => array(
				'src'     => self::get_asset_url( 'assets/css/theme/lightgallery.css' ),
				'deps'    => array(),
				'version' => $version,
				'has_rtl' => false,
			),
			'select2.min.css' => array(
				'src'     => 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css',
				'deps'    => array(),
				'version' => $version,
				'has_rtl' => false,
			),
			'style'    => array(
				'src'     => self::get_asset_url( 'css/style.css' ),
				'deps'    => array(),
				'version' => $version,
				'has_rtl' => false,
			),

            /**
             * Tag editor for the search text box
             */
            'jquery-ui'    => array(
                'src'     => "http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css",
                'deps'    => array(),
                'version' => $version,
                'has_rtl' => false,
            ),
            'jquerysctipttop'    => array(
                'src'     => "https://www.jqueryscript.net/css/jquerysctipttop.css",
                'deps'    => array(),
                'version' => $version,
                'has_rtl' => false,
            ),
            'jquery.tagsinput-revisited'    => array(
                'src'     => "https://www.jqueryscript.net/demo/Tags-Input-Autocomplete/src/jquery.tagsinput-revisited.css",
                'deps'    => array(),
                'version' => $version,
                'has_rtl' => false,
            ),

		);

		foreach ( $register_styles as $name => $props ) {
			self::register_style( $name, $props['src'], $props['deps'], $props['version'], 'all', $props['has_rtl'] );
		}

		$scss = new Compiler();
		$scss->setImportPaths(DM_ABSPATH .'assets/scss/');
		$scss->setVariables(self::setVariablesData());
		file_put_contents(DM_ABSPATH.'css/style.css',$scss->compile('@import "_style.scss";').PHP_EOL);
	}


	public function prefix_add_footer_styles(){
		wp_enqueue_style('style_ds',plugin_dir_url('') . 'datum/css/style.css', array(), '1.0.1', 'all');
	}

	/**
	 * Register/queue frontend scripts.
	 */
	public static function load_scripts() {
		global $post;		

		self::register_scripts();
		self::register_styles();
		// CSS Styles.
		
	}
	/**
	 * Register a script for use.
	 *
	 * @uses   wp_register_script()
	 * @param  string   $handle    Name of the script. Should be unique.
	 * @param  string   $path      Full URL of the script, or path of the script relative to the WordPress root directory.
	 * @param  string[] $deps      An array of registered script handles this script depends on.
	 * @param  string   $version   String specifying script version number, if it has one, which is added to the URL as a query string for cache busting purposes. If version is set to false, a version number is automatically added equal to current installed WordPress version. If set to null, no version is added.
	 * @param  boolean  $in_footer Whether to enqueue the script before </body> instead of in the <head>. Default 'false'.
	 */
	private static function register_script( $handle, $path, $deps = array( 'jquery' ), $version = DM_VERSION, $in_footer = true ) {
		self::$scripts[] = $handle;
		wp_register_script( $handle, $path, $deps, $version, $in_footer );
		wp_enqueue_script($handle);
	}
	/**
	 * Register a style for use.
	 *
	 * @uses   wp_register_style()
	 * @param  string   $handle  Name of the stylesheet. Should be unique.
	 * @param  string   $path    Full URL of the stylesheet, or path of the stylesheet relative to the WordPress root directory.
	 * @param  string[] $deps    An array of registered stylesheet handles this stylesheet depends on.
	 * @param  string   $version String specifying stylesheet version number, if it has one, which is added to the URL as a query string for cache busting purposes. If version is set to false, a version number is automatically added equal to current installed WordPress version. If set to null, no version is added.
	 * @param  string   $media   The media for which this stylesheet has been defined. Accepts media types like 'all', 'print' and 'screen', or media queries like '(orientation: portrait)' and '(max-width: 640px)'.
	 * @param  boolean  $has_rtl If has RTL version to load too.
	 */
	private static function register_style( $handle, $path, $deps = array(), $version = DM_VERSION, $media = 'all', $has_rtl = false ) {
		self::$styles[] = $handle;
		wp_register_style( $handle, $path, $deps, $version, $media );
		wp_enqueue_style($handle);
	}

	/**
	 * Return asset URL.
	 *
	 * @param string $path Assets path.
	 * @return string
	 */
	private static function get_asset_url( $path ) {
		return apply_filters( 'datum_get_asset_url', plugins_url( $path, DM_PLUGIN_FILE ), $path );
	}

	public function setVariablesData($data = []){
		return
		array(
			'white'				=> '#ffffff',
			'black' 			=> '#000000',
			'font-primary-color'=> '#2C2C2C',
			'font-secondary-color'=> '#666666',
			'red-color' 		=> '#D22630',
			'blue-color' 		=> ' #000F9F', 
	        'grey-color' 		=> ' #BCBFC1',
	        'linkedin-color' 	=> ' #0077B5',
	        'coal-black' 		=> ' #3C3C3C',
	        'light-grey-color' 	=> ' #E3E9EF',
	        'light-blue-color' 	=> ' #EAF2FF',
	        'dark-grey-color' 	=> ' #CCCCCC',
	        'border-grey' 		=> ' #D2D2D2',
	        'white-secondary' 	=> ' #F3F3F3',
	        'right-body-color' 	=> '#EFF7FF',
	        'box-shadow-inset' 	=> ' inset 0 0 6px rgba(0,0,0,.3)',
	        'textbox-shadow' 	=> '0 0 10px rgba(0, 0, 0, 0.10)',
	        'box-shadow-grey' 	=> '0px 5px 15px rgba(172, 178, 193, 1)',
	        'extraBig-device' 	=> ' only screen and (min-width =>  1600px)',
	        'laptop-device' 	=> 'only screen and (min-width =>  1200px) and (max-width =>  1600px)',
	        'mini-laptop-device'=> 'only screen and (min-width =>  1200px) and (max-width =>  1300px)',
	        'desktop-device' 	=> 'only screen and (min-width =>  992px) and (max-width =>  1199px)',
	        'tablet-device' 	=> 'only screen and (min-width =>  768px) and (max-width => 991px)',
	        'small-mobile3' 	=> 'only screen and (min-width =>  430px) and (max-width => 575px)',
	        'small-tablet' 		=> 'only screen and (max-width =>  991px)',
	        'large-mobile' 		=> 'only screen and (max-width =>  767px)',
	        'small-mobile2' 	=> 'only screen and (max-width =>  575px)',
	        'small-mobile' 		=> 'only screen and (max-width =>  479px)',
	        'xsmall-mobile' 	=> 'only screen and (max-width =>  360px)',
	        'font-size0' 		=> '  0px',
	        'font-size8' 		=> '  8px',
	        'font-size9' 		=> '  9px',
	        'font-size10' 		=> '10px',
	        'font-size11' 		=> ' 11px',
	        'font-size12' 		=> ' 12px',
	        'font-size13'	 	=> ' 13px',
	        'font-size14'		=> ' 14px',
	        'font-size15' 		=> ' 15px',
	        'font-size16' 		=> ' 16px',
	        'font-size17' 		=> ' 17px',
	        'font-size18' 		=> ' 18px',
	        'font-size20' 		=> ' 20px',
	        'font-size21' 		=> '21px',
	        'font-size22' 		=> '22px',
	        'font-size24' 		=> '24px',
	        'font-size26' 		=> '26px',
	        'font-size28' 		=> '28px',
	        'font-size30' 		=> '30px',
	        'font-size32' 		=> '32px',
	        'font-size34' 		=> ' 34px',
	        'font-size36' 		=> ' 36px',
	        'font-size38' 		=> ' 38px',
	        'font-size40' 		=> ' 40px',
	        'font-size42' 		=> ' 42px',
	        'font-size44' 		=> ' 44px',
	        'font-size46' 		=> ' 46px', 
	        'font-size48' 		=> ' 48px', 
	        'font-size50' 		=> ' 50px',
	        'font-size52' 		=> ' 52px',
	        'font-size60' 		=> ' 60px',
	        'font-semibold' 	=> ' 600', 
	        'font-regular' 		=> ' 400', 
	        'font-bold' 		=> ' 700', 
	        'font-medium' 		=> ' 500', 
	        'font-black' 		=> ' 900',
	        'font-light' 		=> ' 300',  
	        'border-radius8' 	=> ' 8px',
	        'border-radius6' 	=> ' 6px',
	        'border-radius4' 	=> ' 4px',
	        'border-radius5' 	=> ' 5px',
	        'border-radius10' 	=> ' 10px',
	        'border-radius0' 	=> ' 0px',
	        'border-radius-round' => ' 50%',
	        'dashed-border' 	=> ' dashed',
	        'solid-border' 		=> ' solid',
        );
	}
}

DM_Frontend_Scripts::init();