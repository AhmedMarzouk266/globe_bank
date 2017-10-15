
<!-- wanna make sure that $page_title is set.. making a default. -->

<?php
    if(!isset($page_title)){
        $page_title = "Staff Area";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GBI- <?php echo $page_title?> </title>
    <link rel="stylesheet" href=" <?php echo WWW_ROOT . '/stylesheets/staff.css'?> ">
     <link rel="stylesheet" href=" <?php echo WWW_ROOT . '/stylesheets/bootstrap.css'?> ">
</head>
<body class="contaienr">
  
   <header>
       <h1>GBI - <?php echo $page_title ?> </h1>
       
   </header>
   
   <navigation>
       <ul>
          <li> <a href=" <?php echo WWW_ROOT . '/staff/index.php' ;?> " >Menu</a></li>
          <li>
              <?php if(isset($_SESSION['username'])){ ?>
                      <?php echo "User: ". $_SESSION['username']; ?>&emsp;
                      <a href="<?php echo WWW_ROOT ."/staff/logout.php"?>">Log Out</a>
            <?php } else{ ?>
                     <a href="<?php echo WWW_ROOT ."/staff/login.php"?>">Log In</a>
              <?php } ?>
         </li>
       </ul>
   </navigation>
   
   