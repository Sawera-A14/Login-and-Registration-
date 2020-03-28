<?php

// <!-- login coding session starting -->
session_start();
require_once('connection.php');
if(isset($_POST['log']))
{
    $c_email = $_POST['lemail'];
    $c_pass = $_POST['lpass'];
    // password encryption for security purpose
    // today's assignment
    $c_enc = md5($c_pass);

    if(empty($c_email) || empty($c_enc))
    {
        header('location:register.php?lwarn= Fill both fields..');
    }   
    else
    {
    $check = mysqli_query($con,"SELECT * from userdata where email='$c_email' and password='$c_enc'");
    if(mysqli_fetch_array($check))
    {
        $_SESSION['user'] = $c_email;
        header('location:interface.php');
    }else
    {
        header('location:register.php?inc= Incorrect username or password..');
    }
    }
}

// <!-- registration coding -->
if(isset($_POST['reg']))
{
    $uname = $_POST['username'];
    $uemail = $_POST['email'];
    $upswd = $_POST['pass'];
    $enc_p = md5($upswd);

    if(empty($uname) || empty($uemail) || empty($enc_p))
    {
        header('location:register.php?warn= all fields are required');
    }else
    {
    $ins_data = mysqli_query($con,"INSERT into userdata(username,email,password) values('$uname','$uemail','$enc_p')");
    if($ins_data)
    {
       header('location:register.php?success=Your account has been created successfully..');
    }
}
}
?>