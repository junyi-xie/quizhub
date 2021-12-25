<?php
/**
 * The base configuration for Quizhub.
 * 
 * In this file you can configurate:
 * 
 * - Error logs.
 * - Default timezone.
 * - MySQL settings.
 * - Folder directories.
 * - The absolute path.
 */

    
/* Display All Errors. True is on and false is off. */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

error_reporting(E_ALL);


/* Set Default Timezone. */
date_default_timezone_set('Europe/Amsterdam');


/**
 * MySQL settings to connect to the database for the website.
 * 
 * - Hostname, the hostname used for connecting to the database.
 * - Username, username used for the database connection. Most of the time it's just 'root'
 * - Password, the password associated with MySQL.
 * - Database, name of the database that needs to be connected to.
 * - Charset, the charset used to create new database tables.
 */

/* MySQL Hostname */
define('HOSTNAME', '127.0.0.1'); /* localhost works too */

/* MySQL Username */
define('USERNAME', 'root');

/* MySQL Password */
define('PASSWORD', '');

/* Database */
define('DBNAME', 'quizhub');

/* Charset */
define('CHARSET', 'utf8mb4');


/**
 * The folders for this project. Name can be changed or new folders can be added.
 * 
 * The following files are in these folders:
 * 
 * - Include, file that are generally used to include and are not part of the source folder.
 * - View, the layout for the website. In here are all the different templates that the website uses to render to the user.
 * - Source, in this folder the code for all functionalities are put; a variety of classes to handle the application to run.
 * - Assets, mainly files which are used to make the website pretty; css, js, font, and img.
 */

/* Include Folder */
define('INC', 'inc');

/* View Folder */
define('VIEW', 'view');

/* Source Folder */
define('SRC', 'src');

/* Assets Folder */
define('ASSETS', 'assets');


/* Absolute Base Path to this Project, Quizhub. Do not change. */
if ( !defined('PATH') ) {
    define('PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR);
}


/* Load default files for the system to function correctly. */
require_once PATH . INC . '/autoloader.php';
require_once PATH . INC . '/connect.php';
require_once PATH . INC . '/functions.php';