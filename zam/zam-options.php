<?php
class Zam_Options{

	private $options;
	
	public function __construct(){

		$this->options = get_option('zam_options');
		$this->register_settings_and_fields();
	}

	public static function add_menu(){

		add_menu_page(__('Zam', 'zam'), __('zam', 'zam'), 'manage_options', 'zam-options', array( 'zam_options', 'display_fields' ));

  		add_submenu_page('zam-options', __('Settings', 'zam'), __('Settings', 'zam'), 'manage_options', 'zam-options', array( 'zam_options', 'display_fields' ));
	}

	public function register_settings_and_fields(){
		
		register_setting('zam_options', 'zam_options');
		add_settings_section('zam_options_main', __('Main Settings', 'zam'), array($this, 'zam_options_create'), __FILE__);
		
		$this->create_fields(
			__FILE__,
			$this,
			'zam_options_main',
			array(
				array(
					'id' => 'zam_twitter_id',
					'label' => __('Twitter ID' , 'zam'),
					'function' => 'display_twitter_id'
				)
			)
		);
	}

	public function zam_options_create() {

	}

	public function create_fields($file, $class, $section_id, $field_data){
		foreach($field_data as $field){

			add_settings_field($field['id'], $field['label'], array($class, $field['function']), $file, $section_id);
		}
	}


	public static function display_fields(){
?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2><?php _e('Zam Settings', 'zam'); ?></h2>
		<form action="options.php" method="post" id="zam_settings_forms" data-validate="parsley">
			<?php settings_fields('zam_options'); ?>
			<table class="form-table">
				<?php do_settings_sections( __FILE__ ); ?>
			</table>
			<p class="submit">
				<input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes">
			</p>
	</div>
<?php		
	}

	public function display_twitter_id(){
		$zam_twitter_id = (!empty($this->options['zam_twitter_id'])) ? $this->options['zam_twitter_id'] : '';
		echo "<input type='text' name='zam_options[zam_twitter_id]' class='regular-text' id='zam_twitter_id'  value='{$zam_twitter_id}'/>";
	}
}