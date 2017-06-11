<?php
    require_once '../config.php';
    
    require_once $abs_doc_root.$app_root.'/include/header.php';
    require_once $abs_doc_root.$app_root.'/include/navigation.php';
?>

  <div class="container">
    <div  class="row">
      <h2>页面权限</h2><p>
      <button class="btn btn-primary" >Add New Page</button></p>
      <div class="pagescontent">
        <!--  getPages content starts here -->
      </div>
    </div>
  </div>    
<?php require_once $abs_doc_root.$app_root.'/include/page_footer.php';?>
<?php require_once $abs_doc_root.$app_root.'/include/scripts.php';?>
  <script src="users.js" type="text/javascript"></script>
<?php require_once $abs_doc_root.$app_root.'/include/html_footer.php';?>  
  