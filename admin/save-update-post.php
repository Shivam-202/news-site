<?php
   include "config.php";
    
  echo $oldcat = $_GET['curcatid'];
  echo $newcat = $_POST['category'];

   if(empty($_FILES['new-image']['name'])){
    echo $file_name = $_POST['old-image'];
   }else{
    $error = array();

    $file_name = $_FILES['new-image']['name'];
    $file_size = $_FILES['new-image']['size'];
    $file_tmp = $_FILES['new-image']['tmp_name'];
    $file_type = $_FILES['new-image']['type'];
    $file_ext = strtolower(end(explode('.',$file_name)));
    $extensions = array("jpeg","jpg","png");

    if(in_array($file_ext,$extensions) === false){
        $error[] = "This extensions file is not allowed";
    }

    if($file_size > 2097152){
        $error[] = "File size must be 2MB or lower";
    }

    if(empty($error) == true){
        move_uploaded_file($file_tmp,"upload/".$file_name);
    }else{
        print_r($error);
        die();
    }
   }

  
    $sql = "UPDATE post SET title = '{$_POST["post_title"]}',description = '{$_POST["postdesc"]}',category = {$_POST["category"]},post_img = '{$file_name}'
           WHERE post_id = {$_POST['post_id']};";
    
    $sql .= "UPDATE category SET post = post+1 WHERE category_id = {$newcat};";
    $sql .= "UPDATE category SET post = post-1 WHERE category_id = {$oldcat}";
   mysqli_multi_query($conn,$sql);

   header("Location: {$hostname}/admin/post.php");

?>