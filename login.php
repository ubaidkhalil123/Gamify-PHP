<?php
session_start();
if (isset($_SESSION['email'])) {
    header("Location: dashboard.php");
    exit();
}

include "db_connection.php";

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($connection, $_POST['loginEmail']);
    $pass = mysqli_real_escape_string($connection, $_POST['loginPassword']);

    $errors = [];

    // Validate email
    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Validate password
    if (empty($pass)) {
        $errors[] = "Password is required.";
    }

    if (empty($errors)) {
        $query = "SELECT * FROM academic_register WHERE email='$email'";
        $query_result = mysqli_query($connection, $query);

        if (mysqli_num_rows($query_result) > 0) {
            $row = mysqli_fetch_assoc($query_result);
            $db_password = $row['password'];
            $user_id = $row['id'];
            $last_login = $row['last_login'];
            $streak = $row['streak'];
            $last_streak_update = $row['last_streak_update'];

            if (password_verify($pass, $db_password)) {
                $_SESSION['email'] = $email;
                $_SESSION['user_id'] = $user_id; // Assuming 'id' is the primary key in academic_register

                // Check if the user exists in the users table
                $stmt = $connection->prepare('SELECT * FROM users WHERE user_id = ?');
                $stmt->bind_param('i', $user_id); // 'i' for integer
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows == 0) {
                    // User does not exist, insert initial values
                    $stmt = $connection->prepare('INSERT INTO users (user_id, xp, level, badge) VALUES (?, 0, 1, "Beginner")');
                    $stmt->bind_param('i', $user_id); // 'i' for integer
                    $stmt->execute();
                }

                // Handle the streak logic
                $current_date = date('Y-m-d');
                if ($last_streak_update === $current_date) {
                    // User already logged in today; do nothing
                } else {
                    // Check if the last login was yesterday
                    $yesterday = date('Y-m-d', strtotime('-1 day'));
                    if ($last_streak_update === $yesterday) {
                        // Increment streak
                        $streak++;
                    } else {
                        // Reset streak
                        $streak = 1;
                    }
                    // Update the last streak update to today
                    $stmt_update_streak = $connection->prepare('UPDATE academic_register SET last_login = NOW(), streak = ?, last_streak_update = ? WHERE id = ?');
                    $stmt_update_streak->bind_param('isi', $streak, $current_date, $user_id);
                    $stmt_update_streak->execute();
                    $stmt_update_streak->close();
                }

                // Update last_login
                $stmt_update_last_login = $connection->prepare('UPDATE academic_register SET last_login = NOW() WHERE id = ?');
                $stmt_update_last_login->bind_param('i', $user_id);
                $stmt_update_last_login->execute();
                $stmt_update_last_login->close();

                header("Location: dashboard.php");
                exit();
            } else {
                $errors[] = "Invalid password. Please try again.";
            }
        } else {
            $errors[] = "No user found with this email.";
        }
    }

    if (!empty($errors)) {
        $_SESSION['message'] = implode(' ', $errors);
        header("Location: login.php");
        exit();
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
            <a href="#" class="small mr-3"><span class="icon-question-circle-o mr-2"></span> Have a questions?</a> 
            <a href="#" class="small mr-3"><span class="icon-phone2 mr-2"></span> 10 20 123 456</a> 
            <a href="#" class="small mr-3"><span class="icon-envelope-o mr-2"></span> info@mydomain.com</a> 
          </div>
          <div class="col-lg-3 text-right">
            <a href="login.php" class="small mr-3"><span class="icon-unlock-alt"></span> Log In</a>
            <a href="register.php" class="small btn btn-primary px-4 py-2 rounded-0"><span class="icon-users"></span> Register</a>
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
                <li>
                  <a href="index.php" class="nav-link text-left">Home</a>
                </li>
               <!--  <li class="has-children">
                  <a href="about.html" class="nav-link text-left">About Us</a>
                  <ul class="dropdown">
                    <li><a href="teachers.html">Our Teachers</a></li>
                    <li><a href="about.html">Our School</a></li>
                  </ul>
                </li> -->
               <!--  <li>
                  <a href="admissions.html" class="nav-link text-left">Admissions</a>
                </li> -->
               <!--  <li>
                  <a href="courses.html" class="nav-link text-left">Courses</a>
                </li> -->
              <!--   <li>
                    <a href="contact.html" class="nav-link text-left">Contact</a>
                  </li> -->
              </ul>                                                                                                                                                                                                                                                                                          </ul>
            </nav>

          </div>
          
         
        </div>
      </div>

    </header>

    
    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('images/bg_1.jpg')">
        <div class="container">
          <div class="row align-items-end justify-content-center text-center">
            <div class="col-lg-7">
              <h2 class="mb-0">Login</h2>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p>
            </div>
          </div>
        </div>
      </div> 
    

    <div class="custom-breadcrumns border-bottom">
      <div class="container">
        <a href="index.php">Home</a>
        <span class="mx-3 icon-keyboard_arrow_right"></span>
        <span class="current">Login</span>
      </div>
    </div>

    <div class="site-section">
        <div class="container">

          <form action="" method="POST">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="email">Email</label>
                            <input type="text" name="loginEmail" id="email" class="form-control form-control-lg">
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="pword">Password</label>
                            <input type="password" name="loginPassword" id="pword" class="form-control form-control-lg">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <input type="submit" name="login" value="Log In" class="btn btn-primary btn-lg px-5">
                        </div>
                    </div>
                  </form>
                </div>
            </div>
        </div>
      </div>

            <script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    form.addEventListener('submit', function(event) {
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('pword').value.trim();
        let errorMessage = '';

        if (email === '') {
            errorMessage += 'Email is required.\n';
        } else if (!validateEmail(email)) {
            errorMessage += 'Invalid email format.\n';
        }

        if (password === '') {
            errorMessage += 'Password is required.\n';
        }

        if (errorMessage) {
            alert(errorMessage);
            event.preventDefault(); // Prevent form submission
        }
    });

    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
});
</script>


          

    

    <div class="footer">
      <div class="container">
        <div class="row">
          <div class="col-lg-3">
            <p class="mb-4"><img src="images/logo.png" alt="Image" class="img-fluid"></p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae nemo minima qui dolor, iusto iure.</p>  
            <p><a href="#">Learn More</a></p>
          </div>
          <div class="col-lg-3">
            <h3 class="footer-heading"><span>Our Campus</span></h3>
            <ul class="list-unstyled">
                <li><a href="#">Acedemic</a></li>
                <li><a href="#">News</a></li>
                <li><a href="#">Our Interns</a></li>
                <li><a href="#">Our Leadership</a></li>
                <li><a href="#">Careers</a></li>
                <li><a href="#">Human Resources</a></li>
            </ul>
          </div>
          <div class="col-lg-3">
              <h3 class="footer-heading"><span>Our Courses</span></h3>
              <ul class="list-unstyled">
                  <li><a href="#">Math</a></li>
                  <li><a href="#">Science &amp; Engineering</a></li>
                  <li><a href="#">Arts &amp; Humanities</a></li>
                  <li><a href="#">Economics &amp; Finance</a></li>
                  <li><a href="#">Business Administration</a></li>
                  <li><a href="#">Computer Science</a></li>
              </ul>
          </div>
          <div class="col-lg-3">
              <h3 class="footer-heading"><span>Contact</span></h3>
              <ul class="list-unstyled">
                  <li><a href="#">Help Center</a></li>
                  <li><a href="#">Support Community</a></li>
                  <li><a href="#">Press</a></li>
                  <li><a href="#">Share Your Story</a></li>
                  <li><a href="#">Our Supporters</a></li>
              </ul>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="copyright">
                <p>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    

  </div>
  <!-- .site-wrap -->

  <!-- loader -->
  <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#51be78"/></svg></div>

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

</body>

</html>