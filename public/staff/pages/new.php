<?php
    // a page for creating a new form.
require_once('../../../private/initialize.php'); // calling our functions

// get number of rows:
   $pages_set = find_all_pages();
   $count = mysqli_num_rows($pages_set); // number of rows to use for the position.
    
   $subject_set= find_all_subjects();

// the form processing will be here this time:

    $menu_name='';
    $position='';
    $visible='';
    $content='';
    $subject_id='';

    

if(request_is_post()){ // if the requst made is post so peocess it :
// first we get the data from the POST array:
    $menu_name=$_POST['menu_name'];
    $position=$_POST['position'];
    $visible=$_POST['visible'];
    $content=$_POST['content'];
    $subject_id=$_POST['subject_id'];
    
// here we will make a new page using the parameters we have:
    $result = insert_page($subject_id,$menu_name,$position,$visible,$content);
    if($result===true){
        $id=mysqli_insert_id($db);
        // before redirection i wanna store a status message.
        $success = 'Page Successfully Created..';
        $_SESSION['status_message']=$success ; 
        redirect_to("show.php?id={$id}&menu_name={$menu_name}");
        
    }else{
       $errors=$result;
    }
    
}


// our header:
$page_title = 'Create Page'; 
include(SHARED_PATH . '/staff_header.php');

?>



<!-- a link back to the list-->

<div>
    <a href="index.php">Back to the list</a><br>
    <?php echo "number of pages: ".$count."<br>"?>
</div>

<div id="content">
   <div class="page new">
    <h1>Create Page</h1>
 <!-- display errors , make it in a function -->
           <?php  display_errors($errors);?>
           
    <form action="new.php" method="post">
      <dl>
        <dt>Page Name</dt>
        <dd><input type="text" name="menu_name" value="<?php echo $menu_name?>" /></dd>
      </dl>
      <dl>
        <dt>Subject (with ID) </dt>
        <dd>
           <select name="subject_id">
           <?php while ($subject = mysqli_fetch_assoc($subject_set)){?>
            <option value="<?php echo $subject['id']?>" ><?php echo $subject['menu_name']?></option>
           <?php } ?>
          </select>
        </dd>
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
          <input type="checkbox" name="visible" value="1" <?php if($visible==1){echo "checked";}?> />
        </dd>
      </dl>
      <dl>
        <dt>Content </dt>
        <dd><textarea cols="60" rows="10" name="content" value="<?php echo $content?>" ></textarea> </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Create Page" />
      </div>
    </form>

  </div>
</div>
<?php include(SHARED_PATH . "/staff_footer.php")?>