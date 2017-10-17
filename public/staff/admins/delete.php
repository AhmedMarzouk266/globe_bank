<?php require_once('../../../private/initialize.php');
   require_login();
     $allowed = super_admin_logged_in();
    if(!$allowed){
        redirect_to(WWW_ROOT.'/not_allowed.php');
    }

// we check the id at first, if there is id its okay if not so back to the list
    $id= isset($_GET['id']) ? $_GET['id']: redirect_to("index.php");

if(request_is_post()){
   delete_admin_by_id($id);
}


?>


<!-- here will be a single page form -->



<?php $page_title = 'Delete Admin'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo WWW_ROOT. '/staff/admins/index.php'; ?> ">&laquo; Back to List</a>

  <div class="Admin delete">
    <h1>Delete Admin</h1>
    <p>Are you sure you want to delete this Admin?</p>

    <form action="<?php echo "delete.php?id=$id"?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete Admin" />
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>