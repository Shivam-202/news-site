<?php include "header.php"; 
 
 if($_SESSION['user_role'] == 0){
    header("Location: {$hostname}/admin/post.php");
 }
 
if(isset($_POST['submi'])){
    
    include "config.php";
    $catid = mysqli_real_escape_string($conn,$_POST['cat_id']);
    $catname = mysqli_real_escape_string($conn,$_POST['cat_name']);
    
    $sql = "UPDATE category SET category_name = '{$catname}' WHERE category_id = {$catid}";
    mysqli_query($conn,$sql);
    header("Location: {$hostname}/admin/category.php");
    
}

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
              <?php
                     $id = $_GET['cateid'];
                     include "config.php";
                     $sql1 = "SELECT * FROM category WHERE category_id = $id";
                     $result1 = mysqli_query($conn,$sql1);
                     while($row1 = mysqli_fetch_assoc($result1)){
                  ?>
                  <form action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="<?php echo $row1['category_id']; ?>" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat_name" class="form-control" value="<?php echo $row1['category_name']; ?>"  placeholder="" required>
                      </div>
                      <input type="submit" name="submi" class="btn btn-primary" value="Update" required />
                  </form>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
