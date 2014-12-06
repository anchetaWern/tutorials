<?php
/*
Plugin Name: Zam
Plugin URI: 
Version: 1.0
Author: Nrue
Description: 
*/
require_once('zam-options.php');
require_once('zam-tweets-widget.php');

class Zam{
	private $protocol;
	private $settings;
	private $twitter_id;

	public function __construct(){

		$this->protocol = is_SSL() ? 'https://' : 'http://';
		$this->settings = get_option('zam_options');
		$this->twitter_id = (!empty($this->settings['zam_twitter_id'])) ? $this->settings['zam_twitter_id'] : '';

		add_action('admin_init', function(){
			new Zam_Options();
		});

		add_action('admin_menu', array($this, 'zam_admin_init'));

		add_action('widgets_init', function(){
			register_widget('zam_tweets_widget');
		});

		add_action('save_post', array($this, 'save_tweet'));

		add_shortcode('zam_tweets', array($this, 'shortcode_to_tweet'));

		add_action('activate_zam/zam.php', array($this, 'installation_housekeeping'));
		
		register_uninstall_hook(__FILE__, array('Zam', 'uninstall_housekeeping'));
	
	}

	public function zam_admin_init(){
		Zam_Options::add_menu();
	}

	public function get_tweets(){
		
		require_once 'libs/twitteroauth/twitteroauth.php';

		//access the twitter API
		$twitterConnection = new TwitterOAuth(
		  'f4rQ3QIsshrq4lKEtN4dWw',  //consumer key
		  'JJucsiYamGuLVGGfYZDw9Uj5ipnNKkfWr3q4dUjis', //consumer secret
		  '283769265-pC9ZVicCgfodW9pzWocgq0Z4a0WiP9MjAYHEHQX2', //access token
		  'BM6kNo8ESEfBRSTgjvatA9EazQlEID5RM9uj7E2Jb8'  //access token secret
		);

		$twitterData = $twitterConnection->get(
		'statuses/user_timeline',
		array(
		  'screen_name'     => $this->twitter_id,
		  'count'           => '11',
		  'exclude_replies' => true //exclude replies to a specific twitter user
		)
		);

		$tweet_text = array();

		//if the request was successful
		if($twitterConnection->http_code == 200){ 
		  foreach($twitterData as $t){
		      
		      //wrap all the url's with anchor tags
		      $text = preg_replace(
		          "#((http|https|ftp)://(\S*?\.\S*?))(\s|\;|\)|\]|\[|\{|\}|,|\"|'|:|\<|$|\.\s)#ie",
		          "'<a href=\"$1\" target=\"_blank\">$3</a>$4'", $t->text
		      );

		      $tweet_text[] = $text;
		  }
		}

		return $tweet_text;
		
		die();
	}

	public function save_tweet($post_id){

		global $wpdb;
		
		$random_index = rand(0, 10);

		$post = get_post($post_id);
		$post_title = $post->post_title;
	  	$post_content = $post->post_content;
	  	$post_type = $post->post_type;

		if(!wp_is_post_revision($post_id) && $post_type == 'post'){

			$pattern = '/\[zam_tweets page=([0-9])\]/'; //the general pattern for the shortcode
			preg_match($pattern, $post_content, $matches);
			if(!empty($matches)){

				$page = $matches[1]; //extract the page from the matches returned

				$result = wp_remote_get($this->protocol . "api.twitter.com/1/statuses/user_timeline.json?screen_name=" . $this->twitter_id . "&count=11&exclude_replies=true&page=" . $page);

				$tweets = json_decode($result['body']);
				$tweet = strip_tags($tweets[$random_index]->text);

				$tweets_table = $wpdb->prefix . 'zam_tweets';

				$wpdb->query("SELECT id FROM $tweets_table WHERE post_id = '$post_id'");

				if($wpdb->num_rows == 0){
					$wpdb->insert($tweets_table, array('post_id' => $post_id, 'tweet' => $tweet));
				}


				
			}

		}

	}



	public function shortcode_to_tweet($attrs){
		
		global $wpdb;

		$post_id = get_the_ID();
		$post_content = get_the_content();

		$pattern = '/\[zam_tweets page=([0-9])\]/';
		preg_match($pattern, $post_content, $matches);

		if(!empty($matches)){

			$tweets_table = $wpdb->prefix . 'zam_tweets';
			$result = $wpdb->get_var("SELECT tweet FROM $tweets_table WHERE post_id = '$post_id'");
			$content = $result;
		}

		return $content;
	}


	public function installation_housekeeping(){

		global $wpdb;
		
		$tweets_table = $wpdb->prefix . 'zam_tweets';

		$tweets_sql = "CREATE TABLE $tweets_table (
		  id INT(10) NOT NULL AUTO_INCREMENT,
		  post_id BIGINT(20) NOT NULL,
	    tweet VARCHAR(160) NOT NULL,
			PRIMARY KEY id (id)
		);";

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';

		dbDelta($tweets_sql);
	}


	public static function uninstall_housekeeping(){
		global $wpdb;
		$tweets_table = $wpdb->prefix . 'zam_tweets';
		$wpdb->query("DROP TABLE $tweets_table");
		delete_option('zam_options');
	}


}

$GLOBALS['zam'] = new Zam();
?>