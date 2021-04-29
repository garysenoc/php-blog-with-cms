<?php

include "db.php";
session_start();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_escape_string($connection, $username);
    $password = mysqli_escape_string($connection, $password);


    $query = "SELECT * FROM users WHERE username = '$username'";
    $select_user_query = mysqli_query($connection, $query);

    if (!$select_user_query) {
        die("QUERY FAILED" . mysqli_error($connection));
    }
    while ($row = mysqli_fetch_assoc($select_user_query)) {
        $user_id = $row['user_id'];
        $user_username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_role = $row['user_role'];
        $user_rand = $row['randSalt'];
    }
    $password = crypt($user_rand, $password);

    if ($username == $user_username && $password == $user_password) {
        $_SESSION['username'] = $user_username;
        $_SESSION['firstname'] = $user_firstname;
        $_SESSION['lastname'] = $user_lastname;
        $_SESSION['user_role'] = $user_role;
        header("Location: ../admin");
    } else {
        header("Location: ../index.php");
    }
}
