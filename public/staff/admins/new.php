<?php require_once('../../../private/initialize.php');
// initial values for the first load of the page.
   $first_name       = $_POST['first_name']?? '';
   $last_name        = $_POST['last_name'] ?? '';
   $email            = $_POST['email'] ?? '' ;
   $username         = $_POST['username'] ?? '' ;
   $password         = $_POST['password'] ?? '' ;
   $confirm_password = $_POST['confirm_password'] ?? '' ;

if(request_is_post()){
    
    // a page where the form paramteres are submitted: menu_name position visible
    
   $first_name       = $_POST['first_name']?? '';
   $last_name        = $_POST['last_name'] ?? '';
   $email            = $_POST['email'] ?? '' ;
   $username         = $_POST['username'] ?? '' ;
   $password         = $_POST['password'] ?? '' ;
   $confirm_password = $_POST['confirm_password'] ?? '' ;


// inserting the data to the database:
    
$result = insert_admin($first_name,$last_name,$email,$username,$password,$confirm_password);
    if($result === true){
        $id=mysqli_insert_id($db); // to know the last inserted ID.
        //before the redirect I want to stor a message.
        $_SESSION['status_message']="Admin Successfully Created..";
        redirect_to("show.php?id={$id}");
        
    }else{
         $errors = $result ;
    }
    
}

$admins_set=find_all_admins();
$count=mysqli_num_rows($admins_set);
  
?>


<?php $page_title = 'Create Admin'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
    <a class="back-link" href="<?php echo WWW_ROOT.('/staff/admins/index.php'); ?>">&laquo; Back to List</a>
  <div class="admin new">
    <h1>Create Admin</h1>
<!-- display errors , make it in a function -->
           <?php  display_errors($errors);?>
           
    <form action="<?php echo "new.php";?>" method="post">
      <dl>
        <dt>First Name</dt>
        <dd><input type="text" name="first_name" value="<?php echo $first_name;?>" /></dd>
      </dl>
      <dl>
        <dt>Last Name</dt>
        <dd><input type="text" name="last_name" value="<?php echo $last_name;?>" /></dd>
      </dl>
      <dl>
        <dt>Email</dt>
        <dd><input type="text" name="email" value="<?php echo $email;?>" /></dd>
      </dl>
      <dl>
        <dt>Username</dt>
        <dd><input type="text" name="username" value="<?php echo $username;?>" /></dd>
      </dl>
      <dl>
        <dt>Password</dt>
        <dd><input type="text" name="password" value="<?php echo $password;?>" /></dd>
      </dl>
       <dl>
        <dt>Confirm Password&nbsp;</dt>
        <dd><input type="text" name="confirm_password" value="<?php echo $confirm_password;?>" /></dd>
      </dl>
      
      <div id="operations">
        <input type="submit" value="Create Admin" />
      </div>
    </form>

  </div>
</div>

<?php include(SHARED_PATH . "/staff_footer.php")?>
