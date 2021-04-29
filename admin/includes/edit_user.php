<?php


if (isset($_GET['user_id'])) {
    $the_user_id = $_GET['user_id'];

    $query = "SELECT * FROM users where user_id = {$the_user_id}";
    $select_user = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_user)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
    }
}


if (isset($_POST['edit_user'])) {


    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    // $post_image = $_FILES['image']['name'];
    // $post_image_temp = $_FILES['image']['tmp_name'];


    // move_uploaded_file($post_image_temp, "../images/$post_image");
    $query = "SELECT randSalt from users";
    $select_randsalt_query = mysqli_query($connection, $query);
    confirmQuery($select_randsalt_query);

    $row = mysqli_fetch_array($select_randsalt_query);
    $salt = $row['randSalt'];
    $hashed_password = crypt($user_password, $salt);

    $query = "UPDATE users SET username = '$username', user_email = '$user_email', user_password = '$user_password', user_role = '$user_role', user_firstname = '$user_firstname', user_lastname = '$user_lastname' where user_id = '$user_id'";
    $update_user_query = mysqli_query($connection, $query);
    confirmQuery($update_user_query);
    header('Location: users.php');
}

?>





<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Firstname</label>
        <input type="text" value="<?php echo $user_firstname ?>" class="form-control" name="user_firstname" id="">
    </div>
    <div class="form-group">
        <label for="post_category">Lastname</label>
        <select name="user_role" class="form-control">
            <option value="admin" <?php if ($user_role == "admin") echo "selected" ?>>Admin</option>
            <option value="subscriber" <?php if ($user_role == "subscriber") echo "selected" ?>>Subscriber</option>
        </select>
    </div>
    <div class="form-group">
        <label for="title">Lastname</label>
        <input type="text" value="<?php echo $user_lastname ?>" class="form-control" name="user_lastname" id="">
    </div>
    <div class="form-group">
        <label for="title">Username</label>
        <input type="text" value="<?php echo $username ?>" class="form-control" name="username" id="">
    </div>
    <!-- <div class="form-group">
        <label for="title">Post Image</label>
        <input type="file" class="form-control" name="image" id="">
    </div> -->
    <div class="form-group">
        <label for="title">Email</label>
        <input type="text" value="<?php echo $user_email ?>" class="form-control" name="user_email" id="">
    </div>
    <div class="form-group">
        <label for="title">Password</label>
        <input type="password" value="<?php echo $user_password ?>" class="form-control" name="user_password" id="">
    </div>




    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_user" value="Update User">
    </div>
</form>