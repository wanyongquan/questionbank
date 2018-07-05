<?php
  /*
   * Question Bank 0.1
   */
?>
<?php require_once '../config.php';?>
<?php 
    require_once $abs_doc_root.$app_root.'/include/header.php';
    require_once $abs_doc_root.$app_root.'/include/navigation.php';
?>

<?php 
    $pageId = $_REQUEST['id'];
    $pageDetails = fetchPageDetails($pageId);
    
    // Form posted
    // Remove role assignment to this page
    if (!empty($_POST) && !empty($_POST['removepermissions'])){
        $removeIds = $_POST['removepermissions'];
        $delete_count = removeRoleforPage($pageId, $removeIds);
    }
    $pageRoleAssigns = fetchPageRoleAssignments($pageId);
    $roles = fetchAllRoles();
?>
  <div class="container">
    <div  class="row">
      <h2>页面访问权限</h2><p>
      
      <?php 
        // get page detail and the permission assigned;
        
      ?>
      <form name="adminpage" action="<?= $_SERVER['PHP_SELF']?>?id=<?=$pageDetails['id']?>" method="post">
        <div class="row">
          <div class="col-md-12 col-lg-12">
            <div class="panel panel-default">
              <div class="panel-heading"><strong>Infomation</strong>
              </div>
              <div class="panel-body">
                <div class="form-group">
                  <label>ID:</label> <?=$pageDetails['id'];?>
                </div>
                <div class="form-group">
                  <Label>Name:</Label><?= $pageDetails['page'];?>
                </div>
              </div>
            </div><!--  /panel -->
          </div>
          <div class="col-md-12 col-lg-12">
            <div class="panel panel-default">
              <div class="panel-heading"><strong>移除以下角色的访问权限：</strong>
              </div>
              <div class="panel-body">
                <div class="form-group">
                <?php 
                    $assignedRoleIds = [];
                    foreach($pageRoleAssigns as $assignment){
                        $assignedRoleIds[] = $assignment['role_id'];
                    }
                    foreach($roles as $role){
                        if (in_array($role['id'], $assignedRoleIds)){?>
                        <input type="checkbox" name="removepermissions[]" id="removepermissions[]" value="<?= $role['id']?>"><?=$role['rolename']?><br/>
                  <?php }} ?>
                </div>    
              </div>
            </div>
            <!--  /panel -->
          </div>
          <div class="col-md-12 col-lg-12">
            <div class="panel panel-default">
              <div class="panel-heading"><strong>添加以下角色的访问权限：</strong>
              </div>
              <div class="panel-body">
                <div class="form-group">
                <?php 
                  foreach ($roles as $role){
                      if (!in_array($role['id'], $assignedRoleIds)){
                 ?>
                  <input type="checkbox" name="addpermissions[]" id="addpermissions[]" value="<?$role['id'] ?>"><?= $role['rolename']?><br>  
                    
                  <?php }}?>
                </div>               
              </div>
            </div>
            <!--  /panel -->
          </div>
        </div>
        <p>
          <input class="btn btn-primary btn-block" type="submit" value="Save">
          </p>
      </form>
    </div>
  </div>    
<?php require_once $abs_doc_root.$app_root.'/include/page_footer.php';?>
<?php require_once $abs_doc_root.$app_root.'/include/scripts.php';?>
  <script src="users.js" type="text/javascript"></script>
<?php require_once $abs_doc_root.$app_root.'/include/html_footer.php';?>  
  