<?php require_once("../../../private/initialize.php");
 require_login();
?>

<?php $page_title= "My Pages" ; ?>

<?php include (SHARED_PATH."/staff_header.php");?>
<br/> <br/>
<?php
    
    $pages_set = find_all_pages();
   // $count = mysqli_num_rows($page_set);
// using the result set I got : 
    // we want to display the subject name instead of the subject_id. how ?   

?>
<div id="content">
	<h1>Pages</h1>
	<h2 style="color:green;">
      <?php echo $_SESSION['status_message'] ?? '' ; if(isset($_SESSION['status_message'])){unset($_SESSION['status_message']);}?>
    </h2>
	<div class="actions">
		<a href="new.php">Create a new page</a>
	</div>
	<!-- here will be the content of this pages php page -->
	<table class="list">
		<tr>	
			<th>ID</th>
            <th>subject name(using id)</th>
			<th>title</th>
			<th>content</th>
            <th>position</th>
			<th>visible</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
	<!-- filling in the table from our array-->
	<?php while ($page = mysqli_fetch_assoc($pages_set)){?>
		<tr>
			<td><?php echo h($page['id']);?></td>
			<td><?php 
                    echo subject_name_by_page_id($page['id']);
                    //echo $page['subject_id'];
                ?></td>
			<td><?php echo h($page['menu_name']);?></td>
			<td><?php echo "Content inside"?></td>
			<td><?php echo h($page['position']);?></td>
			<td><?php echo $page['visible']==1 ?  "True" :  "False"; ?></td>
			
			<td><a href="<?php echo "show.php?id={$page['id']}& menu_name= {$page['menu_name']} &title={$page['menu_name']}"; ?>">View</a></td>
			<td><a href="<?php echo "edit.php?id={$page['id']}";?>">
            Edit</a></td>
			<td><a href="<?php echo WWW_ROOT ."/staff/pages/delete.php?id={$page['id']} & menu_name={$page['menu_name']} ";?>">Delete</a></td>
		</tr>
	<?php }?>
	
	
	</table>
	
	
	
	<?php
        // releasing the memory:
    mysqli_free_result($pages_set);
    ?>
</div>

<?php include (SHARED_PATH."/staff_footer.php");?>

