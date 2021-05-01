<?php

function users_online()
{
    global $connection;
    if (isset($_GET['onlineusers'])) {



        if (!$connection) {
            global $connection;
            session_start();
            include("../includes/db.php");

            $session = session_id();
            $time = time();
            $time_out_in_seconds = 30;
            $time_out = $time - $time_out_in_seconds;

            $query = "SELECT * FROM users_online WHERE session = '$session'";
            $send_query = mysqli_query($connection, $query);
            $count = mysqli_num_rows($send_query);

            if ($count == null) {
                mysqli_query($connection, "INSERT INTO users_online(session,time) VALUES('$session','$time')");
            } else {
                mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
            }

            $users_online_query = mysqli_query($connection, "SELECT * FROM  users_online WHERE time > $time_out");
            return $count_user = mysqli_num_rows($users_online_query);
        }
    }
    $session = session_id();
    $time = time();
    $time_out_in_seconds = 30;
    $time_out = $time - $time_out_in_seconds;

    $query = "SELECT * FROM users_online WHERE session = '$session'";
    $send_query = mysqli_query($connection, $query);
    $count = mysqli_num_rows($send_query);

    if ($count == null) {
        mysqli_query($connection, "INSERT INTO users_online(session,time) VALUES('$session','$time')");
    } else {
        mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
    }

    $users_online_query = mysqli_query($connection, "SELECT * FROM  users_online WHERE time > $time_out");
    return $count_user = mysqli_num_rows($users_online_query);
}
users_online();

function confirmQuery($result)
{

    if (!($result)) {
        global $connection;
        die("QUERY FAILED" . mysqli_error($connection));
    }
}


function insert_categories()
{
    if (isset($_POST['submit'])) {
        $cat_title = $_POST['cat_title'];
        global $connection;
        if ($cat_title == "" || empty($cat_title)) {
            echo "This field should not be empty";
        } else {
            $query = "INSERT INTO categories (cat_title) VALUE('{$cat_title}')";
            $create_category_query = mysqli_query($connection, $query);


            if (!$create_category_query) {
                die('QUERY failed' . mysqli_error($connection));
            }
        }
    }
}

function find_all_categories()
{
    global $connection;

    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_categories)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "</tr>";
    }
}

function delete_categories()
{
    global $connection;

    if (isset($_GET['delete'])) {
        $the_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories where cat_id = {$the_cat_id}";
        $delete_query = mysqli_query($connection, $query);
        echo "<script>window.location.href='categories.php'</script>";
    }
}
