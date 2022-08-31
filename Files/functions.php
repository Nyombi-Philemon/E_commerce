<?php

$conn = new mysqli('localhost', 'root', '', 'e-commerce');

if (session_status() == PHP_SESSION_NONE) {
session_start();
}
#logic to log into the created account by the user

function login_user($email,$password)
{
    global $conn;
    $sql = "SELECT * FROM users WHERE email = '{$email}'";
    $res = $conn->query($sql);
    
    if($res->num_rows < 1) {
        echo "<b>User not found</b>";
    }
    $row = $res->fetch_assoc();

    if (!password_verify($password,$row['password'])) {
echo "<b>Wrong password entered</b>";
    }

    $_SESSION['user'] = $row;

    return true;
    
    echo"<pre>";
    print_r($row);

}
