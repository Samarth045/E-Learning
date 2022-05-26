
    <?php
 session_start();
 include('dbconnect.php');
?>
<style> .nav-item {
        margin-right: 1rem;
    }
    </style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container-fluid " style='background-color:black !important; height: 50px; '  >
            <div class="row">
                <div class="col-md-6">
                    <h1 style="color:white;">KLEIT <span class="text-danger"> E-LEARNING</span></h1>
                </div>
                <div class="col-md-6">

                    <nav class="navbar navbar-expand-sm  navbar-dark">
                        <div class="container-fluid">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a href="admin_home.php" class="btn  text-light"
                                        role="button">HOME</a>&nbsp;
                                </li>
                                <li class="nav-item">
                                    <a href="categories.php" class="btn  text-light" role="button">CATEGORIES</a>&nbsp;
                                </li>
                                <li class="nav-item">
                                    <a href="add_course.php" class="btn  text-light" role="button">COURSES</a>&nbsp;
                                </li>
                                <li class="nav-item">
                                    <a href="add_videos.php" class="btn  text-light" role="button">VIDEOS</a>&nbsp;
                                </li>
                                <li class="nav-item">
                                    <a href="create_quiz.php" class="btn  text-light" role="button">QUIZ</a>&nbsp;
                                </li>
                                <?php if (!isset($_SESSION['isAdminLoggedin'])) {
?>
                                 <li class="nav-item">
                                    <div class="dropdown">
                                        <button type="button" class="btn  text-light"
                                            data-bs-toggle="dropdown">
                                            Login
                                        </button>
                                        <ul class="dropdown-menu">
                                          <li><a class="dropdown-item" href="login.php">User</a></li>
                                          <li><a class="dropdown-item" href="admin_login.php">Admin</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a href="registration.php" class="btn btn-danger" role="button">SIGNUP</a>
                                </li>
                                <?php    
}else{?>
                                <li class="nav-item">
                                    <a href="logout.php" class="btn  text-light"
                                        role="button">LOGOUT</a>&nbsp;
                                </li>
                                <?php }?>

                            </ul>
                        </div>
                    </nav>



                </div>
            </div>
        </div>
        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>