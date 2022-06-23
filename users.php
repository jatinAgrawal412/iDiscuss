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
    $userid = $_GET['userid'];
    $sql = "SELECT * FROM `users` where sno  = ${userid}";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $user_name = $row['user_name'];
    $email = $row['email'];
    $roll = $row['roll1'];
    $pic = $row['pic'];
    ?>
    <!-- Category container starts here -->
    <div class="container my-4">
        <div class="container" style="background-color: #CCD1D1;">
            <div style="padding:40px 40px 40px 40px">
                <div class="d-flex my-2">
                    <div class="flex-shrink-0">
                        <img src="data:image;base64,<?php echo base64_encode($row['pic']); ?>" width="100px" alt="...">
                    </div>
                    <div class="flex-grow-1 ms-3 ">
                        <h3 class="display-4 mx-5"><?php echo $user_name; ?></h3>
                        <p class="lead mx-5"><em><?php echo $email; ?></em></p>
                        <p class="lead mx-5"><em><?php echo $roll; ?></em></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mb-5" style="min-height:50vh ;">
        <h2 class="my-2">Posted Threads</h2>
        <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        $limit = 3;
        $offset = ($page - 1) * $limit;
        $sql = "SELECT * FROM `threads` where thread_user_id = ${userid} LIMIT ${offset},${limit}";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $thId = $row['thread_id'];
            $thTitle = $row['thread_title'];
            $thDesc = $row['thread_desc'];
            $time = $row['timestamp'];
            echo ' <div class="d-flex my-2" style="padding: 13px; border: 2px solid black;">
            <div class="flex-shrink-0">
            <fieldset>
            <a href=""><img src="data:image;base64,' . base64_encode($pic) . '" width="50px" alt="..."></a>
            </div>
            <div class="flex-grow-1 ms-3 ">
            <p class="mt-0 mb-0"><a class="
            text-dark fw-bold" href="thread.php?thId=' . $thId . '">' . $thTitle . '</a></p>
            <p><b>Asked By: </b><em>' . $user_name . '</em> at ' . $time . '</p>
            ' . $thDesc . '
            </div>
            </fieldset>
            </div>';
        }


        if ($noResult) {
            echo '<div class="container my-4">
            <div class="container" style="background-color: #CCD1D1;">
            <div style="padding:40px 40px 40px 40px">
            <h5>No Threads Found</h5>
            <p class="lead">I not post any thread till now :| !.</p>
            </div>
            </div>
            </div>';
        }
        ?>

        <?php
        $sql = "SELECT * FROM `threads` where thread_user_id = ${userid}";
        $result = mysqli_query($conn, $sql);
        $totalRows = mysqli_num_rows($result);
        if ($totalRows > 0) {
            $total_page = ceil($totalRows / $limit);
            echo '<nav aria-label="Page navigation example">
            <ul class="pagination">';
            if ($page > 1) {
                echo '<li class="page-item"><a class="btn btn-success mx-1" href="users.php?userid=' . $userid . '&page=' . $page - 1 . '">Previous</a></li>';
            } else {
                echo '<li class="page-item"><a class="btn btn-success mx-1 disabled" href="users.php?userid=' . $userid . '&page=' . $page - 1 . '">Previous</a></li>';
            }
            for ($i = 1; $i <= $total_page; $i++) {
                if ($page == $i) {
                    echo '<li class="page-item"><a class="btn btn-outline-success mx-1" href="users.php?userid=' . $userid . '&page=' . $i . '">' . $i . '</a></li>';
                } else {
                    echo '<li class="page-item"><a class="btn btn-success mx-1" href="users.php?userid=' . $userid . '&page=' . $i . '">' . $i . '</a></li>';
                }
            }
            if ($page < $total_page) {
                echo '<li class="page-item"><a class="btn btn-success mx-1" href="users.php?userid=' . $userid . '&page=' . $page + 1 . '">Next</a></li>';
            } else {
                echo '<li class="page-item"><a class="btn btn-success mx-1 disabled" href="users.php?userid=' . $userid . '&page=' . $page + 1 . '">Next</a></li>';
            }
            echo '
            </ul>
            </nav>';
        }

        ?>
    </div>



    <div class="container mb-5">
        <h2 class="my-2">Posted Comments</h2>
        <?php
        $sql = "SELECT * FROM `comments` where user_id = ${userid}";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $content = $row['comment_content'];
            $time1 = $row['comment_time'];
            $thid = $row['thread_id'];
            $sql_user = "SELECT * FROM `threads` where thread_id   = '$thid'";
            $result_user = mysqli_query($conn, $sql_user);
            while ($row5 = mysqli_fetch_assoc($result_user)) {
                $thId = $row5['thread_id'];
                $thTitle = $row5['thread_title'];
                $thDesc = $row5['thread_desc'];
                $time2 = $row5['timestamp'];
                $uid = $row5['thread_user_id'];
                $sql = "SELECT * FROM `users` where sno  = ${uid}";
                $resultu = mysqli_query($conn, $sql);
                $row6 = mysqli_fetch_assoc($resultu);
                echo ' <div class="my-2" style="padding: 13px; border: 2px solid black;">
                <div>
                <div class="d-flex my-2">
                <div class="flex-shrink-0">
                <a href="users.php?userid=' . $row6['sno'] . '"><img src="data:image;base64,' . base64_encode($row6['pic']) . '" width="50px" alt="..."></a>
                </div>
                <div class="flex-grow-1 ms-3 ">
                <p class="mt-0 mb-0"><a class="
                text-dark fw-bold" href="thread.php?thId=' . $thId . '">' . $thTitle . '</a></p>
                <p><b>Asked By: </b><em>' . $row6['user_name'] . '</em> at ' . $time1 . '</p>
                ' . $thDesc . '
                </div>
                </div>
                </div>
                <b><em>Comment</em></b>
            <hr>
            <div>
            <div class="d-flex my-2">
            <div class="flex-shrink-0">
                <img src="data:image;base64,' . base64_encode($pic) . '" width="50px" alt="...">
                </div>
                <div class="flex-grow-1 ms-3 ">
            <p class="mt-0"><a class="
            text-dark  fw-bold" href="users.php?userid=' . $userid . '">' . $user_name .  '</a>  at ' . $time2 . '</p>' . $content .  '
            </div>
            </div>
            </div>
            </div>';
            }
        }

        if ($noResult) {
            echo '<div class="container my-4">
            <div class="container" style="background-color: #CCD1D1;">
            <div style="padding:40px 40px 40px 40px">
            <h5>No Threads Found</h5>
            <p class="lead">I not post any Comment till now :| !.</p>
            </div>
            </div>
            </div>';
        }
        ?>
    </div>

    <?php include 'partials/_footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>