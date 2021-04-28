<?php include "./includes/admin_header.php";


if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $query = "SELECT * FROM users where username = '$username'";
    $select_user_profile_query = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_array($select_user_profile_query)) {
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
    $user_username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    // $post_image = $_FILES['image']['name'];
    // $post_image_temp = $_FILES['image']['tmp_name'];


    // move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "UPDATE users SET username = '$user_username', user_email = '$user_email', user_password = '$user_password', user_role = '$user_role', user_firstname = '$user_firstname', user_lastname = '$user_lastname' where username = '$username'";
    $update_user_query = mysqli_query($connection, $query);
    confirmQuery($update_user_query);
    header('Location: users.php');
}



?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "./includes/admin_navigation.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to Admin
                        <small>Author</small>
                    </h1>

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
                            <input type="submit" class="btn btn-primary" name="edit_user" value="Update Profile">
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
<?php include "./includes/admin_footer.php" ?>