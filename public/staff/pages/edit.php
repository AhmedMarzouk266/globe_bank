<?php
// in this page we will have an edit form, is is similar to the create form 
// we would like to have it as a single page form.

    // our funcitons:
require_once('../../../private/initialize.php');
// get number of rows:
   $pages_set = find_all_pages();
   $count = mysqli_num_rows($pages_set); // number of rows to use for the position.
   
   
    // initial values for the form parameters: to display them while editing.

$id = isset($_GET['id']) ? $_GET['id'] : '0';

    // processing the form:

if(request_is_post()){
    
// first we get the data from the POST array:
    $menu_name = isset($_POST['menu_name']) ? h($_POST['menu_name']) : "" ;
    $position = isset($_POST['position']) ? $_POST['position'] : "" ;
    $visible = isset($_POST['visible']) ? $_POST['visible'] : "" ;
    $subject_id = isset($_POST['subject_id']) ? $_POST['subject_id'] : "" ;
    $content = isset($_POST['content']) ? $_POST['content'] : "" ;
   

    
// editing the parameters: // better if to send array not 
    
$result = edit_page_by_id($id,$subject_id,$menu_name,$position,$visible,$content);
    if($result === true){
        redirect_to("index.php");
    }else
     {
      $errors = $result ;
      //var_dump($errors);
    }
    
}else{
    $page=find_page_by_id($id); // an assoc array         
} 

?>

 <?php 
// header:
include (SHARED_PATH."/staff_header.php");
?>   
<!-- the form-->

<div id="content">
   <div class="page edit">
    <h1>Edit Page</h1>
    <!-- display errors , make it in a function -->
           <?php  display_errors($errors);?>
    <h5>Number of Pages: <?php echo $count;?></h5>

    <form action="" method="post">
      <dl>
        <dt>Page Name</dt>
        <dd><input type="text" name="menu_name" value="<?php echo $page['menu_name'];?>" /></dd>
      </dl>
       <dl>
       <dt>Subject (with ID) </dt>
        <dd>
           <select name="subject_id">
           <?php
            $subject_set= find_all_subjects();
            while ($subject = mysqli_fetch_assoc($subject_set)){?>
            <option value="<?php echo $subject['id']; ?>" <?php if($page['subject_id']==$subject['id']){echo "selected";}?> > <?php echo $subject['menu_name'];?></option>
           <?php } ?>
          </select>
        </dd>
      </dl>
      
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position">
           <?php for($i=1; $i<=$count; $i++){?>
            <option value="<?php echo $i?>" <?php if($page['position']==$i){echo " selected";} ?> ><?php echo $i?></option>
           <?php } ?>
          </select>
        </dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd>
          <input type="hidden" name="visible" value="0" />
          <input type="checkbox" name="visible" value="1" <?php if($page['visible']==1){echo "checked";}?>/>
        </dd>
      </dl>
      <dl>
        <dt>Content </dt>
          <dd><textarea cols="60" rows="10" name="content" value="<?php echo $page['content'];?>" ></textarea> </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Edit Page" />
      </div>
    </form>

  </div>
  
<?php mysqli_free_result($pages_set);?>
<?php include (SHARED_PATH."/staff_footer.php");?>

