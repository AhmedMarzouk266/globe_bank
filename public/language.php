<?php require_once('../private/initialize.php'); ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>

<?php
    // processing the FORM : 
        if(request_is_post()){  
            $language = $_POST['language'] ?? '' ;
            $expire = time()+ 60*60*24*365 ; // one year
            setcookie('lang',$language,$expire);
        }
        else{
            $language = $_COOKIE['lang'] ?? 'None';
        }
   
?>

<div id="main">
   <?php         include(SHARED_PATH . '/public_navigation.php');  ?>
    <div id="page">
       <h1>Language Selection</h1>
       <h2>The Selected Language is : <?php echo $language?></h2><br>
       <div class="container">
           <form action="language.php" method="post">
          please select :
           <select name="language" >
              <?php $language_choices=['English','French','German','Russian'];?>
              <?php foreach($language_choices as $language_choice){?>
                <option value="<?php echo $language_choice ?>"  <?php if($language_choice==$language){echo "selected";}?> ><?php echo $language_choice?></option>
              <?php } ?>
           </select><br><br>
           <button type="submit">Set Language</button>
       </form>
       </div>
       
        
    </div>
</div>



<?php include(SHARED_PATH . '/public_footer.php'); ?>