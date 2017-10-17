<?php include(SHARED_PATH . '/public_header.php'); ?>

<?php require_once('../private/initialize.php'); ?>

<?php
    $preview = $_GET['preview'] === 'true' && is_logged_in() ? true : false ;
?>





<div id="main">
       <?php
        if(isset($_GET['id'])){
          $page_id = $_GET['id'] ; 
        }
       
        if(isset($_GET['subject_id'])){
          $subject_id = $_GET['subject_id'] ; 
        }
    
        include(SHARED_PATH . '/public_navigation.php'); 
        ?>
      
  <div id="page">
      
         <?php
      // we will use URL parameters to choose the content of the page.
      
      if($subject_id==0){ // no subject or page selected.
         include(SHARED_PATH . '/static_homepage.php'); 
      }
      else {
          $pages_set = find_pages_by_subject_id($subject_id,['visible'=>true]);
          $page = mysqli_fetch_assoc($pages_set);
          $subject = find_subject_by_id($subject_id,['visible'=>true]);
          
          if(empty($page_id)){ // the user chose subject only. show first page.
              
              if($subject){
                  $allowed_tags='<div><h1><h2><br><img><em><ul><li><strong>';
                  echo strip_tags($page['content'],$allowed_tags);
              }else{
                  redirect_to("index.php");
              }
            
          }
          else{ // user chose a page.
                  if($preview == 'true'){
                      $page = find_page_by_id($page_id);
                      $allowed_tags='<div><h1><h2><br><img><em><ul><li><strong>';
                      echo strip_tags($page['content'],$allowed_tags);
                  }elseif ($subject){
                      $page = find_page_by_id($page_id ,['visible'=>'true']);
                      $allowed_tags='<div><h1><h2><br><img><em><ul><li><strong>';
                      echo strip_tags($page['content'],$allowed_tags);

                  }else{
                      redirect_to("index.php");
                  }
              
          }
              
      }
      
      
         ?>
  </div>

</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>