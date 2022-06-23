<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to iDiscuss - coding forums</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <style>
    </style>
</head>

<body>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>
    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $sno = $_SESSION['sno'];
    }
    ?>

    <?php
    $thId = $_GET['thId'];
    $sql = "SELECT * FROM `threads` where thread_id = ${thId}";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $thTitle = $row['thread_title'];
        $thDesc = $row['thread_desc'];
        $th_user_id = $row['thread_user_id'];
        $sql_user = "SELECT * FROM `users` where sno  = '$th_user_id'";
        $result_user = mysqli_query($conn, $sql_user);
        $row_user = mysqli_fetch_assoc($result_user);
        $posted_by = $row_user['email'];
    }
    ?>

    <?php
    $showAlert = false;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //Insert data into thread db
        $content1 = $_POST['content'];
        $content1 = str_replace("<", "&lt;", $content1);
        $content1 = str_replace(">", "&gt;", $content1);
        $sql = "INSERT INTO `comments` (`thread_id`, `comment_content`, `user_id`, `comment_time`) VALUES ('$thId','$content1','$sno',current_timestamp());";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
    }
    if ($showAlert) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your comment has been added!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    }

    ?>


    <!-- Category container starts here -->
    <div class="container my-4">
        <div class="container" style="background-color: #CCD1D1;">
            <div style="padding:40px 40px 40px 40px">
                <h3 class="display-4"><?php echo $thTitle; ?></h3>
                <p class="lead"><?php echo $thDesc; ?></p>
                <hr class="my-4">
                <p>This is a peer to peer forum. No Spam / Advertising / Self-promote in the forums is not allowed. Do not post copyright-infringing material. Do not post “offensive” posts, links or images. Do not cross post questions. Remain respectful of other members at all times.</p>
                <p>Posted by: <em><b><?php echo $posted_by; ?></b></em></p>
            </div>
        </div>
    </div>

    <div class="container">
        <h1 class="py-2">Post a comment</h1>
        <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="POST">
            <div class="form-group">
                <label for="example FormControlTextareal">Type comment here</label>
                <textarea class="form-control" id="content" name="content" rows="3"></textarea>
            </div>
            <?php
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                echo '<button type="submit" class="btn my-2 btn-success">Post comment</button>';
            } else {
                echo '<button type="submit" class="btn my-2 btn-success" disabled>Post comment</button>';
                echo '<p class="lead">You are not logged in.please login to be able to Post Comment.</p>';
            }
            ?>
        </form>
    </div>


    <div class="container mb-5">
        <h2 class="my-2">Discussions</h2>
        <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        $limit = 3;
        $offset = ($page - 1) * $limit;
        $sql = "SELECT * FROM `comments` where thread_id = ${thId} LIMIT ${offset},${limit}";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $content = $row['comment_content'];
            $time = $row['comment_time'];
            $id = $row['comment_id'];
            $user_id = $row['user_id'];
            $sql_user = "SELECT * FROM `users` where sno  = '$user_id'";
            $result_user = mysqli_query($conn, $sql_user);
            $row_user = mysqli_fetch_assoc($result_user);
            $posted_by = $row_user['email'];
            echo ' <div class="d-flex my-2" style="padding: 13px; border: 2px solid black;">
            <div class="flex-shrink-0">
            <fieldset>
            <img src="data:image;base64,' . base64_encode($row_user['pic']) . '" width="50px" alt="...">
            </div>
            <div class="flex-grow-1 ms-3 ">
            <p class="mt-0"><a class="
            text-dark  fw-bold" href="users.php?userid=' . $user_id . '">' . $posted_by .  '</a>  at ' . $time . '</p>' . $content .  '
            </div>
            </fieldset>
            </div>';
        }


        if ($noResult) {
            echo '<div class="container my-4">
            <div class="container" style="background-color: #CCD1D1;">
            <div style="padding:40px 40px 40px 40px">
            <h5>No Comments Found</h5>
            <p class="lead">Be the First persion to Comments.</p>
            </div>
            </div>
            </div>';
        }
        ?>

        <?php
        $sql = "SELECT * FROM `comments` where thread_id = ${thId}";
        $result = mysqli_query($conn, $sql);
        $totalRows = mysqli_num_rows($result);
        if ($totalRows > 0) {
            $total_page = ceil($totalRows / $limit);
            echo '<nav aria-label="Page navigation example">
            <ul class="pagination">';
            if ($page > 1) {
                echo '<li class="page-item"><a class="btn btn-success mx-1" href="thread.php?thId=' . $thId . '&page=' . $page - 1 . '">Previous</a></li>';
            } else {
                echo '<li class="page-item"><a class="btn btn-success mx-1 disabled" href="thread.php?thId=' . $thId . '&page=' . $page - 1 . '">Previous</a></li>';
            }
            for ($i = 1; $i <= $total_page; $i++) {
                if ($page == $i) {
                    echo '<li class="page-item"><a class="btn btn-outline-success mx-1" href="thread.php?thId=' . $thId . '&page=' . $i . '">' . $i . '</a></li>';
                } else {
                    echo '<li class="page-item"><a class="btn btn-success mx-1" href="thread.php?thId=' . $thId . '&page=' . $i . '">' . $i . '</a></li>';
                }
            }
            if ($page < $total_page) {
                echo '<li class="page-item"><a class="btn btn-success mx-1" href="thread.php?thId=' . $thId . '&page=' . $page + 1 . '">Next</a></li>';
            } else {
                echo '<li class="page-item"><a class="btn btn-success mx-1 disabled" href="thread.php?thId=' . $thId . '&page=' . $page + 1 . '">Next</a></li>';
            }
            echo '
            </ul>
            </nav>';
        }

        ?>
    </div>

    <?php include 'partials/_footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>