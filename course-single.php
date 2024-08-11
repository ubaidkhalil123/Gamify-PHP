<?php
// Include database connection
include "db_connection.php";

// Get the course_id from the URL
$course_id = isset($_GET['course_id']) ? intval($_GET['course_id']) : 0;

// Fetch course details and materials
$query = "
    SELECT c.course_name, c.course_description, c.upload_date, 
           cm.material_type, cm.file_name, cm.file_path
    FROM courses c
    LEFT JOIN course_materials cm ON c.course_id = cm.course_id
    WHERE c.course_id = ?
";

$stmt = $connection->prepare($query);
if (!$stmt) {
    die("Prepare failed: (" . $connection->errno . ") " . $connection->error);
}

$stmt->bind_param("i", $course_id);

if (!$stmt->execute()) {
    die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
}

$result = $stmt->get_result();
$course = null;
$materials = [];

while ($row = $result->fetch_assoc()) {
    if ($course === null) {
        $course = [
            'course_name' => $row['course_name'],
            'course_description' => $row['course_description'],
            'upload_date' => $row['upload_date']
        ];
    }
    if ($row['material_type']) {
        $materials[] = [
            'material_type' => $row['material_type'],
            'file_name' => $row['file_name'],
            'file_path' => $row['file_path']
        ];
    }
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title><?php echo htmlspecialchars($course['course_name']); ?> &mdash; Website by Colorlib</title>
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
  <style>
    .video-container {
      position: relative;
      padding-bottom: 56.25%; /* 16:9 aspect ratio */
      height: 0;
      overflow: hidden;
      max-width: 100%;
      background: #000;
    }
    .video-container iframe {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
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
                <li><a href="dashboard.php" class="nav-link text-left">Home</a></li>
                <li class="active"><a href="courses.php" class="nav-link text-left">Courses</a></li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </header>

    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('images/bg_1.jpg')">
      <div class="container">
        <div class="row align-items-end">
          <div class="col-lg-7">
            <h2 class="mb-0"><?php echo htmlspecialchars($course['course_name']); ?></h2>
            <p><?php echo htmlspecialchars($course['course_description']); ?></p>
          </div>
        </div>
      </div>
    </div>

    <div class="custom-breadcrumns border-bottom">
      <div class="container">
        <a href="index.html">Home</a>
        <span class="mx-3 icon-keyboard_arrow_right"></span>
        <a href="courses.html">Courses</a>
        <span class="mx-3 icon-keyboard_arrow_right"></span>
        <span class="current"><?php echo htmlspecialchars($course['course_name']); ?></span>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-6 mb-4">
            <?php
            // Display course video or a placeholder image
            $video_url = '';
            foreach ($materials as $material) {
                if ($material['material_type'] == 'Video') {
                    $video_url = $material['file_path'];
                    break; // Only use the first video found
                }
            }
            if ($video_url) {
                echo '<div class="video-container">';
                echo '<iframe src="' . htmlspecialchars($video_url) . '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                echo '</div>';
            } else {
                // Default image if no video is available
                $course_image = 'images/default_course.jpg';
                echo '<p><img src="' . htmlspecialchars($course_image) . '" alt="Image" class="img-fluid"></p>';
            }
            ?>
          </div>
          <div class="col-lg-5 ml-auto align-self-center">
            <h2 class="section-title-underline mb-5">
              <span>Course Details</span>
            </h2>
            
            <p><strong class="text-black d-block">Teacher:</strong> Craig Daniel</p>
            <p class="mb-5"><strong class="text-black d-block">Hours:</strong> 8:00 am &mdash; 9:30 am</p>
            <p><?php echo htmlspecialchars($course['course_description']); ?></p>

            <ul class="ul-check primary list-unstyled mb-5">
              <!-- List course details here -->
            </ul>

            <p>
              <a href="enroll.php?course_id=<?php echo htmlspecialchars($course_id); ?>" class="btn btn-primary rounded-0 btn-lg px-5">Enroll</a>
            </p>
          </div>
        </div>
      </div>
    </div>

    <div class="section-bg style-1" style="background-image: url('images/hero_1.jpg');">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
            <span class="icon flaticon-mortarboard"></span>
            <h3>Our Philosophy</h3>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reiciendis recusandae, iure repellat quis delectus ea? Dolore, amet reprehenderit.</p>
          </div>
          <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
            <span class="icon flaticon-school-material"></span>
            <h3>Academics Principle</h3>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reiciendis recusandae, iure repellat quis delectus ea? Dolore, amet reprehenderit.</p>
          </div>
          <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
            <span class="icon flaticon-teacher"></span>
            <h3>Expert Instructors</h3>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reiciendis recusandae, iure repellat quis delectus ea? Dolore, amet reprehenderit.</p>
          </div>
        </div>
      </div>
    </div>

    <div id="loader" class="show fullscreen">
      <svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/>
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#51be78"/>
      </svg>
    </div>

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
