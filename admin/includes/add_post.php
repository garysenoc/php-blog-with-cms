<?php

if (isset($_POST['create_post'])) {
    $post_title = $_POST['title'];
    $post_author = $_POST['author'];
    $post_category_id = $_POST['post_category_id'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');
    $post_comment_count = 0;

    move_uploaded_file($post_image_temp, "../images/$post_image");


    $query = "INSERT INTO posts values(null,$post_category_id,'$post_title','$post_author', now(),'$post_image','$post_content','$post_tags','$post_comment_count','$post_status',0)";
    $create_post_query = mysqli_query($connection, $query);

    confirmQuery($create_post_query);
    $the_post_id = mysqli_insert_id($connection);

    echo "<p>Post Created. <a href='../post.php?p_id={$the_post_id}'>View Post</a>or <a href='posts.php'>Edit More Posts</a></p>";
}

?>






<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title" id="">
    </div>
    <div class="form-group">
        <label for="post_category">Post Category Id</label>
        <select name="post_category_id" id="post_category" class="form-control">
            <?php
            $query = "SELECT * FROM categories";
            $select_categories = mysqli_query($connection, $query);

            confirmQuery($select_categories);
            while ($row = mysqli_fetch_assoc($select_categories)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                echo "<option value='$cat_id'> $cat_title </option>";
            } ?>
        </select>
    </div>
    <div class="form-group">
        <label for="title">Post Author</label>
        <input type="text" class="form-control" name="author" id="">
    </div>
    <div class="form-group">
        <label for="title">Post Status</label>

        <select name="post_status" id="" class="form-control">
            <option value="published">Published</option>
            <option value="draft">Draft</option>

        </select>
    </div>
    <div class="form-group">
        <label for="title">Post Image</label>
        <input type="file" class="form-control" name="image" id="">
    </div>
    <div class="form-group">
        <label for="title">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" id="">
    </div>
    <div class="form-group">
        <label for="title">Post Content</label>
        <textarea class="form-control" type="text" class="form-control" name="post_content" cols="30" rows="10" id="body"></textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
    </div>
</form>