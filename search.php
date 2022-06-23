<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to iDiscuss - coding forums</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>
    <!-- Search Results -->
    <div class="container my-3">
        <h1 class="my-4">Search results for <em>"<?php echo $_GET['search'] ?>"</em></h1>

        <?php
        $noResult = true;
        $bc = $_GET['search'];
        $sql = "SELECT * FROM `threads` where match(thread_title,thread_desc) against ('$bc');";
        $result = mysqli_query($conn, $sql);
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
            <p class="mt-0 md-0"><a class="
            text-dark fw-bold" href="thread.php?thId=' . $thId . '">' . $thTitle . '</a></p>
            <p><b>Asked By: </b><em>' . $posted_by . '</em> at ' . $time . '</p>
            ' . $thDesc . '
            </div>
            </fieldset>
            </div>';
        }
        $sql1 = "SELECT * FROM `users` where match(user_name,email) against ('${bc}');";
        $result_1 = mysqli_query($conn, $sql1);
        while ($row = mysqli_fetch_assoc($result_1)) {
            $noResult = false;
            $user_name = $row['user_name'];
            $email = $row['email'];
            $user_id = $row['sno'];
            $roll = $row['roll1'];
            $pic = $row['pic'];
            echo '
        <div class="container my-4">
            <div class="container" style="background-color: #CCD1D1;">
                <div style="padding:40px 40px 40px 40px">
                    <div class="d-flex my-2">
                        <div class="flex-shrink-0">
                            <img src="data:image;base64,' . base64_encode($row['pic']) . '" width="100px" alt="...">
                        </div>
                        <div class="flex-grow-1 ms-3 ">
                            <h3 class="display-4 mx-5"><a class="
                            text-dark  fw-bold" href="users.php?userid=' . $user_id . '">' . $user_name . '</a></h3>
                            <p class="lead mx-5"><em>' . $email . '</em></p>
                            <p class="lead mx-5"><em>' . $roll . '</em></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
        }
        if ($noResult) {
            echo '<div class="container my-4">
            <div class="container" style="background-color: #CCD1D1;">
            <div style="padding:40px 40px 40px 40px">
            <h2>No Result Found</h2>
            <p class="lead">Suggestions:
            <li>Make sure that all words are spelled correctly.</li>
            <li>Try different keywords.</li>
            <li>Try more general keywords.</li>
            </p>
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