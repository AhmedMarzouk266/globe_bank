<?php
// a page to show the admins table:
//initilize:
require_once('../../../private/initialize.php');
 require_login();

$admins_set = find_all_admins();

$page_title="Staff Admins" ;

 include(SHARED_PATH . "/staff_header.php");
?>


     <h2 style="color:blue;">
      <?php echo $_SESSION['status_message'] ?? '' ; if(isset($_SESSION['status_message'])){unset($_SESSION['status_message']);}?>
     </h2>    
     
   <div id="content">
     
      <div class="Admins listing">
         <h1>Admins</h1>
         <div class="actions">
             <a class="action" href="<?php echo WWW_ROOT."/staff/admins/new.php"?>">Create a new Admin</a>
         </div>
         
         <!-- table -->
         <table class="list">
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>UserName</th>
                <th>SUPER ADMIN</th>
                
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>
            
            <!-- now to fill in the table : foreach-->
            <?php while($admin = mysqli_fetch_assoc($admins_set) ){ ?>
                <tr>
                    <td><?php echo $admin['id']; ?></td>
                    <td><?php echo $admin['first_name']; ?></td>
                    <td><?php echo $admin['last_name'] ; ?></td>
                    <td><?php echo h($admin['email']); ?></td>
                    <td><?php echo h($admin['username']); ?></td>
                    <td><?php echo h($admin['super_admin'])==1 ? 'True' : 'False'; ?></td>
    
                    <td><a class="action" href="<?php echo WWW_ROOT ."/staff/admins/show.php?username={$admin['username']} & id={$admin['id']}"; ?>">View</a></td>
                    <td><a class="action" href="<?php echo WWW_ROOT ."/staff/admins/edit.php?id={$admin['id']} & username={$admin['username']} " ;?>">Edit</a></td>
                    <!-- href for edit is to the edit page-->
                    <td><a class="action" href="<?php echo WWW_ROOT ."/staff/admins/delete.php?id={$admin['id']} & username={$admin['username']} "; ?> ">Delet</a></td>
                </tr>
            <?php } ?>
            
             
         </table>
         
         <?php
            mysqli_free_result($admins_set);
          ?>
         
          
      </div>
      
   </div>

<?php include(SHARED_PATH . "/staff_footer.php")?>


