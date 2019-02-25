<?php 
/**
 *  @package   		Advanced Custom Fields Page Elements v2
 *  @author    		Wayne Glassbrook <wayne@bdesignly.net>
 *  @license   		GPL-2.0+
 *  @link      		http://www.designly.net
 *  @copyright 		2017 Wayne Glassbrook
 *
 *	Plugin Name:	Advanced Custom Fields Page Elements v2
 *	Plugin URI: 	http://www.designly.net
 *	Description:	Easily add pre-designed blocks of content to pages and posts with the ACF Flexible Content Field. Requires ACF PRO 5.6.X and theme built with Bootstrap. 
 *	Version:		2.1 Alpha
 *	Author:			Wayne Glassbrook
 *	Author URI:		http://www.designly.net
 *	License:		GPLv2
 *  License URI:    http://www.gnu.org/licenses/gpl-2.0.txt
 *  
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
};

global $user;
global $user_ID;


// Add Google Maps API Key
add_filter('acf/settings/google_api_key', function () {
    return 'AIzaSyDvxsF4TUob9hU_eca-AwMZtOYWuEISDVk';
});

// Include initialization functions
include('inc/_init.php');

// Include Unique ID Field
include('inc/_uniqueID.php');

// Include general functions
include('inc/_functions.php');

add_action('admin_notices', 'acfps2_messages');

function acfps2_messages()
{
	// Download the ACFPro plugin
	if(!is_plugin_active( 'advanced-custom-fields-pro/acf.php' ))
	{
		echo '<div id="message" class="error"><p><strong>Advanced Custom Fields Page Elements requires that you install and activate ACFPro, <a href="https://www.advancedcustomfields.com/pro/">download here</a>.</strong></p></div>';
	}
}

/*
	Copyright 2017 Wayne Glassbrook (email : wayne@designly.net)

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
	GNU General Public License for more details.
	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
*/
?>