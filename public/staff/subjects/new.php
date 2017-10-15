<?php require_once('../../../private/initialize.php');

    $menu_name = isset($_POST['menu_name']) ? $_POST['menu_name'] : "" ;
    $position = isset($_POST['position']) ? $_POST['position'] : "" ;
    $visible = isset($_POST['visible']) ? $_POST['visible'] : "" ;

if(request_is_post()){
    
    // a page where the form paramteres are submitted: menu_name position visible
    
    $menu_name = isset($_POST['menu_name']) ? $_POST['menu_name'] : "" ;
    $position = isset($_POST['position']) ? $_POST['position'] : "" ;
    $visible = isset($_POST['visible']) ? $_POST['visible'] : "" ;


// inserting the data to the database:
    
$result = insert_subject($menu_name,$position,$visible);
    if($result === true){
        $id=mysqli_insert_id($db); // to know the last inserted ID.
        //before the redirect I want to stor a message.
        $_SESSION['status_message']="Subject Successfully Created..";
        redirect_to("show.php?id={$id}");
        
    }else{
         $errors = $result ;
    }
    
}

$subject_set=find_all_subjects();
$count=mysqli_num_rows($subject_set);
  
?>


<?php $page_title = 'Create Subject'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
    <a class="back-link" href="<?php echo WWW_ROOT.('/staff/subjects/index.php'); ?>">&laquo; Back to List</a>
  <div class="subject new">
    <h1>Create Subject</h1>
<!-- display errors , make it in a function -->
           <?php  display_errors($errors);?>
           
    <form action="<?php echo "new.php";?>" method="post">
      <dl>
        <dt>Menu Name</dt>
        <dd><input type="text" name="menu_name" value="" /></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position">
            <?php for ($i=1; $i<=$count; $i++){?>
            <option value="<?php echo $i?>" <?php if($position==$i){echo "selected";} ?> ><?php echo $i?></option>
           <?php } ?>
          </select>
        </dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd>
          <input type="hidden" name="visible" value="0" />
          <input type="checkbox" name="visible" value="1" />
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Create Subject" />
      </div>
    </form>

  </div>
</div>

<?php include(SHARED_PATH . "/staff_footer.php")?>
