<?php require_once('../../../private/initialize.php'); ?>
 require_login();
<?php
// we need to check if the variable exists in the GET array is set:

	$id = isset($_GET['id']) ? $_GET['id'] : '0' ; // '0' is the default value.
	$menu_name =  isset($_GET['menu_name'])? $_GET['menu_name'] : 'Menu Default';
	echo "ID = ". h($id) ."<br/>";
	echo "Menu Name = ". h($menu_name);
    echo "<br>";

// find subject by id ! 

    $subject = find_subject_by_id($id); // here I receive an array.
    
?>
<!-- back buttn-->
<br/>
<br/><h2 style="color:blue;">
      <?php echo $_SESSION['status_message'] ?? '' ; if(isset($_SESSION['status_message'])){unset($_SESSION['status_message']);}?>
    </h2>
    
<a href="index.php">Back</a> <br/><br/>
    <h1>Subject: <?php echo $subject['menu_name'];?></h1>
    <div class="container">
      <h3>Menu Name: <?php echo $subject['menu_name'];?></h3>
      <h3>Position:  <?php echo $subject['position'];?></h3>
      <h3>Visible:   <?php echo $subject['visible']?"true":"false";?></h3>
      
        
    </div>

<br/>


