<?php
    function check(){
        echo "Functions.php has been successfully loaded...";
    } ;
	
	function u($string=""){
		return urlencode($string);
	};
	
	function raw_u($string=""){
		return rawurlencode($string);
	};
	
	function h($string =""){
		return htmlspecialchars($string);
	}

// error functions : 

    function error_404(){
        header($_SERVER['SERVER_PROTOCOL']."404 NOT FOUND");
        exit();
    }

    function error_500(){
        header($_SERVER["SERVER_PROTOCOL"]."500 INTERNAL ERROR");
        exit();
    }

//function for redirection:
    function redirect_to($location){
        header("Location: ". $location);
    }

// if the form has been submitted, if the request is post

function request_is_post(){
    return $_SERVER['REQUEST_METHOD']=='POST' ;
}

function request_is_get(){
    return $_SERVER['REQUEST_METHOD']=='GET' ;
}

// validate subject:

function validate_subject($menu_name,$position,$visible){
    $errors= []; // made array of errors (list) 
    
// menu name : if there is a value and if its greater than 2 letters.
    if (!has_presense($menu_name)){
        $errors['menu_name']="The name should have a value..";
    }
    elseif (!has_length_greater_than($menu_name,2))
    {
        $errors['menu_name']="Name should be more than 2 letters..";
    }
    
// for the position: to be between 1 and 999:
    
    $position_int = (int) $position ; // to make sure that I am dealing with integer.
    if(!has_length_greater_than($position,0)){
        $errors['position']="Position should be between 0 and 999.";
    }
    
    return $errors;
    
}


// page validation:

function validate_page($menu_name,$position,$visible,$content,$id){
    $errors= []; // made array of errors (list) 
    
// menu name : if there is a value and if its greater than 2 letters.
    if (!has_presense($menu_name)){
        $errors['menu_name']="The name should have a value..";
    }
    elseif (!has_length_greater_than($menu_name,2))
    {
        $errors['menu_name']="Name should be more than 2 letters..";
    }
    else if(!has_unique_page_menu_name($menu_name,$id)){
        $errors['menu_name']="Sorry this menu_name has already been used..";
    }
    
    
// for the position: to be between 1 and 999:
    
    $position_int = (int) $position ; // to make sure that I am dealing with integer.
    if(!has_length_greater_than($position,0)){
        $errors['position']="Position should be between 0 and 999.";
    }
    
    
    return $errors;
}

// admin validations:
function validate_admin($first_name,$last_name,$email,$username,$password,$confirm_password,$id){
    $errors = [];
        // first name : more than 2 letters.not blank.
    if (!has_presense($first_name)){
        $errors['first_name']="First Name should have a value..";
    }
    elseif (!has_length_greater_than($first_name,2))
    {
        $errors['first_name']="First Name should be more than 2 letters..";
    }
    
        // Last name : more than 2 letters.not blank.
    if (!has_presense($last_name)){
        $errors['last_name']="Last Name should have a value..";
    }
    elseif (!has_length_greater_than($last_name,2))
    {
        $errors['last_name']="Last Name should be more than 2 letters..";
    }
    
        // Email Format.
    if(!has_valid_email_format($email)){
        $errors['email']="Email has the Wrong Format..";
    }
        
        // username: not blank , more than 2 letters and uniqe.
    // not blank 
    if(!has_presense($username)){
        $errors['username']= "Username can not be blank..";
    }
    // more than 2 letters:
    elseif(!has_length_greater_than($username,2)){
        $errors['username']="Username should be more than 2 letters..";
    }
    //unique.
    elseif(!has_unique_admin_username($username,$id)){
         $errors['username']="Sorry this Username has already been used..";
    }
    
        //password: more than 12 chars, has one uppercase one lower case and a number and sympol,matches !
    // 12 chars
    if(!has_length_greater_than($password,12)){
        $errors['password']="Sorry this Password isn't Strong enough..";
    }
    // has one uper case:
    $uppercase = preg_match('@[A-Z]@',$password);
    $lowercase = preg_match('@[a-z]@',$password);
    $numbers   = preg_match('@[0-9]@',$password);
    $symbols   = preg_match('/[^A-Za-z0-9\s]/',$password); // something exept these
    if(!$uppercase || !$lowercase || !$numbers || !$symbols){ // if any of them are false so give an error 
        $errors['password']="Password should have at least one Upercase, One lowercase and one number..";
    }
   // matches confirm_password:
    if($password !== $confirm_password){
        $errors['password']= "Password does not match..";
    }
    
   return $errors;
}

// display errors :

function display_errors($errors){
 
if(!empty($errors)){
    echo "<div class='errors'> please fix these ERRORS..<br/>";
    foreach($errors as $error){
        echo  "<ul> <li> ".$error."</li> </ul>";
     }
    echo "</div>";
}
    
}






?>