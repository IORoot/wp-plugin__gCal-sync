<?php
/*
Plugin Name: _ANDYP - GCal Sync
Plugin URI: http://londonparkour.com
Description: <em>Google calendar Sync</em>
Version: 1.0
Author: Andy Pearson
Author URI: http://londonparkour.com
*/

define( 'ANDYP_GCALSYNC_PATH', __DIR__ );
define( 'ANDYP_GCALSYNC_URL', plugins_url( '/', __FILE__ ) );
    
//  ┌─────────────────────────────────────────────────────────────────────────┐
//  │                    Register with ANDYP Plugins                          │
//  └─────────────────────────────────────────────────────────────────────────┘
require __DIR__.'/src/acf/andyp_plugin_register.php';

// ┌─────────────────────────────────────────────────────────────────────────┐
// │                         Use composer autoloader                         │
// └─────────────────────────────────────────────────────────────────────────┘
require __DIR__.'/vendor/autoload.php';

//  ┌─────────────────────────────────────────────────────────────────────────┐
//  │                              The Run Hook                               │
//  └─────────────────────────────────────────────────────────────────────────┘
new andyp\gcal\hooks\action_gcal_sync;

// ┌─────────────────────────────────────────────────────────────────────────┐
// │                        	   Initialise    		                     │
// └─────────────────────────────────────────────────────────────────────────┘
if (file_exists(ANDYP_GCALSYNC_PATH. '/credentials.json'))
{
    new andyp\gcal\initialise;
}