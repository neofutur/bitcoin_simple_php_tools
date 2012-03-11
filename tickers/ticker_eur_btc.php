<?php

/*
Plugin Name: Bitcoin WordPress
Description: Add bitcoin stuff to your WordPress blog
Author: Fordy
Version: 1.0
Revision Date: February 18, 2012
Requires at least: WP 3.2.1, PHP 5.3
Tested up to: WP 3.4, PHP 5.3.6
*/

getBitcoinPrice();

function getBitcoinPrice() {
			 // Fetch the current rate from MtGox
			$ch = curl_init('https://mtgox.com/api/0/data/ticker.php?Currency=EUR');
			curl_setopt($ch, CURLOPT_REFERER, 'Mozilla/5.0 (compatible; MtGox PHP client; '.php_uname('s').'; PHP/'.phpversion().')');
			curl_setopt($ch, CURLOPT_USERAGENT, "CakeScript/0.1");
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	    		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			$mtgoxjson = curl_exec($ch);
			curl_close($ch);
               
			// Decode from an object to array
			$output_mtgox = json_decode($mtgoxjson);
			$output_mtgox_1 = get_object_vars($output_mtgox);
			$mtgox_array = get_object_vars($output_mtgox_1['ticker']);
			
			?>

					<ul>
					<li><strong>Last:</strong>&nbsp;&nbsp;<?php echo $mtgox_array['last'];   ?></li>
					<li><strong>High:</strong>&nbsp;<?php echo $mtgox_array['high'];   ?></li>
					<li><strong>Low:</strong>&nbsp;&nbsp;<?php echo $mtgox_array['low'];   ?></li>
					<li><strong>Avg:</strong>&nbsp;&nbsp;&nbsp;<?php echo $mtgox_array['avg'];   ?></li>
					<li><strong>Vol:</strong>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $mtgox_array['vol'];   ?></li>
					</ul>
			<?php
}
 
	class bitcoin_widget {
 
	// Constructor //
    
		function bitcoin_widget() {
			$widget_ops = array( 'classname' => 'bitcoin_widget', 'description' => 'Show some bitcoin stuff' ); // Widget Settings
			$control_ops = array( 'id_base' => 'bitcoin_widget' ); // Widget Control Settings
			$this->WP_Widget( 'bitcoin_widget', 'Bitcoins!', $widget_ops, $control_ops ); // Create the widget
		}

	// Extract Args //

		function widget($args, $instance) {
			extract( $args );
			
			$title 		= apply_filters('widget_title', $instance['title']); // The widget title
			$show_price	= isset($instance['show_price']) ? $instance['show_price'] : false; // Show the Bitcoin price
			$donate		= isset($instance['donate_bitcoins']) ? $instance['donate_bitcoins'] : false; // Get some bitcoins for your blog
			$donation_address	= isset($instance['donation_address']) ? $instance['donation_address'] : false; // Donation address

	// Before widget //
		
			echo $before_widget;
		
	// Title of widget //
		
			if ( $title ) { echo $before_title . $title . $after_title; }
		
	// Widget output //
			?>
			
		
			<?php 
			
			if ($show_price){
					getBitcoinPrice();
			 }
			if ($donate) { ?>
			<p style="font-size:10px;">
				Send me some Bitcoins! <?php echo $donation_address; ?>
			</p>
			<?php }
				
	// After widget //
		
			echo $after_widget;
		}
		
	// Update Settings //
 
		function update($new_instance, $old_instance) {
		    	
			$instance['title']		    = strip_tags($new_instance['title']);
			$instance['show_price']	    = $new_instance['show_price'];
			$instance['donate_bitcoins']	    = $new_instance['donate_bitcoins'];
			$instance['donation_address']	    = $new_instance['donation_address'];
			return $instance;
		}
 
	// Widget Control Panel //
	
		function form($instance) {

		$defaults = array( 'title' => 'Bitcoins!', 'show_price' => 'on', 'donate_bitcoins' => 'on', 'donation_address' => 'xxx'  );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>'" type="text" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('show_price'); ?>"><?php _e('Show the Bitcoin price?'); ?></label>
			<input type="checkbox" class="checkbox" <?php checked( $instance['show_price'], 'on' ); ?> id="<?php echo $this->get_field_id('show_price'); ?>" name="<?php echo $this->get_field_name('show_price'); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('donate_bitcoins'); ?>"><?php _e('Add a bitcoin donation address?'); ?></label>
			<input type="checkbox" class="checkbox" <?php checked( $instance['donate_bitcoins'], 'on' ); ?> id="<?php echo $this->get_field_id('donate_bitcoins'); ?>" name="<?php echo $this->get_field_name('donate_bitcoins'); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('donation_address'); ?>"><?php _e('Donation Address:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('donation_address'); ?>" name="<?php echo $this->get_field_name('donation_address'); ?>" type="text" value="<?php echo $instance['donation_address']; ?>" />
		</p>
        <?php }
 
}

// End class bitcoin_widget
//add_action('widgets_init', create_function('', 'return register_widget("bitcoin_widget");'));
?>

