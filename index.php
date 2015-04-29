<?php
/**
 * @package Endless Scroll
 */
/*
Plugin Name: Endless Scroll
Plugin URI: http://www.codycave.com/Plugins/endless-scroll/
Description: Endless scroll is plugin to scroll the content in a fixed height. It is very easy to use with a plugin option page to customize the properties of this plugin.
Version: 1.0.0
Author: Codycave
Author URI: http://codycave.com
License: GPLv2 or later
Text Domain: endless scroll
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/


//Load endlessScroll js
function endlessScroll_js(){
   wp_enqueue_script('endlessScroll-js', plugins_url('/js/enscroll.min.js',__FILE__), array('jquery'));
}
add_action('init', 'endlessScroll_js');


//Load endlessScroll style
function endlessScroll_css() 
{
    wp_enqueue_style( 'endless-css', plugins_url( '/css/endlessScroll.css', __FILE__ ) );
}

add_action('init', 'endlessScroll_css');





//Main function of endlessScroll
function endlessScroll($atts, $content = null) {
	extract(shortcode_atts(array(
      'height' => '300px',
 	), $atts));

	$value = '<div class="scrollbox" style="height:'.$height.'"><p>'.$content.'</p></div>';

	return $value;

}
add_shortcode('scroll', 'endlessScroll');


//Including Admin panel option page
include_once('admin/index.php');