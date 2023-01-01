<?php

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the frameworks
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @link: https://codeigniter4.github.io/CodeIgniter4/
 */

/*
|--------------------------------------------------------------------------
| Helper functions
|--------------------------------------------------------------------------
*/

/**
 * Dump variable.
 */
if (!function_exists('d')) {

    function d()
    {
        call_user_func_array('dump', func_get_args());
    }
}

/**
 * Dump variables and die.
 */
if (!function_exists('dd')) {

    function dd()
    {
        call_user_func_array('dump', func_get_args());
        die();
    }
}

/**
 * GST Array.
 */
define('GST', ['5.00' => 'GST - 5%', '12.00' => 'GST - 12%', '18.00' => 'GST - 18%', '28.00' => 'GST - 28%']);
