<!-- COMMENT SECTION -->
<h2 class="commentSection">Comment Section</h2>
<?php 
if (isset($_SESSION['userID'])){ 
    echo"<form action='includes/commentSectionInc.php?productID=$productID' method='post'>"; ?>
    <label>Enter comments:</label><br><br>
    <textarea name="comment" maxlength="400" placeholder="Comments..."></textarea><br><br>
    <button type="submit" name="submit" class="btn">Submit</button>
<?php
}
?>

    
</form>
<?php
    // DISPLAY COMMENT
    $query = $db_handler->getConn()->prepare("SELECT * FROM user, comment WHERE comment.userID = user.userID AND comment.forumID = ? ORDER BY dateTime DESC");
    $query->bind_param('d', $productID);
    $query->execute();
    $result = $query->get_result();
    $query->close();
    $rowCount = $result->num_rows;

    if ($rowCount > 0) {
        
        while($comments_array = $result->fetch_assoc()){ ?>
            <div class="commentContainer">
                <!-- COMMENT DETAILS  -->
                <div class="commentDetailsContainer">
                    <h3><?php  echo $comments_array['userFirstName'] ." " . $comments_array['userLastName']; ?></h3>
                    <span><?php echo $comments_array['dateTime']; ?></span>
                    <div class="commentRemoveIcon">
                        <?php
                            if (isset($_SESSION['userID'])){
                                if (($_SESSION['userID'] == $comments_array['userID']) || $_SESSION['userRoleID'] < 2){
                                    echo "<a href=includes/commentSectionInc.php?removeComment=$comments_array[commentID]>
                                    <i class='fas fa-trash-alt icon'></i></a>";
                                }
                            }
                        ?>
                    </div>
                </div>
                
                <!-- COMMENT -->
                <div class="comment">
                    <p><?php echo $comments_array['comment']; ?></p>
                </div>
            </div>
        <?php
        
            
        }
    }
    else{
        echo "Comment section is empty";
    }  
?>


