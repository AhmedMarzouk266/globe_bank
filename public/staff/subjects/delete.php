<?php require_once('../../../private/initialize.php');
 require_login();
// we check the id at first, if there is id its okay if not so back to the list
    $id= isset($_GET['id']) ? $_GET['id']: redirect_to("index.php");
    $menu_name= isset($_GET['menu_name']) ? $_GET['menu_name']: redirect_to("index.php");

if(request_is_post()){
   delete_subject_by_id($id);
}


?>


<!-- here will be a single page form -->



<?php $page_title = 'Delete Subject'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo WWW_ROOT. '/staff/subjects/index.php'; ?> ">&laquo; Back to List</a>

  <div class="subject delete">
    <h1>Delete Subject</h1>
    <p>Are you sure you want to delete this subject?</p>
    <p class="item"><?php echo $menu_name ; ?></p>

    <form action="<?php echo "delete.php?id=$id"?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete Subject" />
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>