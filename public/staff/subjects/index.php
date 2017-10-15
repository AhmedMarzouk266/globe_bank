<?php require_once('../../../private/initialize.php'); ?>

<?php
// i would like to make a quesry from the data base and then free the memory after using it.

        $subject_set = find_all_subjects ();
    // we made a function that calls everything from subjects table. it will be easier.

// now we will get the subject from the database:
    // we will do that by calling Associative Array:

//$subjects_assoc_array = mysqli_fetch_assoc($subject_set); // it gets back only one row in one Associative array.
//$count = mysqli_num_rows($subjects); // it will return how many items are there.
// we might need it.


?>


<?php $page_title="Staff Subjects" ?>

<?php include(SHARED_PATH . "/staff_header.php")?>
    
     <h2 style="color:blue;">
      <?php echo $_SESSION['status_message'] ?? '' ; if(isset($_SESSION['status_message'])){unset($_SESSION['status_message']);}?>
     </h2>    
     
   <div id="content">
     
      <div class="subjects listing">
         <h1>Subjects</h1>
         <div class="actions">
             <a class="action" href="<?php echo WWW_ROOT."/staff/subjects/new.php"?>">Create a new subject</a>
         </div>
         
         <!-- table -->
         <table class="list">
            <tr>
                <th>ID</th>
                <th>Position</th>
                <th>Visible</th>
                <th>Name</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>
            
            <!-- now to fill in the table : foreach-->
            <?php while($subject = mysqli_fetch_assoc($subject_set) ){ ?>
                <tr>
                    <td><?php echo $subject['id']; ?></td>
                    <td><?php echo $subject['position']; ?></td>
                    <td><?php echo $subject['visible']==1 ? 'true':'false' ; ?></td>
                    <td><?php echo h($subject['menu_name']); ?></td>
                    <td><a class="action" href="<?php echo WWW_ROOT ."/staff/subjects/show.php?menu_name={$subject['menu_name']} & id={$subject['id']}"; ?>">View</a></td>
                    <td><a class="action" href="<?php echo WWW_ROOT ."/staff/subjects/edit.php?id={$subject['id']} & menu_name={$subject['menu_name']} " ;?>">Edit</a></td>
                    <!-- href for edit is to the edit page-->
                    <td><a class="action" href="<?php echo WWW_ROOT ."/staff/subjects/delete.php?id={$subject['id']} & menu_name={$subject['menu_name']} "; ?> ">Delet</a></td>
                </tr>
            <?php } ?>
            
             
         </table>
         
         <?php
            mysqli_free_result($subject_set);
          ?>
         
          
      </div>
      
   </div>

<?php include(SHARED_PATH . "/staff_footer.php")?>