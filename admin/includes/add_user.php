<?php

if (isset($_POST['create_user'])) {


    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    // $post_image = $_FILES['image']['name'];
    // $post_image_temp = $_FILES['image']['tmp_name'];


    // move_uploaded_file($post_image_temp, "../images/$post_image");


    $query = "INSERT INTO users values(null,'$username','$user_password','$user_firstname','$user_lastname','$user_email','','$user_role','')";
    $create_user_query = mysqli_query($connection, $query);

    confirmQuery($create_user_query);
    echo "User Created : " . " " . "<a href='users.php'>View users</a>";
}

?>





<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Firstname</label>
        <input type="text" class="form-control" name="user_firstname" id="">
    </div>
    <div class="form-group">
        <label for="post_category">Lastname</label>
        <select name="user_role" class="form-control">
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>
    </div>
    <div class="form-group">
        <label for="title">Lastname</label>
        <input type="text" class="form-control" name="user_lastname" id="">
    </div>
    <div class="form-group">
        <label for="title">Username</label>
        <input type="text" class="form-control" name="username" id="">
    </div>
    <!-- <div class="form-group">
        <label for="title">Post Image</label>
        <input type="file" class="form-control" name="image" id="">
    </div> -->
    <div class="form-group">
        <label for="title">Email</label>
        <input type="text" class="form-control" name="user_email" id="">
    </div>
    <div class="form-group">
        <label for="title">Password</label>
        <input type="password" class="form-control" name="user_password" id="">
    </div>




    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" value="Add User">
    </div>
</form>