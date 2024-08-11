<?php 
session_start();
include "db_connection.php";
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Academics &mdash; </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


  <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">
  <link rel="stylesheet" href="fonts/icomoon/style.css">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">

  <!-- <link rel="stylesheet" href="css/jquery.fancybox.min.css"> -->

  <link rel="stylesheet" href="css/bootstrap-datepicker.css">

  <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

  <link rel="stylesheet" href="css/aos.css">
  <link href="css/jquery.mb.YTPlayer.min.css" media="all" rel="stylesheet" type="text/css">
    
     <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


  <link rel="stylesheet" href="css/style.css">
  <style type="text/css">
    .custom-btn {
    background-color: rgb(24, 54, 97);
    color: white; /* Change text color to white for better contrast */
    border: none; /* Remove border */
}

.custom-btn:hover {
    background-color: rgb(30, 64, 115); /* Slightly lighter color for hover effect */
}
  </style>



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

      <div class="container ">
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
                  <a href="index.php" class="nav-link text-left">Home</a>
                </li>
                <!-- <li class="has-children"> -->
                  <!-- <a href="about.html" class="nav-link text-left">About Us</a> -->
                  <!-- <ul class="dropdown"> -->
                    <!-- <li><a href="teachers.html">Our Teachers</a></li> -->
                    <!-- <li><a href="about.html">Our School</a></li> -->
                  <!-- </ul> -->
                <!-- </li> -->
                 <li>
                   <a href="quiz.php" class="nav-link text-left">Add Questions</a> 
                 </li>   
                <li>
                  <a href="upload_course.php" class="nav-link text-left">Add Courses</a>
                </li>
                 <!-- <li> 
                     <a href="admin.php" class="nav-link text-left">Admin</a> 
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
         <!--  <div class="ml-auto">
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
         <nav>
                    <div class="nav nav-tabs " id="nav-tab" role="tablist">
                        <button class="nav-link active custom-btn" id="nav-home-tab" data-toggle="tab" data-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Questions</button>
                        <button class="nav-link" id="nav-profile-tab" data-toggle="tab" data-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Result</button>
                    </div>
                </nav>

                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <button type="button " class="btn custom-btn  m-2 float-left" id="add-quiz-button" data-toggle="modal" data-target="#addQuestionModal">
                            Add Question
                        </button>
                        <div class="table-area ">
                            <table class="table custom-btn">
                                <thead>
                                    <tr>
                                        <th scope="col">Quiz ID</th>
                                        <th scope="col">Question</th>
                                        <th scope="col">Correct Answer (Letter)</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php 
                                    $stmt = $connection->prepare('SELECT * FROM `tbl_quiz`');
                                    $stmt->execute();
                                    
                                    $result = $stmt->get_result();
                                    while ($row = $result->fetch_assoc()) { 
                                        $quizID = $row['tbl_quiz_id'];
                                        $quizQuestion = $row['quiz_question'];
                                        $optionA = $row['option_a'];
                                        $optionB = $row['option_b'];
                                        $optionC = $row['option_c'];
                                        $optionD = $row['option_d'];
                                        $correctAnswer = $row['correct_answer'];
                                        $category = $row['category'];
                                        ?>
                                        <tr>
                                            <th id="quizID-<?= $quizID ?>"><?= $quizID ?></th>
                                            <td id="quizQuestion-<?= $quizID ?>"><?= $quizQuestion ?></td>
                                            <td id="optionA-<?= $quizID ?>" hidden><?= $optionA ?></td>
                                            <td id="optionB-<?= $quizID ?>" hidden><?= $optionB ?></td>
                                            <td id="optionC-<?= $quizID ?>" hidden><?= $optionC ?></td>
                                            <td id="optionD-<?= $quizID ?>" hidden><?= $optionD ?></td>
                                            <td id="correctAnswer-<?= $quizID ?>"><?= $correctAnswer ?></td>
                                            <td id="category-<?= $quizID ?>"><?= $category ?></td>

                                            <td>
                                                <button type="button"  class="btn btn-secondary" onclick="updateQuestion(<?= $quizID ?>)"><i class="fas fa-pencil-alt"></i></button>
                                                <button type="button" class="btn btn-danger" onclick="deleteQuestion(<?= $quizID ?>)"><i class="fas fa-trash-alt"></i></button>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                              </table>
                            </div>
                          </div>


                                  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <table class="table custom-btn">
                            <thead>
                                <tr>
                                    <th scope="col">Result ID</th>
                                    <th scope="col">Student Name</th>
                                    <!-- <th scope="col">Year and Section</th> -->
                                    <th scope="col">Quiz Score</th>
                                    <th scope="col">Date Taken</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $stmt = $connection->prepare('SELECT * FROM `tbl_result`');
                                $stmt->execute();
                                
                                $result = $stmt->get_result();
                                while ($row = $result->fetch_assoc()) { 
                                    $resultID = $row['tbl_result_id'];
                                    $studentName = $row['quiz_taker'];
                                    // $yearSection = $row['year_section'];
                                    $totalScore = $row['total_score'];
                                    $dateTaken = $row['date_taken'];
                                    ?>
                                    <tr>
                                        <th id="resultID-<?= $resultID ?>"><?= $resultID ?></th>
                                        <td id="studentName-<?= $resultID ?>"><?= $studentName ?></td>
                                        <!-- <td id="yearSection-<?= $resultID ?>"><?= $yearSection ?></td> -->
                                        <td id="totalScore-<?= $resultID ?>"><?= $totalScore ?></td>
                                        <td id="dateTaken-<?= $resultID ?>"><?= $dateTaken ?></td>
                                        <td>
                                            <button type="button" class="btn btn-danger" onclick="deleteResult(<?= $resultID ?>)"><i class="fas fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
               </div>
             </div>
           </div>
         </div>

       <!-- Add Quiz Modal -->
    <div class="modal fade" id="addQuestionModal" tabindex="-1" aria-labelledby="addQuiz" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addQuiz">Add Question</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="quizForm" action="./endpoint/add-question.php"  method="post">
                        <div class="form-group">
                            <label for="quizQuestion">Question</label>
                            <input type="text" class="form-control" id="quizQuestion" name="quiz_question" required>
                        </div>
                        <div class="form-group">
                            <label for="optionA">Option A</label>
                            <input type="text" class="form-control" id="option_a" name="option_a" required>
                        </div>
                        <div class="form-group">
                            <label for="optionB">Option B</label>
                            <input type="text" class="form-control" id="option_b" name="option_b" required>
                        </div>
                        <div class="form-group">
                            <label for="optionC">Option C</label>
                            <input type="text" class="form-control" id="option_c" name="option_c" required>
                        </div>
                        <div class="form-group">
                            <label for="optionD">Option D</label>
                            <input type="text" class="form-control" id="option_d" name="option_d" required>
                        </div>
                        <div class="form-group">
                            <label for="correctAnswer">Correct Answer (Letter)</label>
                            <select class="form-control" id="correctAnswer" name="correct_answer" required>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="category">Category</label>
                        <input type="text" class="form-control" id="category" name="category" required>
                        <!-- Alternatively, you could use a dropdown with predefined categories -->
                        <!--
                        <select class="form-control" id="category" name="category" required>
                            <option value="HTML">HTML</option>
                            <option value="Network Security">Network Security</option>
                            <option value="Other">Other</option>
                        </select>
                        -->
                    </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    

     <!-- Update Quiz Modal -->
<div class="modal fade mt-5" id="updateQuestionModal" tabindex="-1" aria-labelledby="addQuiz" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Question</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="./endpoint/update-question.php" method="POST">
                    <div class="form-group" hidden>
                          <label for="updateQuizID">Question ID</label>
                        <input type="text" class="form-control" id="updateQuizID" name="tbl_quiz_id">
                    </div>
                    <div class="form-group">
                        <label for="updateQuestion">Question</label>
                        <input type="text" class="form-control" id="updateQuestion" name="quiz_question">
                    </div>
                    <div class="form-group">
                        <label for="updateOptionA">Option A</label>
                        <input type="text" class="form-control" id="updateOptionA" name="option_a">
                    </div>
                    <div class="form-group">
                        <label for="updateOptionB">Option B</label>
                        <input type="text" class="form-control" id="updateOptionB" name="option_b">
                    </div>
                    <div class="form-group">
                        <label for="updateOptionC">Option C</label>
                        <input type="text" class="form-control" id="updateOptionC" name="option_c">
                    </div>
                    <div class="form-group">
                        <label for="updateOptionD">Option D</label>
                        <input type="text" class="form-control" id="updateOptionD" name="option_d">
                    </div>
                    <div class="form-group">
                        <label for="updateCorrectAnswer">Correct Answer (Letter Only)</label>
                        <input type="text" class="form-control" id="updateCorrectAnswer" name="correct_answer">
                    </div>
                    <div class="form-group">
                        <label for="updateCategory">Category</label>
                        <input type="text" class="form-control" id="updateCategory" name="category" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-dark">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

   


       

    <!-- // 05 - footer -->
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
    <script src="js/script.js"> </script>





  <script src="js/main.js"></script>

</body>

</html>