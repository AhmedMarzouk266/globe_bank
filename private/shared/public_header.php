<!doctype html>

<html lang="en">
  <head>
    <title>Globe Bank <?php 
        if(isset($page_title)) { echo '- ' . h($page_title); }
        ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all" href="<?php echo WWW_ROOT.'/stylesheets/public.css';?>" />
    <link rel="stylesheet" href=" <?php echo WWW_ROOT . '/stylesheets/bootstrap.css';?> ">
    
  </head>

  <body>

    <header>
      <h1>
        <a href="<?php echo 'index.php' ; ?>">
          <img src="<?php echo WWW_ROOT . '/images/gbi_logo.png'; ?>" width="298" height="71" alt="" />
        </a>

        <?php
          if(isset($preview) && $preview){
              echo "&emsp;&emsp;&emsp;"."[PREVIEW]";
          }
          ?>
        
        
       
      </h1>
    </header>
