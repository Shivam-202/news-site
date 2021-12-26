
<?php
 if($_SESSION['user_role'] == 0){
    header("Location: {$hostname}/admin/post.php");
}

    $id = $_GET['id'];
    include "config.php";
    $sql = "DELETE FROM user WHERE user_id = $id";
    mysqli_query($conn,$sql);
    header("Location: http://localhost/news-site/admin/users.php");
    mysqli_close($conn);
?>