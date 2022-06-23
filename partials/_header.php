<?php
session_start();
echo '  <nav class="navbar navbar-dark navbar-expand-lg bg-dark">
<div class="container-fluid">
  <a class="navbar-brand" href="index.php">iDiscuss</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Top categories
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';

          $sql= "SELECT categories_name,categories_id from `categories` LIMIT 3 ";
          $result = mysqli_query($conn,$sql);
          while($row = mysqli_fetch_assoc($result)){
            echo '<li><a class="dropdown-item" href="threadList.php?catid=' . $row['categories_id'] . '">'.$row['categories_name'].'</a></li>';
          }
          echo '<li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="#">Something else here</a></li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact.php">Contact</a>
      </li>
    </ul>
    <form class="d-flex" role="search" method="get" action="search.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
      <button class="btn btn-success" type="submit">Search</button>
    </form>';
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
      echo '<p class="text-light my-0 mx-2">Welcome '.$_SESSION['username'].'</p>';
      echo '<a href="partials/_logout.php" class="btn btn-outline-success mx-2">Logout</a>';
    }
    else{
      echo '<button class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
      <button class="btn btn-outline-success mr-2" data-bs-toggle="modal" data-bs-target="#signedupModal">Signed Up</button>';
    }
    echo '</div>
        </div>
        </nav>';
include 'partials/_login.php';
include 'partials/_signedup.php';
if(isset($_GET['signupsuccess'])&&$_GET['signupsuccess']=="true"){
  echo'<div class="alert alert-success my-0 alert-dismissible fade show" role="alert">
  <strong>Success! </strong>You can now login
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
else if(isset($_GET['signupsuccess'])&&$_GET['signupsuccess']=="false"){
  echo'<div class="alert alert-danger my-0 alert-dismissible fade show" role="alert">
  <strong>Danger! </strong> '.$_GET['error'].'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
else if(isset($_GET['loginsuccess'])&&$_GET['loginsuccess']=="false"){
  echo'<div class="alert alert-danger my-0 alert-dismissible fade show" role="alert">
  <strong>Danger! </strong> '.$_GET['error'].'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
else if(isset($_GET['loginsuccess'])&&$_GET['loginsuccess']=="true"){
  echo'<div class="alert alert-success my-0 alert-dismissible fade show" role="alert">
  <strong>Success! </strong>You are login
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
?>
