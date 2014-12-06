<?php
/**
 * Zam Tests
 */
require_once('/home/wern/web_files/wordpress/wp-content/plugins/zam/zam.php'); //path to the main plugin file

class ZamTest extends WP_UnitTestCase{

	public $zam;
    public $plugin_slug = 'zam';
    public $options;


    public function setUp() {

    	$z = new Zam();
    	parent::setUp();

    	$z->installation_housekeeping();
    	update_option('zam_options', array(
    		'zam_twitter_id' => 'Wern_Ancheta'
    	));
    }


    public function tearDown() {

    }

    public function test_get_tweets(){

    	$z = new Zam();
    	
    	$tweets = $z->get_tweets();
    	$this->assertCount(11, $tweets);
    }

    
}
?>