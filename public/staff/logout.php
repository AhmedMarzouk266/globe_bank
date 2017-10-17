<?php require_once("../../private/initialize.php"); ?>

<?php
// logging out page is unsetting the session values.

    admin_log_out();
    redirect_to('index.php');
?>