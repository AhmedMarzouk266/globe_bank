<?php require_once('../../private/initialize.php'); ?>
  <?php require_login(); ?>

<?php $page_title= "Staff Menu" ; ?>
    <!-- this variabe $page_title is availabe in all the included files we have here ! -->

<?php include(SHARED_PATH . "/staff_header.php")?>

   <div id="content">
      <div id="main-menu">
        <h2 style="color:green;">
      <?php echo $_SESSION['status_message'] ?? '' ; if(isset($_SESSION['status_message'])){unset($_SESSION['status_message']);}?>
  </h2>
         <h2>Main Menu</h2>
         <ul>
             <li><a href="subjects/index.php"> Subjects </a></li>
             <li><a href="pages/index.php"> Pages </a></li>
             <li><a href="admins/index.php"> Admins </a></li>
         </ul>
          
      </div>
   </div>

    <div>
           <?php include(SHARED_PATH . "/staff_footer.php")?> 
    </div>
