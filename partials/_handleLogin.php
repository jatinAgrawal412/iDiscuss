<?php
$showError = "false";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '_dbconnect.php';
    $user_email = $_POST['loginmail'];
    $pass = $_POST['loginpass'];

    // Check whether this email exists
    $sql = "select * from `users` where email = '$user_email'";
    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);
    if($numRows==1){
        $row = mysqli_fetch_assoc($result);
        // if(password_verify($pass,$row['password'])){
        if($pass == $row['password']){
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['useremail'] = $user_email;
            $_SESSION['sno'] = $row['sno'] ;
            $_SESSION['username'] = $row['user_name'];
            echo $_SESSION['sno'];
            header('Location: ../index.php?loginsuccess=true');
            exit();
        }
        else{
            $showError = "Wrong Password"; 
        }
    }
    else{
        $showError = "Invalid Email or Signup for new account";
    }
    header("Location: ../index.php?loginsuccess=false&error=$showError");
    exit();
}