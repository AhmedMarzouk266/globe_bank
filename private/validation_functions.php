<?php
    // the validations we need:
//1- presense:

function is_blank($string){
  return (!isset($string) || trim($string)==="") ; 
} // it returns true if there is no value. if it is blank.

function has_presense($string){
    return !is_blank($string); 
} // returns true if there is a value.

//2- length:

    // greater than :
function has_length_greater_than($string,$min){
   $length = strlen($string);
    return $length > $min ;
}
    // less than :
function has_length_less_than($string,$max){
   $length = strlen($string);
    return $length < $max ;
}

    // exact :
function has_length_exact($string,$exact){
   $length = strlen($string);
    return $length == $exact ;
}

// we can have a function that takes options {assoc array} :
    // example of data recieved : ('abcd',options['min'=>3,'max'=>5])


//3- type:


//4- inclusion :

// has inclusion of :
function has_inclusion_of($string , $set){
    return in_array($string, $set);
}

// exclusion of :
function has_exclusion_of($string, $set){
    return !in_array($string, $set);
}

// required string inside the input.

function has_string ($string, $required_string){
   return strpos($string, $required_string) !== FALSE ; //(we used !== to prevent pos 0 from being false)
}

// 5- Format:

 // * format: [chars]@[chars].[2+ letters]
  // * preg_match is helpful, uses a regular expression
  //    returns 1 for a match, 0 for no match
function has_valid_email_format($email){
     $email_regex = '/\A[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\Z/i';
     return preg_match($email_regex, $email) === 1; // true if has the valid format.
}

// uniqeness:
    // if the user entered a name that is in my data base.

function has_unique_page_menu_name($menu_name,$current_id){
    $flag = true;
    $page_set = find_all_pages();
    while($page = mysqli_fetch_assoc($page_set)){
        if(trim($page['menu_name'])==trim($menu_name) && trim($page['id']) != trim($current_id)){
            // if you found it in our data base   
            $flag = false ;
        }
    }
    return $flag;
}

function has_unique_admin_username($username,$current_id){
    $flag = true;
    $admin_set = find_all_admins();
    while($admin = mysqli_fetch_assoc($admin_set)){
        if(trim($admin['username'])==trim($username) && trim($admin['id']) != trim($current_id)){
            // if you found it in our data base   
            $flag = false ;
        }
    }
    return $flag;
}




?>