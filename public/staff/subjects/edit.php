<?php require_once('../../../private/initialize.php');
 require_login();
// we check the id at first, if there is id its okay if not so back to the list
    $id= isset($_GET['id']) ? $_GET['id']: '';
    $menu_name=isset($_GET['menu_name']) ? h($_GET['menu_name']): '';
    $position="";
    $visible="";
    // if we came to edit page with POST request so preocess the form else => show the page

    
if(request_is_post()){
    
    // a page where the form paramteres are submitted: menu_name position visible
    
    $menu_name = isset($_POST['menu_name']) ? h($_POST['menu_name']) : "" ;
    $position = isset($_POST['position']) ? $_POST['position'] : "" ;
    $visible = isset($_POST['visible']) ? $_POST['visible'] : "" ;

// after getting the data from the editing form we would like to use it to edit the subject.
    
    // making a query to the database:
   $result = edit_subject_by_id($id,$menu_name,$position,$visible); // it should return true or errors.
     if($result === true){
        $_SESSION['status_message']="Subject Successfully Edited..";
        redirect_to("index.php");
    }else
     {
      $errors = $result ;
      //var_dump($errors);
    }
     
}
    $subject_set=find_all_subjects();
$count=mysqli_num_rows($subject_set);
?>

<?php $page_title = 'Edit Subject'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
    <a class="back-link" href="<?php echo WWW_ROOT.('/staff/subjects/index.php'); ?>">&laquo; Back to List</a><br/>
  <div class="subject edit">
  
    <h1>Edit Subject</h1>
    
    <!-- display errors , make it in a function -->
           <?php  display_errors($errors);?>

    <form action="<?php echo "edit.php?id=$id"?>" method="post">
      <dl>
        <dt>Menu Name</dt>
        <dd><input type="text" name="menu_name" value="<?php echo h($menu_name);?>" /></dd>
        <?php if(isset($errors['menu_name'])){echo "<span class='error'> &ensp;*</span>" ;}?>
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
        <input type="submit" value="Edit Subject" />
      </div>
    </form>

  </div>
</div>

<?php include(SHARED_PATH . "/staff_footer.php")?>
