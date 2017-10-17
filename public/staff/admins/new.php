<?php require_once('../../../private/initialize.php');
 require_login();
// initial values for the first load of the page.
   $admin=[];

   $admin['first_name']       = $_POST['first_name']?? '';
   $admin['last_name']        = $_POST['last_name'] ?? '';
   $admin['email']            = $_POST['email'] ?? '' ;
   $admin['username']         = $_POST['username'] ?? '' ;
   $admin['super_admin']      = $_POST['super_admin'] ?? '' ;
   $admin['password']         = $_POST['password'] ?? '' ;
   $admin['confirm_password'] = $_POST['confirm_password'] ?? '' ;

if(request_is_post()){
    
    // a page where the form paramteres are submitted: menu_name position visible
    
   $admin['first_name']       = $_POST['first_name'] ?? '';
   $admin['last_name']        = $_POST['last_name'] ?? '';
   $admin['email']            = $_POST['email'] ?? '' ;
   $admin['username']         = $_POST['username'] ?? '' ;
   $admin['super_admin']      = $_POST['super_admin'] ?? '' ;
   $admin['password']         = $_POST['password'] ?? '' ;
   $admin['confirm_password'] = $_POST['confirm_password'] ?? '' ;


// inserting the data to the database:
    
$result = insert_admin($admin);
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
        <dd><input type="text" name="first_name" value="" /></dd>
      </dl>
      <dl>
        <dt>Last Name</dt>
        <dd><input type="text" name="last_name" value="" /></dd>
      </dl>
      <dl>
        <dt>Email</dt>
        <dd><input type="text" name="email" value="" /></dd>
      </dl>
      <dl>
        <dt>Username</dt>
        <dd><input type="text" name="username" value="" /></dd>
      </dl>
     <dl>
        <dt>Super Admin</dt>
        <dd>
          <input type="hidden" name="super_admin" value="0" />
          <input type="checkbox" name="super_admin" value="1"/>
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
      
      <p>
          Password should have at least 12 characters, one Upercase, one Lowercase, number and one
          symbol.
      </p>
      
      <div id="operations">
        <input type="submit" value="Create Admin" />
      </div>
    </form>

  </div>
</div>

<?php include(SHARED_PATH . "/staff_footer.php")?>
