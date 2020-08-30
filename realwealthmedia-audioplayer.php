<?php
/*
  Plugin Name: <em>Real</em> Wealth<sup>&reg;</sup> Media Audio Player
  Plugin URI:  https://github.com/8ctopotamus/rwm-audioplayer-wp
  Description: Embed the <em>Real</em> Wealth<sup>&reg;</sup> Media Audio Player on your site!
  Version:     1.0
  Author:      Zylo, LLC
  Author URI:  https://zylocod.es
  License:     GPL2
  License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

// Register all scripts and styles.
function rwm_audioplayer_styles_scripts() {
	wp_register_style('rwm-audioplayer-styles', '//realwealthmediahttpspullzone-realwealthradiol.netdna-ssl.com/embeds/podcastplayer/v1/app.css');
  wp_register_script('rwm-audioplayer-js', '//realwealthmediahttpspullzone-realwealthradiol.netdna-ssl.com/embeds/podcastplayer/v1/app.js', '', '', true );
  wp_register_script('rwm-detect-ie-js', '//realwealthmediahttpspullzone-realwealthradiol.netdna-ssl.com/embeds/podcastplayer/v1/detect-ie.js', '', '', true );
}
add_action('wp_loaded', 'rwm_audioplayer_styles_scripts' );


// add preload links to <head>
function rwm_audioplayer_preload_links() { ?>
  <link as="style" href="//realwealthmediahttpspullzone-realwealthradiol.netdna-ssl.com/embeds/podcastplayer/v1/app.css" rel="preload" />
  <link as="script" href="//realwealthmediahttpspullzone-realwealthradiol.netdna-ssl.com/embeds/podcastplayer/v1/app.js" rel="preload" />
<?php }
add_action('wp_head', 'rwm_audioplayer_preload_links');


// shortcode
function rwm_audioplayer_shortcode_func( $atts ) {
  if (empty($atts['slug'])) {
    return 'You need to add your slug to render the audioplayer. Please see <a href="https://realwealthmarketing.com/podcast-player/" target="_blank">https//realwealthmarketing.com/podcast-player</a> for instructions.';
  }
	wp_enqueue_style('rwm-audioplayer-styles');
  wp_enqueue_script('rwm-audioplayer-js');
  wp_enqueue_script('rwm-detect-ie-js');
	$booleanOptions = '';
  $booleanOptions .= !empty($atts['autoplay']) ? 'data-autoplay ' : '';
  $booleanOptions .= !empty($atts['playlist']) ? 'data-playlist ' : '';
  $booleanOptions .= !empty($atts['rwmlink']) ? 'data-rwmlink ' : '';
	
	return '<div id="rw-player" data-slug="'.$atts['slug'].'" data-color="'.$atts['color'].'" '.$booleanOptions.'></div>';
}
add_shortcode( 'rwm-audioplayer', 'rwm_audioplayer_shortcode_func' );

?>
