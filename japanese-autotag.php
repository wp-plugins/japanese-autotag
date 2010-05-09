<?php
/*
Plugin Name: Japanese Autotag
Version: 0.2.15
Description: Automatically inserts tags by post titles.
Author: Keisuke Oyama
Author URI: http://keicode.com/
Plugin URI: http://wordpress.org/extend/plugins/japanese-autotag/
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
	
	var $enabled;
	var $add_on_publish_post;
	var $add_on_save_post;
	var $parse_body;
	var $keyphrase_enabled;
	var $wc1;
	var $wc2;
	var $wc3;
	var $wc4;
	var $wc5;
	var $wc6;
	var $wc7;
	var $wc8;
	var $wc9;
	var $wc10;
	var $wc11;
	var $wc12;
	var $wc13;
	
	
	function JapaneseAutoTag() {
	
		$options = $this->get_options();
		
		$this->add_on_publish_post = $options['add_on_publish_post'];
		$this->add_on_save_post    = $options['add_on_save_post'];
		$this->enabled = $options['enabled'];
		$this->parse_body = $options['parse_body'];
		$this->keyphrase_enabled = $options['keyphrase_enabled'];
		$this->wc1 = $options['wc1'];
		$this->wc2 = $options['wc2'];
		$this->wc3 = $options['wc3'];
		$this->wc4 = $options['wc4'];
		$this->wc5 = $options['wc5'];
		$this->wc6 = $options['wc6'];
		$this->wc7 = $options['wc7'];
		$this->wc8 = $options['wc8'];
		$this->wc9 = $options['wc9'];
		$this->wc10 = $options['wc10'];
		$this->wc11 = $options['wc11'];
		$this->wc12 = $options['wc12'];
		$this->wc13 = $options['wc13'];
		
		add_action( 'save_post', array(&$this, 'on_save_post' ) );
		add_action( 'publish_post', array(&$this, 'on_publish_post') );
		add_action( 'admin_menu', array(&$this, 'admin_menu') );
		
	}

	
	function on_save_post( $post_id ) {
		
		if( $this->enabled === 'on' 
			&& $this->add_on_save_post === 'on' ){
			$this->insert_tags( $post_id );
		}
	
	}
	
	
	function on_publish_post( $post_id ) {
	
		if( $this->enabled === 'on'
			&& $this->add_on_publish_post === 'on' 
			&& $this->add_on_save_post === 'off' ){
			$this->insert_tags( $post_id );
		}
	
	}
		
		
	function install() {
	
		$this->get_options();
	
	}


	function get_options() {
	
		$options = array(
			'enabled' => 'on',
			'appkey' => '',
			'noiselist' => 'あれ|こと|これ|それ|ため|どれ|私|何',
			'expattern' => '',
			'add_on_publish_post' => 'on',
			'add_on_save_post' => 'off',
			'parse_body' => 'off',
			'keyphrase_enabled' => 'off',
			'wc1' => 'off',
			'wc2' => 'off',
			'wc3' => 'off',
			'wc4' => 'off',
			'wc5' => 'off',
			'wc6' => 'off',
			'wc7' => 'off',
			'wc8' => 'off',
			'wc9' => 'on',
			'wc10' => 'off',
			'wc11' => 'off',
			'wc12' => 'off',
			'wc13' => 'off'
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
			
			$options['enabled']
				= $this->enabled
				= ($_POST['enabled'] === 'on') ? 'on' : 'off';
			$options['appkey'] = htmlentities(trim($_POST['appkey']), ENT_QUOTES, 'UTF-8');
			$options['noiselist'] = htmlentities(trim($_POST['noiselist']), ENT_QUOTES, 'UTF-8');
			$options['expattern'] = trim($_POST['expattern']);
			$options['add_on_save_post'] 
				= $this->add_on_save_post
				= ($_POST['add_on_save_post'] === 'on') ? 'on' : 'off';
			$options['parse_body']
				= $this->parse_body
				= ($_POST['parse_body'] === 'on') ? 'on' : 'off';
			$options['keyphrase_enabled']
				= $this->keyphrase_enabled
				= ($_POST['keyphrase_enabled'] === 'on') ? 'on' : 'off';
				
			$options['wc1'] = $this->wc1 = ($_POST['wc1'] === 'on') ? 'on' : 'off';
			$options['wc2'] = $this->wc2 = ($_POST['wc2'] === 'on') ? 'on' : 'off';
			$options['wc3'] = $this->wc3 = ($_POST['wc3'] === 'on') ? 'on' : 'off';
			$options['wc4'] = $this->wc4 = ($_POST['wc4'] === 'on') ? 'on' : 'off';
			$options['wc5'] = $this->wc5 = ($_POST['wc5'] === 'on') ? 'on' : 'off';
			$options['wc6'] = $this->wc6 = ($_POST['wc6'] === 'on') ? 'on' : 'off';
			$options['wc7'] = $this->wc7 = ($_POST['wc7'] === 'on') ? 'on' : 'off';
			$options['wc8'] = $this->wc8 = ($_POST['wc8'] === 'on') ? 'on' : 'off';
			$options['wc9'] = $this->wc9 = ($_POST['wc9'] === 'on') ? 'on' : 'off';
			$options['wc10'] = $this->wc10 = ($_POST['wc10'] === 'on') ? 'on' : 'off';
			$options['wc11'] = $this->wc11 = ($_POST['wc11'] === 'on') ? 'on' : 'off';
			$options['wc12'] = $this->wc12 = ($_POST['wc12'] === 'on') ? 'on' : 'off';
			$options['wc13'] = $this->wc13 = ($_POST['wc13'] === 'on') ? 'on' : 'off';
			
			update_option( $this->db_option, $options );
			
			if ( $options['appkey'] == '' || $this->validate_key( $options['appkey'] ) ) {
				echo '<div class="updated fade">Plugin settings saved.</div>';
			}
			else {
				echo '<div class="error">The key seems invalid. Please make sure you entered a valid application key.</div>';
			}
			
		
		}
		
		$appkey = $options['appkey'];
		$noiselist = $options['noiselist'];
		$expattern = str_replace('\\\\', '\\', $options['expattern']);
		$add_on_save_post = $options['add_on_save_post'];
		$enabled = $options['enabled'];
		$action_url = $_SERVER['REQUEST_URI'];
		$parse_body = $options['parse_body'];
		$wc1 = $options['wc1'];
		$wc2 = $options['wc2'];
		$wc3 = $options['wc3'];
		$wc4 = $options['wc4'];
		$wc5 = $options['wc5'];
		$wc6 = $options['wc6'];
		$wc7 = $options['wc7'];
		$wc8 = $options['wc8'];
		$wc9 = $options['wc9'];
		$wc10 = $options['wc10'];
		$wc11 = $options['wc11'];
		$wc12 = $options['wc12'];
		$wc13 = $options['wc13'];
		$keyphrase_enabled = $options['keyphrase_enabled'];
		
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
	
	
	function get_word_array( $appkey, $sentence, $filter = '9', $exwords = array(), $expattern = '' ) {

		$expattern = trim( $expattern );
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
				
				if( in_array($w->surface, $exwords) ) {
					continue;
				}

				if( $expattern != '' && @preg_match( $expattern, $w->surface) ) {
					continue;
				}
				
				$result[] = $w->surface;
						
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
				
				if( in_array($t, $exwords) ) {
					continue;
				}
				
				if( $expattern != '' && @preg_match( $expattern, $t ) ) {
					continue;
				}
				
				$result[] = $t;
			}
		}
		
		return array_unique($result);
	
	}
	
	
	function get_keyphrase_array( $appkey, $sentence, $exwords = array(), $expattern = '' ) {

		$expattern = trim( $expattern );
		$result = array();
		
		$url = 'http://jlp.yahooapis.jp/KeyphraseService/V1/extract?' 
			. 'appid=' . $appkey 
			. '&results=xml&sentence=' 
			. urlencode($sentence);			

		$c = @file_get_contents( $url );
		
		if( function_exists('simplexml_load_string') ) { // PHP5 or later

			$xml = simplexml_load_string ( $c );

			if($xml === false) {
				return $result;
			}

			foreach($xml->Result as $w) {
				
				if( in_array($w->Keyphrase, $exwords) ) {
					continue;
				}

				if( $expattern != '' && @preg_match( $expattern, $w->Keyphrase) ) {
					continue;
				}
				
				$result[] = $w->Keyphrase;
						
			}
		
		}
		else { // PHP4
		
			$dom = domxml_open_mem ( $c );
			
			if(!$dom) {
				return $result;
			}
			
			$wa = $dom->get_elements_by_tagname('Keyphrase');
			
			for($i=0; $i<count($wa); $i++) {

				$t = $wa[$i]->get_content();				
				
				if( in_array($t, $exwords) ) {
					continue;
				}
				
				if( $expattern != '' && @preg_match( $expattern, $t ) ) {
					continue;
				}
				
				$result[] = $t;
			}
		}
		
		return array_unique($result);
	
	} 
	
	
	function get_tags( $post_id ) {
			
		$options = $this->get_options();
		
		if( !$options['appkey'] ) {
			return null;
		}
		
		$noise = explode('|', $options['noiselist']);
				
		$p = get_post( $post_id );
		
		$t = $p->post_title;
		
		if( $this->parse_body === 'on' ){
			$t .= ' ' . strip_tags($p->post_content); 
		}
		
		$wordclasses = $this->get_word_class( $options );
		
		// Tokenize		
		return ( $this->keyphrase_enabled  === 'on' ?
			$this->get_keyphrase_array(
				$options['appkey'], 
				$t,
				$noise,
				str_replace('\\\\', '\\', $options['expattern']) )
			:
			$this->get_word_array(
				$options['appkey'], 
				$t,
				$wordclasses,
				$noise,
				str_replace('\\\\', '\\', $options['expattern']) )
		
		);
	
	}
	
	
	function get_word_class( $options ){
	
		$wc = '';
		
		for($i=1; $i<=13; $i++){
		
			if( $options['wc'.$i] != 'on' ){
				continue;
			}
			
			$wc .= ($wc ? '|' : '') . $i;
		
		}
	
		return $wc;
		
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