<?php 
session_start();
//including connection with server or to connect database.
include("db_connection.php");
$server = "localhost";
$user = "root";
$pass = "";
$database = "academic";

try {
    $connection = new PDO("mysql:host=$server;dbname=$database", $user, $pass);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Failed " . $e->getMessage();
}

// Fetch category from URL
$category = isset($_GET['category']) ? $_GET['category'] : '';

// Fetch questions for the selected category
$stmt = $connection->prepare('SELECT * FROM `tbl_quiz` WHERE category = ?');
$stmt->execute([$category]);
$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);


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
            <!-- <a href="login.php" class="small mr-3"><span class="icon-unlock-alt"></span> Log In</a> -->
            <!-- <a href="register.php" class="small btn btn-primary px-4 py-2 rounded-0"><span class="icon-users"></span> Register</a> -->
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
                <li class="active">
                  <a href="dashboard.php" class="nav-link text-left">Home</a>
                </li>
                <!--  <li class="has-children">
                  <a href="about.html" class="nav-link text-left">About Us</a>
                  <ul class="dropdown">
                    <li><a href="teachers.html">Our Teachers</a></li>
                    <li><a href="about.html">Our School</a></li>
                  </ul>
                </li>  -->
                <li>
                  <a href="take-quiz.php" class="nav-link text-left">Quizes</a>
                </li>
                <li>
                  <a href="" class="nav-link text-left">Courses</a>
                </li>
                <!-- <li>
                    <a href="contact.html" class="nav-link text-left">Contact</a>
                  </li> -->
                    <?php if (isset($_SESSION['email'])): ?>
          
                  <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo htmlspecialchars($_SESSION['email']); ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="profile.php">Profile</a>
                            <a class="dropdown-item" href="logout.php">Logout</a>
                        </div>
                          <?php endif; ?>
                    </li>
              </ul>                                                                                                                                                                                                                                                                                          </ul>
            </nav>

          </div>
          <!-- <div class="ml-auto">
            <div class="social-wrap">
              <a href="#"><span class="icon-facebook"></span></a>
              <a href="#"><span class="icon-twitter"></span></a>
              <a href="#"><span class="icon-linkedin"></span></a>

              <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black"><span
                class="icon-menu h3"></span></a>
            </div>
          </div> -->
         
        </div>
      </div>

    </header>

    
    <div class="hero-slide owl-carousel site-blocks-cover">
      <div class="intro-section" style="background-image: url('images/hero_1.jpg');">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-12 mx-auto text-center" data-aos="fade-up">
              <h1>Academics University</h1>
            </div>
          </div>
        </div>
      </div>

      <div class="intro-section" style="background-image: url('images/hero_1.jpg');">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-12 mx-auto text-center" data-aos="fade-up">
              <h1>You Can Learn Anything</h1>
            </div>
          </div>
        </div>
      </div>

    </div>
    

    <div></div>
    





    <div class="site-section">
      <div class="container">
        <h3 class="mb-4"><?php echo htmlspecialchars($category); ?> Quiz</h3>
        <small class="d-block mb-3">Put the letter of the correct answer in the blank input provided.</small>
        <div class="questions">
            <?php foreach ($questions as $row): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title"><?= $row['tbl_quiz_id'] ?>. <?= htmlspecialchars($row['quiz_question']) ?></h5>
                    <ul class="list-group">
                        <li class="list-group-item"><?= htmlspecialchars($row['option_a']) ?></li>
                        <li class="list-group-item"><?= htmlspecialchars($row['option_b']) ?></li>
                        <li class="list-group-item"><?= htmlspecialchars($row['option_c']) ?></li>
                        <li class="list-group-item"><?= htmlspecialchars($row['option_d']) ?></li>
                    </ul>
                    <div class="form-group mt-3">
                        <label for="answer<?= $row['tbl_quiz_id'] ?>">Answer:</label>
                        <input class="form-control w-25" id="answer<?= $row['tbl_quiz_id'] ?>" type="text" maxlength="1">
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <button type="button" class="btn btn-primary" id="submitAnswer">Submit <i class="fa-sharp fa-solid fa-share"></i></button>
    </div>
    </div>
    </div>


     <!-- Score Modal -->
    

<?php
echo '<script>';
echo 'var quizData = ' . json_encode($questions) . ';';
echo '</script>';
?>

<script>
document.getElementById("submitAnswer").addEventListener("click", function() {
    var questions = document.querySelectorAll(".card");
    var correctAnswers = 0;
    var allValid = true;

    questions.forEach(function(question, index) {
        var answerInput = question.querySelector("input");
        var userAnswer = answerInput.value.toUpperCase();
        var correctAnswer = quizData[index].correct_answer;

        if (!userAnswer || !['A', 'B', 'C', 'D'].includes(userAnswer)) {
            allValid = false;
            question.classList.add("bg-warning", "text-white");
            setTimeout(() => question.classList.remove("bg-warning", "text-white"), 4000);
        } else {
            if (userAnswer === correctAnswer) {
                correctAnswers++;
                question.classList.add("bg-success", "text-white");
            } else {
                question.classList.add("bg-danger", "text-white");
            }
        }
    });

    if (allValid) {
        // Show the total score in an alert
        alert("Your total score is: " + correctAnswers);

        // Set total score and submit it
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = 'submit_score.php';

        var scoreInput = document.createElement('input');
        scoreInput.type = 'hidden';
        scoreInput.name = 'totalScore';
        scoreInput.value = correctAnswers;
        form.appendChild(scoreInput);

        document.body.appendChild(form);
        form.submit();
    } else {
        alert("Please ensure all fields are filled out correctly with A, B, C, or D.");
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
</body>
</html>
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