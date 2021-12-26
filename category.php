<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                              
              <div class="post-container">
                <!-- post-container -->
                <?php
                  include "config.php";
               
                  $catid = $_GET['catid'];
                  
                  $sql = "SELECT * FROM category WHERE category_id = {$catid}";
                    
                  $result = mysqli_query($conn,$sql) or die("Query Failed");
                  $row = mysqli_fetch_assoc($result);

                ?>
                 <h2 class="page-heading"><?php echo $row['category_name']; ?></h2> 
                 <?php
                     $limit = 3;
                     if(isset($_GET['page'])){
                          $page = $_GET['page'];
                     }else{
                          $page = 1;
                      }
                     $offset = ($page - 1) * $limit;

                     $sql1 = "SELECT * FROM post LEFT JOIN category ON post.category = category.category_id 
                             LEFT JOIN user ON post.author = user.user_id 
                             WHERE post.category = {$catid}";
                     $result1 = mysqli_query($conn,$sql1) or die("Query Failed");

                     if(mysqli_num_rows($result1) > 0){
       
                     while($row1 = mysqli_fetch_assoc($result1)){
                 ?>

                        <div class="post-content">
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="post-img" href="single.php?postid=<?php echo $row1['post_id'];?>"><img src="admin/upload/<?php echo $row1['post_img']; ?>" alt=""/></a>
                                </div>
                                <div class="col-md-8">
                                    <div class="inner-content clearfix">
                                        <h3><a href='single.php?postid=<?php echo $row1["post_id"];?>'><?php echo $row1['title']; ?></a></h3>
                                        <div class="post-information">
                                            <span>
                                                <i class="fa fa-tags" aria-hidden="true"></i>
                                                <a href='category.php?catid=<?php echo $row1['category_id']; ?>'><?php echo $row1['category_name']; ?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                <a href='author.php?aid=<?php echo $row1['author']; ?>'><?php echo $row1['username']; ?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                <?php echo $row1['post_date']; ?>
                                            </span>
                                        </div>
                                        <p class="description"> <?php echo substr($row1['description'],0,170,) .'...'; ?> </p>
                                        <a class='read-more pull-right' href='single.php?postid=<?php echo $row1["post_id"];?>'>read more</a>
                                    </div>
                                </div>
                            </div>
                        </div>    
                        <?php
                            }
                        }else{
                            echo "<h2>No Record Found!!</h2>";
                            }
                        ?>
                    
                    <?php 
                 
                     $result1 = mysqli_query($conn,$sql) or die("Query Failed");
                     
                     $numberOfPost = mysqli_fetch_assoc($result1);
                     
                     if(mysqli_num_rows($result1) > 0){
                         $total_records = $numberOfPost['post'];  
                         $total_page = ceil($total_records / $limit); 
                        
                         echo "<ul class='pagination admin-pagination'>";
                         
                         if($page > 1){
                            echo '<li><a href="index.php?catid='.($catid).'&page='.($page-1).'">Prev</a></li>';
                         }
                         for($i = 1; $i <= $total_page; $i++){
                             if($i == $page){
                                 $active = "active";
                             }else{
                                $active = "";
                             }
                            echo '<li class="'.$active.'"><a href="index.php?catid='.($catid).'&page='.$i.'">'.$i.'</a></li>';
                         }
                         if($total_page > $page){
                            echo '<li><a href="index.php?catid='.($catid).'&page='.($page+1).'">Next</a></li>';
                         }

                         echo "</ul>";
                     }
                   ?>
                  <!-- </div> -->
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
