<?php
require_once("loader.php");


if(isset($_POST['email_address'])){

  $first_name     = $_POST['first_name'];
  $last_name      = $_POST['last_name'];
  $email_address  = $_POST['email_address'];
  $password       = $_POST['password'];

  $query = mysqli_query($conn, "insert into users(first_name, last_name, email_address, password) values ('$first_name','$last_name','$email_address','$password')");

  if($query){
    $notice = 'User registered successfully.';
  }else{
    $notice = 'Unable to register user, other error.' . mysqli_error($conn);
  }


}


?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.98.0">
    <title>Sign Up Now</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/sign-in/">





<link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
    </style>


    <!-- Custom styles for this template -->
    <link href="assets/css/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">

<main class="form-signin w-100 m-auto">
  <form action="" enctype="multipart/form-data" method="post">
    <img class="mb-4" src="assets/images/bootstrap-logo.svg" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Sign Up</h1>

    <?php echo $notice; ?>

    <div class="form-floating">
      <input type="text" class="form-control" id="floatingInput1" placeholder="Your First Name" name="first_name">
      <label for="floatingInput1">Your First Name</label>
    </div>
    <div class="form-floating">
      <input type="text" class="form-control" id="floatingInput2" placeholder="Your Last Name" name="last_name">
      <label for="floatingInput2">Last Name</label>
    </div>
    <div class="form-floating">
      <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email_address">
      <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
      <label for="floatingPassword">Password</label>
    </div>


    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign Up Now</button>
    <p><a href="login.php"/>Sign In</a></p>
    <p class="mt-5 mb-3 text-muted">&copy; 2017???2022</p>
  </form>
</main>



  </body>
</html>
