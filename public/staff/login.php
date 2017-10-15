<?php require_once("../../private/initialize.php"); ?>

<?php
    if(request_is_post()){
    $user_name = $_POST['username'] ?? '' ;
    $_SESSION['username'] = $user_name ; // record the user name in session. 
    redirect_to('index.php');
    }
?>
<?php include (SHARED_PATH."/staff_header.php");?>

<div id="content">
  
   <br>
   <h1>Log In Page</h1>
   <br>
   <form action="login.php" method="post">
         <input type="text" name="username" placeholder="UserName..">&emsp;
         <input type="text" name="password" placeholder="PassWord.."><br><br>
       <input type="submit" value="Log In">
   </form>
    
</div>


<?php include (SHARED_PATH."/staff_footer.php");?>
