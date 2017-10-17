<?php require_once('../../../private/initialize.php'); ?>

<?php
// $id = isset($_GET['id']) ? $_GET['id'] : '1';
$id = $_GET['id'] ?? '1'; // PHP > 7.0

$admin = find_admin_by_id($id);

?>

<?php $page_title = 'Show Admin'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <h2 style="color:green;">
      <?php echo $_SESSION['status_message'] ?? '' ; if(isset($_SESSION['status_message'])){unset($_SESSION['status_message']);}?>
  </h2>

  <a class="back-link" href="<?php echo WWW_ROOT .'/staff/admins/index.php'; ?>">&laquo; Back to List</a>

  <div class="admin show">

    <h1>Admin: <?php echo h($admin['username']); ?></h1>  
  
    <a class="btn btn-info" href="<?php echo WWW_ROOT; ?>">EDIT</a>
    <a class="btn btn-danger" href="<?php echo WWW_ROOT ;?>">DELETE</a>
    <br/><br/>

    <div class="attributes">
      
      <dl>
        <dt>First Name</dt>
        <dd><?php echo h($admin['first_name']); ?></dd>
      </dl>
      <dl>
        <dt>Last Name</dt>
        <dd><?php echo h($admin['last_name']); ?></dd>
      </dl>
      <dl>
        <dt>Email</dt>
        <dd><?php echo h($admin['email']); ?></dd>
      </dl>
      <dl>
        <dt>Username</dt>
        <dd><?php echo $admin['username'] ; ?></dd>
      </dl>
    </div>


  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
