<?php
include "db_connection.php";
// session_start();

// Redirect to dashboard if already logged in
// if (isset($_SESSION['email'])) {
//     header("Location: dashboard.php");
//     exit();
// }

$errors = []; // Initialize errors array

// Handle form submission
if (isset($_POST['register'])) {
    // Fetch data from input fields
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $pass = mysqli_real_escape_string($connection, $_POST['pass']);
    $c_pass = mysqli_real_escape_string($connection, $_POST['c_pass']);

    // Check if email already exists
    $checkEmailQuery = "SELECT * FROM academic_register WHERE email='$email'";
    $checkEmailResult = mysqli_query($connection, $checkEmailQuery);

    if (mysqli_num_rows($checkEmailResult) > 0) {
        $errors['email'] = "Email already exists.";
    }

    // Validate password length
    if (strlen($pass) < 8) {
        $errors['password'] = "Password must be at least 8 characters long.";
    }

    // Confirm passwords match
    if ($pass !== $c_pass) {
        $errors['c_password'] = "Passwords do not match.";
    }

    if (empty($errors)) {
        // Hash password before storing
        $hashed_pass = password_hash($pass, PASSWORD_BCRYPT);

        // Query to insert data into the database
        $query = "INSERT INTO academic_register (username, email, password) VALUES ('$username', '$email', '$hashed_pass')";
        $query_result = mysqli_query($connection, $query);

        if ($query_result) {
            header("Location: login.php");
            exit();
        } else {
            $errors['general'] = "Something went wrong. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Academics &mdash; Website by Colorlib</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">
  <link rel="stylesheet" href="fonts/icomoon/style.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/jquery.fancybox.min.css">
  <link rel="stylesheet" href="css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
  <link rel="stylesheet" href="css/aos.css">
  <link href="css/jquery.mb.YTPlayer.min.css" media="all" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
  <div class="site-wrap">
    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>

    <div class="py-2 bg-light">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-9 d-none d-lg-block">
            <a href="#" class="small mr-3"><span class="icon-question-circle-o mr-2"></span> Have a question?</a> 
            <a href="#" class="small mr-3"><span class="icon-phone2 mr-2"></span> 10 20 123 456</a> 
            <a href="#" class="small mr-3"><span class="icon-envelope-o mr-2"></span> info@mydomain.com</a> 
          </div>
          <div class="col-lg-3 text-right">
            <a href="login.html" class="small mr-3"><span class="icon-unlock-alt"></span> Log In</a>
            <a href="register.html" class="small btn btn-primary px-4 py-2 rounded-0"><span class="icon-users"></span> Register</a>
          </div>
        </div>
      </div>
    </div>

    <header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">
      <div class="container">
        <div class="d-flex align-items-center">
          <div class="site-logo">
            <a href="index.html" class="d-block">
              <img src="images/logo.jpg" alt="Image" class="img-fluid">
            </a>
          </div>
          <div class="mr-auto">
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                <li><a href="index.html" class="nav-link text-left">Home</a></li>
                <li class="has-children">
                  <a href="about.html" class="nav-link text-left">About Us</a>
                  <ul class="dropdown">
                    <li><a href="teachers.html">Our Teachers</a></li>
                    <li><a href="about.html">Our School</a></li>
                  </ul>
                </li>
                <li><a href="admissions.html" class="nav-link text-left">Admissions</a></li>
                <li><a href="courses.html" class="nav-link text-left">Courses</a></li>
                <li><a href="contact.html" class="nav-link text-left">Contact</a></li>
              </ul>
            </nav>
          </div>
          <div class="ml-auto">
            <div class="social-wrap">
              <a href="#"><span class="icon-facebook"></span></a>
              <a href="#"><span class="icon-twitter"></span></a>
              <a href="#"><span class="icon-linkedin"></span></a>
              <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black">
                <span class="icon-menu h3"></span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </header>

    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('images/bg_1.jpg')">
        <div class="container">
          <div class="row align-items-end justify-content-center text-center">
            <div class="col-lg-7">
              <h2 class="mb-0">Register</h2>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p>
            </div>
          </div>
        </div>
      </div> 

    <div class="custom-breadcrumns border-bottom">
      <div class="container">
        <a href="index.html">Home</a>
        <span class="mx-3 icon-keyboard_arrow_right"></span>
        <span class="current">Register</span>
      </div>
    </div>

    <div class="site-section">
        <div class="container">
            <form action="" method="POST" onsubmit="return validateForm()">
                <div class="row justify-content-center">
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control form-control-lg">
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control form-control-lg">
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="pass">Password</label>
                                <input type="password" name="pass" id="pass" class="form-control form-control-lg">
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="c_pass">Re-type Password</label>
                                <input type="password" name="c_pass" id="c_pass" class="form-control form-control-lg">
                            </div>
                            <?php if (!empty($errors)): ?>
                                <div class="col-md-12 form-group">
                                    <div class="alert alert-danger">
                                        <?php foreach ($errors as $error): ?>
                                            <p><?php echo $error; ?></p>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="col-12">
                                <input type="submit" name="register" value="Register" class="btn btn-primary btn-lg px-5">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
  </div>
  
  <footer class="footer-section bg-white">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <h3>About Academics</h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae minima assumenda repellat harum possimus accusantium.</p>
        </div>
        <div class="col-md-3 ml-auto">
          <h3>Links</h3>
          <ul class="list-unstyled footer-links">
            <li><a href="#">Home</a></li>
            <li><a href="#">Courses</a></li>
            <li><a href="#">Programs</a></li>
            <li><a href="#">Teachers</a></li>
            <li><a href="#">Contact</a></li>
          </ul>
        </div>
        <div class="col-md-4">
          <h3>Subscribe</h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt incidunt iure iusto architecto?</p>
          <form action="#" class="footer-subscribe">
            <div class="d-flex mb-5">
              <input type="text" class="form-control rounded-0" placeholder="Email">
              <input type="submit" class="btn btn-primary rounded-0" value="Subscribe">
            </div>
          </form>
        </div>
      </div>
    </div>
  </footer>
  
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/bootstrap-datepicker.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.fancybox.min.js"></script>
  <script src="js/jquery.sticky.js"></script>
  <script src="js/jquery.mb.YTPlayer.min.js"></script>
  <script src="js/main.js"></script>
  <script>
    function validateForm() {
      const username = document.getElementById('username').value;
      const email = document.getElementById('email').value;
      const pass = document.getElementById('pass').value;
      const c_pass = document.getElementById('c_pass').value;
      let errors = [];

      if (username === '') {
        errors.push("Username is required.");
      }
      if (email === '') {
        errors.push("Email is required.");
      }
      if (pass === '') {
        errors.push("Password is required.");
      } else if (pass.length < 8) {
        errors.push("Password must be at least 8 characters long.");
      }
      if (c_pass === '') {
        errors.push("Re-type Password is required.");
      } else if (pass !== c_pass) {
        errors.push("Passwords do not match.");
      }

      if (errors.length > 0) {
        alert(errors.join("\n"));
        return false;
      }
      return true;
    }
  </script>
</body>
</html>
