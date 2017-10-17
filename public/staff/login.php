<?php require_once("../../private/initialize.php"); ?>

<?php
    if(request_is_post()){
        
        
    $user_name = $_POST['username'] ?? '' ;
    $password  = $_POST['password'] ?? '' ;
        
        // verify username and password:
//1- we need a function that gets the admin with the username instead of the id. to check if it exists.
        $lon_in_error="Log in not successfull..";
        $admin = find_admin_by_username($user_name);
        
        if($admin){
            // if found admin so check the password.
            if(password_verify($password,$admin['hashed_password'])){
                // if true call the login function and redirect and store a session message
                admin_log_in($admin);
                $_SESSION['status_message']="Admin Logged In Successfully..";
                redirect_to('index.php');
            }
            else{ // if not :
                $errors[] = $lon_in_error ;
            }
        }
        else{
            // did not find the admin: error msg
                $errors[] = $lon_in_error ;
        }
 
    
        
        
    }
?>
<?php include (SHARED_PATH."/staff_header.php");?>

<div id="content">
  
   <br>
   <?php  display_errors($errors);?>
   <h1>Log In Page</h1>
   <br>
   <form action="login.php" method="post">
         <input type="text" name="username" placeholder="UserName..">&emsp;
         <input type="password" name="password" placeholder="PassWord.."><br><br>
       <input type="submit" value="Log In">
   </form>
    
</div>


<?php include (SHARED_PATH."/staff_footer.php");?>
