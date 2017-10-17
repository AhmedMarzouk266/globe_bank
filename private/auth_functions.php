<?php
// a function that performs all needed actions to admin login:

function admin_log_in($admin){ // assoc. array
        // protect from session fixation:
        session_regenerate_id();
        // storing id and username and also the last login time in sessions:
        $_SESSION['admin_id']= $admin['id'];
        $_SESSION['username']= $admin['username'];
        $_SESSION['last_login']= time();
        
        return true;
    }

function admin_log_out(){
    unset($_SESSION['admin_id']);
    unset($_SESSION['username']);
    unset($_SESSION['last_login']);
    
    return true;
}


// i will add a couple of functions to ask for authrization:
    //1- is the user looged in ? 

function is_logged_in(){
    // here i check just for the session var.
    return isset($_SESSION['admin_id']);  // true/false.
}

function require_login(){
    // here i will check if the user is logged in so continue if not redirect to log in page.
    if(!is_logged_in()){
        redirect_to(WWW_ROOT.'/staff/login.php');
    }else{
        // do nothing make the page procced
    }
}
?>