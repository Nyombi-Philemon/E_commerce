<?php


require_once('Files/functions.php');

$email = trim($_POST['email']);
$password = trim($_POST['password']);
$password_1 = trim($_POST['password_1']);
$phone_number = trim($_POST['phone_number']);
$first_name = trim($_POST['first_name']);
$last_name = trim($_POST['last_name']);
$user_name = trim($_POST['user_name']);
$creatted = time();
$address = trim($_POST['address']);

if($password != $password_1){
    die('Passwords did not match');
}
$sql = "SELECT * FROM users WHERE email = '{$email}'";
$res = $conn->query($sql);

if($res->num_rows > 0){
    die("User with a similar email already exists.");
}

$password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (
    first_name,
    last_name,
    user_name,
    phone_number,
    password,
    email,
    address,
    user_type,
    creatted
 ) VALUES (
    '{$first_name}',
    '{$last_name}',
    '{$user_name}',
    '{$phone_number}',
    '{$password}',
    '{$email}',
    '{$address}',
    'customer',
    '{$creatted}'
    )";

if($conn->query($sql)){
    login_user($email,$password);
    header('Location: account-orders.php');
}else{
die('Failed to create account');
}