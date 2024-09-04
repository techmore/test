<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * ---------------------------------------------------------------------
 * --------------- DATABASE CONNECTIVITY SETTINGS ----------------------
 * ---------------------------------------------------------------------
 *
 * These are the settings needed to access your database.
 * For complete instructions please consult comments in the 'database.php' file under the config directory
 *
 */

$config['db']['hostname']           = 'localhost';
$config['db']['username']           = 'u_eop5';
$config['db']['password']           = 'Synergy2015!';
$config['db']['database']           = 'eop7_db1';
$config['db']['dbdriver']           = 'mysqli';
$config['db']['sess_expiration']    = 3600;

if($config['db']['username'] && $config['db']['password']){
    $CI = get_instance();
    $CI->load->database($config['db']);
}