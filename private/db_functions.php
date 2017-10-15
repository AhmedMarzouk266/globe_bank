<?php
    // here we will store all our functions related to the database.
// the credintials:

require_once('db_credentianls.php');

    function db_connect(){
        $connection=mysqli_connect(DB_SEVER,DB_USER,DB_PASS,DB_NAME);
        return $connection;
    }
    

    function db_disconnect($connection){
        if(isset($connection)){
            mysqli_close($connection);
        }
        
    }

// make sure if the connection is successful:

    function check_connection(){
        
        if(mysqli_connect_errno()){ // if i got back anything from this function.
            $msg="Error Connecting to the Database... <br>";
            $msg .= mysqli_connect_error();
            $msg .="(".mysqli_connect_errno().")";
            exit($msg);
        }
    }


function db_escape($string){
    global $db ;
    $result = mysqli_real_escape_string($db,$string);
    return $result ;
    
}



?>