<?php
/*
Plugin Name: Japanese Autotag
Version: 0.2.5
Description: Automatically inserts tags by post titles.
Author: Keisuke Oyama
Author URI: http://keicode.com/
Plugin URI: http://keicode.com/net/wordpress-plugin-japanese-autotag.php
*/

// Version Check

global $wp_version;

$exit_msg = 'Japanese Autotag requires WordPress 2.8.4 or newer.';

if( version_compare($wp_version, "2.8.4", "<") ) {
	exit( $exit_msg );
}

// Define Plugin Class

if( !class_exists( 'JapaneseAutoTag' ) ) :

class JapaneseAutoTag {

	var $db_option = 'JapaneseAutoTag_Options';
	
	
	function JapaneseAutoTag() {
				
		add_action( 'publish_post', array(&$this, 'insert_tags') );
		add_action( 'admin_menu', array(&$this, 'admin_menu') );
		
	}
		
		
	function install() {
	
		$this->get_options();
	
	}


	function get_options() {
	
		$options = array(
			'appkey' => '',
			'noiselist' => 'あれ|こと|これ|それ|ため|どれ|私|何'
		);
		
		$saved = get_option( $this->db_option );
		
		if( !empty($saved) ) {
			foreach( $saved as $key => $option ) {
				$options[ $key ] = $option;
			}
		}
		
		if( $saved != $options ) {
		
			update_option( $this->db_option, $options );

		}
		
		return $options;
	
	}

	
	function handle_options() {
	
		$options = $this->get_options();
		
		if( isset($_POST['_submitted']) ) {
		
			check_admin_referer( 'japanese-autotag-nonce' );
			
			$options = array();
						
			$options['appkey'] = htmlentities(trim($_POST['appkey']), ENT_QUOTES, 'UTF-8');
			$options['noiselist'] = htmlentities(trim($_POST['noiselist']), ENT_QUOTES, 'UTF-8');
			
			if ( $options['appkey'] == '' || $this->validate_key( $options['appkey'] ) ) {
				update_option( $this->db_option, $options );
				echo '<div class="updated fade">Plugin settings saved.</div>';
			}
			else {
				$options['appkey'] = '';
				echo '<div class="error">The key seems invalid. Please make sure you entered a valid application key.</div>';
			}
			
		
		}
		
		$appkey = $options['appkey'];
		$noiselist = $options['noiselist'];
		
		$action_url = $_SERVER['REQUEST_URI'];
		
		include ( 'japanese-autotag-options.php' );
	
	}
	
	
	function insert_tags( $post_id ) {

		$taxonomy = 'post_tag';
		$tags = $this->get_tags( $post_id );
	
		if( !$tags || 0 == count($tags) ) {
			return;
		}
				
		foreach( $tags as $t ) {
			
			$t = trim($t);
			
			$check = is_term( $t, $taxonomy );
			
			if( is_null($check) ) {
				
				wp_insert_term( $t, $taxonomy );
		
			}
			
		}
		
		wp_set_post_tags( $post_id, $tags, true );
				
	}
	
	
	function validate_key ($key) {
	
		$wa = $this->get_word_array( $key, 'test' );
		return ( count($wa) > 0 );		

	}
	
	
	function get_word_array( $appkey, $sentence, $filter = '9', $exwords = array() ) {

		$result = array();
			
		$url = 'http://jlp.yahooapis.jp/MAService/V1/parse?filter=' 
			. $filter . '&appid=' 
			. $appkey . '&results=ma&sentence=' 
			. urlencode($sentence);

		$c = @file_get_contents( $url );
		
		if( function_exists('simplexml_load_string') ) { // PHP5 or later

			$xml = simplexml_load_string ( $c );

			if($xml === false) {
				return $result;
			}

			foreach($xml->ma_result->word_list->word as $w) {
				if( !in_array($w->surface, $exwords) ) {
					$result[] = $w->surface;
				}		
			}
		
		}
		else { // PHP4
		
			$dom = domxml_open_mem ( $c );
			
			if(!$dom) {
				return $result;
			}
			
			$wa = $dom->get_elements_by_tagname('surface');
			
			for($i=0; $i<count($wa); $i++) {
				$t = $wa[$i]->get_content();				
				
				if( !in_array($t, $exwords) ) {
					$result[] = $t;
				}
			}
		}
		
		return $result;
	
	} 
	
	
	function get_tags( $post_id ) {
			
		$options = $this->get_options();
		
		if( !$options['appkey'] ) {
			return null;
		}
		
		$noise = explode('|', $options['noiselist']);
				
		$p = get_post( $post_id );
		
		// Tokenize		
		return $this->get_word_array(
			$options['appkey'], 
			$p->post_title,
			'9',
			$noise );
	
	}
	

	function admin_menu() {
	
		add_options_page( 
			'Japanese AutoTag Options', 
			'Japanese AutoTag', 
			8, 
			basename(__FILE__), 
			array(&$this, 'handle_options'));
	
	}
}

else :

	exit('JapaneseAutoTag class arelady registered.');
	
endif;

// Register Activation Hook

$JapaneseAutoTag = new JapaneseAutoTag();

if( isset($JapaneseAutoTag) ) {

	register_activation_hook( __FILE__, array( &$JapaneseAutoTag, 'install' ) );
	
}

?>