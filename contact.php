<?php


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to iDiscuss - coding forums</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behaviour: smooth;
        }


        .img {
            width: 33%;
            border: 2px solid white;
            border-radius: 50px;
        }

        .background {
            background-color: grey;
            background-blend-mode: darken;
            background-size: cover;
        }

        .box-main {
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            max-width: 50%;
            margin: auto;
            height: 80%;
        }

        .firstHalf {
            width: 75%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .firstHalf img {
            display: flex;
            border-radius: 9050px;
        }

        .text-big {
            font-family: "Piazzolla", serif;
            font-weight: bold;
            font-size: 41px;
            text-align: center;
        }

        .text-small {
            font-family: "Sansita Swashed", cursive;
            font-size: 18px;
            text-align: center;
        }

        #service {
            margin: 34px;
            display: flex;
            min-height: 65vh;
        }

        #service .box {
            padding: 45px;
            margin: 3px 6px;
            border-radius: 28px;
        }

        #service .box img {
            margin-top: 20px;
            height: 100px;
            margin: auto;
            display: block;
            border-radius: 200px;
        }

        #service .box p {
            font-family: sans-serif;
            text-align: center;
        }



        .center {
            text-align: center;
        }

        .text-footer {
            text-align: center;
            padding: 30px 0;
            font-family: "Ubuntu", sans-serif;
            display: flex;
            justify-content: center;
        }
    </style>
</head>

<body>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>
    <section class="service">

        <!-- Heading-->
        <h1 class="h-primary center" style="margin-top:30px;">
            Options to Contact
        </h1>
        <div id="service">
            <div class="box">
                <!-- Form -->
                <img src="https://media.geeksforgeeks.org/wp-content/uploads/20211220070335/color.png" alt="color_image">
                <br>

                <!-- Displaying text at
                     the center of the box-->
                <p class="center">
                    People can fill up the form and send us the problem<br>
                    <button class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#contect">Form for your problem</button>
                <div class="modal fade" id="contect" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="loginModalLabel">Share your problem to us</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="POST">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                                        <input type="email" class="form-control" id="loginmail" name="loginmail" aria-describedby="emailHelp">
                                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="example">Subject</label>
                                        <textarea class="form-control" id="subject" name="subject" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                </p>

            </div>

            <div class="box">

                <!-- Email -->
                <img src="https://media.geeksforgeeks.org/wp-content/uploads/20211220070335/color.png" alt="color_image">
                <br>

                <!-- Displaying text at
                     the center of the box-->
                <p class="center">
                    Use this Email to send us about the problem faced<br>
                    <b>ajagrawal412@gmail.com</b>
                </p>

            </div>
            <div class="box">
                <img src="https://media.geeksforgeeks.org/wp-content/uploads/20211220070335/color.png" alt="color_image">
                <br>

                <!-- Displaying text at
                     the center of the box-->
                <p class="center">
                    Toll Free Number:+1800 200 300 400
                </p>

            </div>
        </div>
    </section>
    <?php include 'partials/_footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>