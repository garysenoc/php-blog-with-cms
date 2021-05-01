<?php

if (isset($_POST['checkBoxArray'])) {
    foreach ($_POST['checkBoxArray'] as $postValueId) {
        $bulk_options = $_POST['bulk_options'];

        switch ($bulk_options) {
            case 'published':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' where post_id = '$postValueId' ";
                $update_published_status = mysqli_query($connection, $query);
                confirmQuery($update_published_status);
                break;
            case 'draft':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' where post_id = '$postValueId' ";
                $update_to_draft_status = mysqli_query($connection, $query);
                confirmQuery($update_to_draft_status);
                break;
            case 'delete':
                $query = "DELETE FROM posts where post_id = '$postValueId' ";
                $update_to_delete_status = mysqli_query($connection, $query);
                confirmQuery($update_to_delete_status);
                break;

            case 'clone':
                $query = "SELECT * FROM posts where post_id = '{$postValueId}'";
                $select_posts = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($select_posts)) {
                    $post_id = $row['post_id'];
                    $post_author = $row['post_author'];
                    $post_title = $row['post_title'];
                    $post_category_id = $row['post_category_id'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_content = $row['post_content'];
                    $post_comment_count = $row['post_comment_count'];
                    $post_date = $row['post_date'];
                }
                $query = "INSERT INTO posts values(null,$post_category_id,'$post_title','$post_author', now(),'$post_image','$post_content','$post_tags','$post_comment_count','$post_status',0)";
                $create_post_query = mysqli_query($connection, $query);
                break;
        }
    }
}


?>


<form action="" method="POST">
    <table class="table table-bordered table-hover">
        <div id="bulkOptionContainer" class="col-xs-4" style="padding:0;">
            <select name="bulk_options" id="" class="form-control">
                <option value="">Select Options</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
                <option value="clone">Clone</option>
            </select>
        </div>
        <div class="col-xs-4">
            <input type="submit" name="submit" class="btn btn-success" value="Apply" />
            <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
        </div>
        <thead>
            <tr>
                <th><input type="checkbox" name="" id="selectAllBoxes"></th>
                <th>Id</th>
                <th>Author</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th>View Post</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>Views</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $query = "SELECT * FROM posts ORDER BY post_id DESC";
            $select_posts = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($select_posts)) {
                $post_id = $row['post_id'];
                $post_author = $row['post_author'];
                $post_title = $row['post_title'];
                $post_category_id = $row['post_category_id'];
                $post_status = $row['post_status'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_comment_count = $row['post_comment_count'];
                $post_date = $row['post_date'];
                $post_views_count = $row['post_views_count'];


                echo "<tr>";
            ?>
                <th><input type='checkbox' class="checkBoxes" name='checkBoxArray[]' value='<?php echo $post_id ?>'></th>
            <?php
                echo "<td>$post_id</td>";
                echo "<td>$post_author</td>";
                echo "<td>$post_title</td>";

                $query = "SELECT * FROM categories where cat_id = $post_category_id";
                $select_categories_id = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($select_categories_id)) {
                    $cat_title = $row['cat_title'];

                    echo "<td>$cat_title</td>";
                }






                echo "<td>$post_status</td>";
                echo "<td><img width='100' src='../images/$post_image'></td>";
                echo "<td>$post_tags</td>";
                echo "<td>$post_comment_count</td>";
                echo "<td>$post_date</td>";
                echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";
                echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                echo "<td><a onclick=\"javascript: return confirm('Are you sure you want to delete?'); \" href='posts.php?delete={$post_id}'>Delete</a></td>";
                echo "<td><a href='posts.php?reset_views={$post_id}'>$post_views_count</a?</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

</form>
<?php

if (isset($_GET['delete'])) {
    $the_post_id = $_GET['delete'];
    $query = "DELETE FROM posts where post_id = $the_post_id";
    $delete_query = mysqli_query($connection, $query);
    header("Location: posts.php");
}

if (isset($_GET['reset_views'])) {
    $the_post_id = $_GET['reset_views'];
    $the_post_id = mysqli_real_escape_string($connection, $the_post_id);
    $query = "UPDATE  posts set post_views_count = 0  where post_id = $the_post_id";
    $reset_views_query = mysqli_query($connection, $query);
    header("Location: posts.php");
}

?>