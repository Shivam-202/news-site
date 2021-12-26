
<?php

 if($_SESSION['user_role'] == 0){
    header("Location: {$hostname}/admin/post.php");
}
     include "config.php";
     $postid = $_GET['postid'];
     $catid = $_GET['catid'];
    
    $sql1 = "SELECT * FROM post WHERE post_id = {$postid};";
    $result1 = mysqli_query($conn,$sql1) or die("Query Failed!!");
    $row1 = mysqli_fetch_assoc($result1);
    unlink("upload/" .$row1['post_img']);  // Folder se image remove karne ke liye.

    $sql = "DELETE FROM post WHERE post_id = {$postid};";
    $sql .= "UPDATE category SET post = post - 1 WHERE category_id = {$catid}";
   
    if(mysqli_multi_query($conn,$sql)){
       header("Location: http://localhost/news-site/admin/post.php");
    }
    else{
        echo "Query Failed!!";
    }

?>