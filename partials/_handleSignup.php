<?php
$showError = "false";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '_dbconnect.php';

    // Check if there is a file uploaded
    if ($_FILES["image"]["size"] > 0) {
        // echo "There is a file uploaded<br>";
        // Check if its an image
        $check_if_image = getimagesize($_FILES["image"]["tmp_name"]);
        // var_dump($check_if_image);
        if ($check_if_image !== false) {
            $file = addslashes(file_get_contents($_FILES['image']['tmp_name']));
            // echo "Image = " . $check_if_image["mime"] . ".";
        } else {
            $file = null;
        }
    } else {
        $file = null;
    }
    $user_email = $_POST['signupEmail'];
    $user_roll = $_POST['rol'];
    $pass = $_POST['signupPassword'];
    $cpass = $_POST['signupcPassword'];
    $name = $_POST['name'];

    // Check whether this email exists
    $existSql = "select * from `users` where email = '$user_email'";
    $result = mysqli_query($conn, $existSql);
    $numRows = mysqli_num_rows($result);
    if($numRows>0){
        $showError = "Email already in use";
    }
    else{
        if($pass == $cpass){
            // $hash = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_name`,`email`, `password`, `timestamp`,`pic`,`roll1`) VALUES ('$name','$user_email', '$pass', current_timestamp(),'$file','$user_roll')";
            $result = mysqli_query($conn, $sql);
            
            if($result){
                    header("Location: ../index.php?signupsuccess=true");
                exit();
            }

        }
        else{
            $showError = "Passwords do not match"; 
            
        }
    }
    header("Location: ../index.php?signupsuccess=false&error=$showError");

}