<?php
/**
 * Plugin Name: WordPress Python Plugin
 * Plugin URI: https://pluginsbay.com/plugin/wordpress-python-plugin
 * Description: A simple plugin that runs a specified .py file and outputs it as a shortcode
 * Version: 1.0.1
 * Author: Stefan Pejcic
 * Author URI: https://stefanpejcic.com
 * License: GPL3
 */
 add_shortcode( 'python', 'embed_python' );

function embed_python( $attributes )
{
    $data = shortcode_atts(
        [
            'file' => 'file.py'
        ],
        $attributes
    );

    $handle = popen( __DIR__ . '/' . $data['file'], 'r' );
    $read = '';

    while ( ! feof( $handle ) )
    {
        $read .= fread( $handle, 2096 );
    }

    pclose( $handle );

    return $read;
}
