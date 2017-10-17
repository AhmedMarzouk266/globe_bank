<?php
    // out buffering function:
    ob_start() ;
    session_start();

    // we have to define some contstants for the paths in our project
    // __FILE__ returns the directory of the current file.

    define("PRIVATE_PATH", dirname(__FILE__));
    define("PROJECT_PATH", dirname(PRIVATE_PATH)); // dirname returns the parent path
    define("PUBLIC_PATH", PROJECT_PATH . "/public"); // dirname => parent path => I need the path.
    define("SHARED_PATH", PRIVATE_PATH . "/shared");

// the project path for the url, for the href attribute:
    define("WWW_ROOT", "/lynda/my_php_site/public");
// this one we will use in the header ! th loading will be from the server not from the computer

// our code functions:
    require_once('functions.php');
// getting the Database functions:
    require_once('db_functions.php');
// getting the query functions:
    require_once('query_functions.php');
// validation functions:
    require_once('validation_functions.php');
// authentication functions:
    require_once('auth_functions.php');



//connect to the database
    $db = db_Connect();
    check_connection();
    $errors=[]; // make sure that there is always a defined value for errors.

// note that logging out from the database will be put in the footer ( at the end of the php script)!
?>