<?php require_once("../../private/initialize.php"); ?>

<?php
// logging out page is unsetting the session values.
    unset($_SESSION['username']);
    redirect_to('index.php');
?>