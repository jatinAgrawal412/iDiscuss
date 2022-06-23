<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to iDiscuss - coding forums</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <style>
        #ques {
            min-height: 433px;
        }
    </style>
</head>

<body>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>
    <!-- Slider -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://source.unsplash.com/2400x700/?code,python" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/2400x700/?code,javascript" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/2400x700/?apple,php" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="container my-3" id="ques">
        <h2 class="text-center my-3">iDiscuss - Browse Categories</h2>
        <div class="row">
            <!-- Fetching categories from database -->
            <?php
            $sql = "SELECT * FROM `categories`;";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['categories_id'];
                $cat = $row['categories_name'];
                $desc = $row['categories_description'];
                echo '<div class="col mb-3  my-2">
                    <div class="card" style="width: 18rem;">
                        <img src="data:image;base64,' . base64_encode($row['image']) . '" class=" card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><a href="threadList.php?catid=' . $id . '">' . $cat . '<a></h5>
                            <p class="card-text">' . substr($desc, 0, 180) . '...</p>
                            <a href="threadList.php?catid=' . $id . '" class="btn btn-primary mt-3">View Threads</a>
                        </div>
                    </div>
                </div>';
            }
            ?>

        </div>
    </div>
    <?php include 'partials/_footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>