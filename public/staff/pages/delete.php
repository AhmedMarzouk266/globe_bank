<?php require_once('../../../private/initialize.php');

// we check the id at first, if there is id its okay if not so back to the list
    $id= isset($_GET['id']) ? $_GET['id']: '';
    $menu_name= isset($_GET['menu_name']) ? $_GET['menu_name']: '';

if(request_is_post()){
   delete_page_by_id($id);
}


?>


<!-- here will be a single page form -->



<?php $page_title = 'Delete Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo WWW_ROOT. '/staff/pages/index.php'; ?> ">&laquo; Back to List</a>

  <div class="page delete">
    <h1>Delete Subject</h1>
    <p>Are you sure you want to delete this Page?</p>
    <p class="item"><?php echo $menu_name ; ?></p>

    <form action="<?php echo "delete.php?id=$id"?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete Page" />
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>