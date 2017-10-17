<?php
// in this page we will have an edit form, is is similar to the create form 
// we would like to have it as a single page form.

    // our funcitons:
require_once('../../../private/initialize.php');
  require_login();

  $allowed = super_admin_logged_in();
    if(!$allowed){
        redirect_to(WWW_ROOT.'/not_allowed.php');
    }
  
// get number of rows:
   $admin_set = find_all_admins();
   $count = mysqli_num_rows($admin_set);
   $confirm_password="";
   
   
    // initial values for the form parameters: to display them while editing.

$admin = [];

$admin['id'] = isset($_GET['id']) ? $_GET['id'] : '0';

    // processing the form:

if(request_is_post()){
    
// first we get the data from the POST array:
    
   $admin['first_name']       = $_POST['first_name'] ?? '';
   $admin['last_name']        = $_POST['last_name'] ?? '';
   $admin['email']            = $_POST['email'] ?? '' ;
   $admin['username']         = $_POST['username'] ?? '' ;
   $admin['super_admin']      = $_POST['super_admin'] ?? '' ;
   $admin['password']         = $_POST['password'] ?? '' ;
   $admin['confirm_password'] = $_POST['confirm_password'] ?? '' ;

   

    
// editing the parameters: // better if to send array not 
    
$result = edit_admin_by_id($admin);
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

$admin = find_admin_by_id($admin['id']); // an assoc array       

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
        <dd><input type="text" name="username" value="<?php echo $admin['username'];?>" /></dd>
      </dl>
      <dl>
        <dt>Super Admin</dt>
        <dd>
          <input type="hidden" name="super_admin" value="0" />
          <input type="checkbox" name="super_admin" value="1" <?php if($admin['super_admin']==1){echo "checked";}?> />        
        </dd><br>
        <p> Super Admin Can Edit Other Admins..</p>
      </dl>
      <dl>
        <dt>Password</dt>
        <dd><input type="password" name="password" value="" /></dd>
      </dl>
      <dl>
        <dt>Confirm Password&nbsp;</dt>
        <dd><input type="password" name="confirm_password" value="" /></dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Edit Admin" />
      </div>
    </form>

  </div>
  
<?php mysqli_free_result($admin_set);?>
<?php include (SHARED_PATH."/staff_footer.php");?>

