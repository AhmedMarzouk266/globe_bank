<?php require_once('../../../private/initialize.php'); ?>

<?php
// $id = isset($_GET['id']) ? $_GET['id'] : '1';
$id = $_GET['id'] ?? '0'; // PHP > 7.0

$page = find_page_by_id($id);

?>

<?php $page_title = 'Show Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <h2 style="color:green;">
      <?php echo $_SESSION['status_message'] ?? '' ; if(isset($_SESSION['status_message'])){unset($_SESSION['status_message']);}?>
  </h2>

  <a class="back-link" href="<?php echo WWW_ROOT .'/staff/pages/index.php'; ?>">&laquo; Back to List</a>

  <div class="page show">

    <h1>Page: <?php echo h($page['menu_name']); ?></h1>  
    <a target="_blank" class="btn btn-success" href="<?php echo WWW_ROOT."/index.php?id=".u($id)."& subject_id=".u($page['subject_id'])."& preview=true"; ?>">PREVIEW</a>
    <a class="btn btn-info" href="<?php echo WWW_ROOT; ?>">EDIT</a>
    <a class="btn btn-danger" href="<?php echo WWW_ROOT ;?>">DELETE</a>
    <br/><br/>

    <div class="attributes">
      <?php $subject = find_subject_by_id($page['subject_id']); ?>
      <dl>
        <dt>Subject</dt>
        <dd><?php echo h($subject['menu_name']); ?></dd>
      </dl>
      <dl>
        <dt>Menu Name</dt>
        <dd><?php echo h($page['menu_name']); ?></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd><?php echo h($page['position']); ?></dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd><?php echo $page['visible'] == '1' ? 'true' : 'false'; ?></dd>
      </dl>
      <dl>
        <dt>Content</dt>
        <dd><?php echo h($page['content']); ?></dd>
      </dl>
    </div>


  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
