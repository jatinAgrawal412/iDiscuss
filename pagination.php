<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to iDiscuss - coding forums</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <style>
        #ques {
            min-height: 85vh;
        }

        #abc {
            display: flex;
        }

        .main {
            display: flex;
            margin: auto;
        }

        .but {
            display: block;
            list-style: none;
            font-size: 1.3rem;
        }

        .ch {
            border: 1px;
            color: white;
            background: #198754;
            text-decoration: none;
            padding: 3px 27px;
            text-align: center;
            border-radius: 0.375rem;
        }

        #active {
            text-decoration: none;
            padding: 3px 27px;
            text-align: center;
            border-radius: 0.375rem;
            border: 1px solid #198754;
            color: #198754;
        }

        #active:hover {
            background-color: #198754;
            color: white;
        }

        .ch:hover {
            background-color: #146c43;
            color: white;
        }
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
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` where categories_id = ${id}";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $catName = $row['categories_name'];
        $catDesc = $row['categories_description'];
    }

    ?>

    <?php
    $showAlert = false;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //Insert data into thread db
        $th_title = $_POST['title'];
        $th_title = str_replace("<", "&lt;", $th_title);
        $th_title = str_replace(">", "&gt;", $th_title);
        $th_desc = $_POST['desc'];
        $th_desc = str_replace("<", "&lt;", $th_desc);
        $th_desc = str_replace(">", "&gt;", $th_desc);

        $sql = "INSERT INTO `threads` (`thread_title`,`thread_desc`,`thread_cat_id`,`thread_user_id`,`timestamp`) VALUES ('$th_title','$th_desc','$id','$sno',current_timestamp());";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
    }
    if ($showAlert) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your thread has been added! Please wait for community to respond
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    }

    ?>


    <!-- Category container starts here -->
    <div class="container my-4">
        <div class="container" style="background-color: #CCD1D1;">
            <div style="padding:40px 40px 40px 40px">
                <h3>Welcome to <?php echo $catName; ?> forums</h3>
                <p class="lead"><?php echo $catDesc; ?></p>
                <hr class="my-4">
                <p>This is a peer to peer forum. No Spam / Advertising / Self-promote in the forums is not allowed. Do not post copyright-infringing material. Do not post “offensive” posts, links or images. Do not cross post questions. Remain respectful of other members at all times.</p>
                <p>Posted by:<b>Jatin</b></p>
                <!-- <p>Posted by: <em><?php echo $posted_by; ?></em></p> -->
            </div>
        </div>
    </div>
    <div class="container">
        <h1 class="py-2">Enter Your Thread</h1>
        <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="POST">
            <div class="form-group">
                <label for="exampleInputEmail1">Problem Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="title">
                <small id="title" class="form-text text-muted">Keep your title as short and crisp as
                    possible</small>
            </div>
            <div class="form-group">
                <label for="example FormControlTextareal">Ellaborate Your Concern</label>
                <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
            </div>
            <?php
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                echo '<button type="submit" class="btn my-2 btn-success">Submit</button>';
            } else {
                echo '<button type="submit" class="btn my-2 btn-success" disabled>Submit</button>';
                echo '<p class="lead">You are not logged in.please login to be able to start Discussion.</p>';
            }
            ?>
        </form>
    </div>

    <div class="container  mb-3" id="ques">
        <h2 class="my-2">Browse Questions</h2>
        <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        $limit = 3;
        $offset = ($page - 1) * $limit;
        $sql = "SELECT * FROM `threads` where thread_cat_id = ${id} LIMIT ${offset},${limit}";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $thId = $row['thread_id'];
            $thTitle = $row['thread_title'];
            $thDesc = $row['thread_desc'];
            $time = $row['timestamp'];
            $th_user_id = $row['thread_user_id'];
            $sql_user = "SELECT * FROM `users` where sno  = ${th_user_id}";
            $result_user = mysqli_query($conn, $sql_user);
            $row_user = mysqli_fetch_assoc($result_user);
            $posted_by = $row_user['email'];
            echo ' <div class="d-flex my-2" style="padding: 13px; border: 2px solid black;">
            <div class="flex-shrink-0">
            <fieldset>
            <img src="image/download.png" width="50px" alt="...">
            </div>
            <div class="flex-grow-1 ms-3 ">
            <p class="mt-0 mb-0"><a class="
            text-dark fw-bold" href="thread.php?thId=' . $thId . '">' . $thTitle . '</a></p>
            <p><b>Asked By: </b><em>' . $posted_by . '</em> at ' . $time . '</p>
            ' . $thDesc . '
            </div>
            </fieldset>
            </div>';
        }

        if ($noResult) {
            echo '<div class="container my-4">
            <div class="container" style="background-color: #CCD1D1;">
                <div style="padding:40px 40px 40px 40px">
                    <h5>No Thread Found</h5>
                    <p class="lead">Be the First persion to ask quetion.</p>
                </div>
            </div>
        </div>';
        }

        ?>

        <?php
        $sql = "SELECT * FROM `threads` where thread_cat_id = ${id}";
        $result = mysqli_query($conn, $sql);
        $totalRows = mysqli_num_rows($result);
        if ($totalRows > 0) {
            $total_page = ceil($totalRows / $limit);
            echo '<div class="my-2 mb-5" id="abc">
            <ul class="main">';
            if ($page > 1) {
                echo '<li class="but mx-1"><a href="threadList.php?catid=' . $id . '&page=' . $page - 1 . '" class="ch">Prev</a></li>';
            }
            for ($i = 1; $i <= $total_page; $i++) {
                if ($page == $i) {
                    echo '<li class="but mx-1"><a href="threadList.php?catid=' . $id . '&page=' . $i . '" id="active">' . $i . '</a></li>';
                } else {
                    echo '<li class="but mx-1"><a href="threadList.php?catid=' . $id . '&page=' . $i . '" class="ch">' . $i . '</a></li>';
                }
            }
            if ($page < $total_page) {
                echo '<li class="but mx-1"><a href="threadList.php?catid=' . $id . '&page=' . $page + 1 . '" class="ch">Next</a></li>';
            }
            echo '</ul>
            </div>';
        }

        ?>


    </div>
    <?php include 'partials/_footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>