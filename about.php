<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to iDiscuss - coding forums</title>
    <link rel="stylesheet" href="about.css" />
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

</head>

<body>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>
    <section>
        <h2 style="text-align: center">Our Founder</h2>
        <div class="my-5 mb-5" style="text-align: center;"><img class='photo' src="po.png" alt="This is Jatin Agrawal" /></div>
        <h3 class="fname my-5 mb-5" style="text-align: center;">Jatin Agrawal</h3>

        <div class="sm-handle my-5 mb-5" style="text-align: center;">
            <a href="https://www.youtube.com/channel/UCfprIoWED5xIfUnBIpdbAsQ" target="_blank" rel="noopener noreferrer" class="yt_handle"><i class="fa fa-youtube fa-lg"></i> YouTube</a>&nbsp;&nbsp;|&nbsp;&nbsp;
            <a href="https://www.linkedin.com/in/agrawal-jatin-971b4b227/" target="_blank" rel="noopener noreferrer" class="li_handle"><i class="fa fa-linkedin fa-lg"></i>LinkedIn</a>&nbsp;&nbsp;|&nbsp;&nbsp;
            <a href="https://www.instagram.com/_a_j_style_7621/" target="_blank" rel="noopener noreferrer" class="in_handle"><i class="fa fa-instagram fa-lg"></i>Instagram</a>
        </div>
        <div class="about_us text-center my-5 mb-5">
            <h3 class="about_title"><b>
                    Empowering the world to develop technology through collective knowledge.
                </b>
            </h3>
            <h5 class="about_contain text-center my-5">
                Our public platform serves 100 million people every month, making it one of the most popular websites in the world.
                <br>
                <br>
                Our asynchronous knowledge management and collaboration offering, iDiscuss for Teams, is transforming how people work.
                <br>
                <br>
                iDiscuss helps people find the answers they need, when they need them. We're best known for our public Q&A platform that over 100 million people visit every month to ask questions, learn, and share technical knowledge.
            </h5>
        </div>
    </section>
    <?php include 'partials/_footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>