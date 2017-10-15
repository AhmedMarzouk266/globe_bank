<?php
// in this page we will have an edit form, is is similar to the create form 
// we would like to have it as a single page form.

    // our funcitons:
require_once('../../../private/initialize.php');
// get number of rows:
   $admin_set = find_all_admins();
   $count = mysqli_num_rows($admin_set);
   $confirm_password="";
   
   
    // initial values for the form parameters: to display them while editing.

$id = isset($_GET['id']) ? $_GET['id'] : '0';

    // processing the form:

if(request_is_post()){
    
// first we get the data from the POST array:
    
   $first_name       = $_POST['first_name']?? '';
   $last_name        = $_POST['last_name'] ?? '';
   $email            = $_POST['email'] ?? '' ;
   $username         = $_POST['username'] ?? '' ;
   $password         = $_POST['password'] ?? '' ;
   $confirm_password = $_POST['confirm_password'] ?? '' ;
   

    
// editing the parameters: // better if to send array not 
    
$result = edit_admin_by_id($id,$first_name,$last_name,$email,$username,$password,$confirm_password);
    if($result === true){
        redirect_to("index.php");
    }else
     {
      $errors = $result ;
      //var_dump($errors);
    }
    
}else{
   // $admin=find_admin_by_id($id); // an assoc array         
} 
$admin=find_admin_by_id($id); // an assoc array       

?>

 <?php 
// header:
include (SHARED_PATH."/staff_header.php");
?>   
<!-- the form-->

<div id="content">
   <div class="page edit">
    <h1>Edit Admin</h1>
    <!-- display errors , make it in a function -->
           <?php  display_errors($errors);?>
    <h5>Number of Admins: <?php echo $count;?></h5>

    <form action="" method="post">
      <dl>
        <dt>First Name</dt>
        <dd><input type="text" name="first_name" value="<?php echo $admin['first_name'];?>" /></dd>
      </dl>
      <dl>
        <dt>Last Name</dt>
        <dd><input type="text" name="last_name" value="<?php echo $admin['last_name'];?>" /></dd>
      </dl>
      <dl>
        <dt>Email</dt>
        <dd><input type="text" name="email" value="<?php echo $admin['email'];?>" /></dd>
      </dl>
      <dl>
        <dt>Username</dt>
        <dd><input type="text" name="username" value="<?php echo $admin['username']?>;" /></dd>
      </dl>
      <dl>
        <dt>Password</dt>
        <dd><input type="text" name="password" value="<?php echo $admin['hashed_password']?>" /></dd>
      </dl>
      <dl>
        <dt>Confirm Password&nbsp;</dt>
        <dd><input type="text" name="confirm_password" value="<?php echo $confirm_password;?>" /></dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Edit Admin" />
      </div>
    </form>

  </div>
  
<?php mysqli_free_result($admin_set);?>
<?php include (SHARED_PATH."/staff_footer.php");?>

