<?php
/*
the widget for displaying related products
based on the product that's currently viewed
*/


class Zam_Tweets_Widget extends WP_Widget{

	public function __construct(){

		parent::__construct(
			'zam_tweets_widget', __('Zam Tweets Widget', 'zam'),
			array( 'description' => __('A widget for displaying tweets', 'zam'))
		);

	}

	public function form($instance){

		$title = __('', 'zam');
		$tweets_to_show_range = range(3, 11);
		$tweets_to_show = 3;

		if(isset($instance['title'])){
			$title = esc_attr($instance['title']);
		}

		if(isset($instance['tweets_to_show'])){
			$tweets_to_show = esc_attr($instance['tweets_to_show']);
		}
?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'zam') . ":"; ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('tweets_to_show'); ?>"><?php _e('Tweets to show', 'zam'); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id('tweets_to_show'); ?>" name="<?php echo $this->get_field_name('tweets_to_show'); ?>">
				<?php
				foreach($tweets_to_show_range as $num){
					$checked = '';
					if($num == $tweets_to_show){
						$checked = 'selected=true';
					}
				?>
				<option value="<?php echo $num; ?>" <?php echo $checked; ?>><?php echo $num; ?></option>
				<?php	
				}
				?>
			</select>
		</p>
<?php
	}

	public function update($new_instance, $old_instance) {

		$instance = array();
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['tweets_to_show'] = strip_tags($new_instance['tweets_to_show']);

		return $instance;
	}

	public function widget($args, $instance) {

		global $zam;

		extract($args);
		extract($instance);

		if(empty($title)){
			$title = __('Tweets', 'zam');
		}

			echo $before_widget;
			echo $before_title . __($title, 'zam') . $after_title;
			$tweets = $zam->get_tweets();
?>
			<div id="zam_tweets">
			<?php
			foreach($tweets as $index => $tweet){
			?>
				<li><?php echo $tweet; ?></li>
			<?php
				if($tweets_to_show == $index + 1){
					break;
				}	
			}
			?>
			</div>
<?php
				echo $after_widget;
	}
}
