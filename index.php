<?php
session_start(); 
include('dbconnect.php');
$cat_code=array();
$cat_name=array(); 
$stmt=$conn->prepare("select * from categories;");

$stmt->execute();
$c=$stmt->rowCount();
if($c>0){
    while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
        array_push($cat_code,$row['cat_code']);
        array_push($cat_name,$row['cat_name']);
    }
}

$course_code=array();
$course_name=array(); 
$stmt=$conn->prepare("select * from courses;");

$stmt->execute();
$c=$stmt->rowCount();
if($c>0){
    while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
        array_push($course_code,$row['course_code']);
        array_push($course_name,$row['course_name']);
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>LEARN PROGRAMMING</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="drop_down.css">   
    <style>
    .nav-item {
        margin-right: 1rem;
    }
   
    </style> 
</head> 
<body>
    <div style="background-image: url('b1.jpg');">
        <div class="container text-light">
            <div class="row">
                <div class="col-md-6">
                    <h1 style="color:white;">KLEIT <span class="text-danger"> E-LEARNING</span></h1>
                </div>
                <div class="col-md-6">

                    <nav class="navbar navbar-expand-sm  navbar-dark">
                        <div class="container-fluid">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a href="index.php" class="btn  text-light"
                                        role="button">HOME</a>&nbsp;
                                </li>
                                <li class="nav-item">
                                    <div class="dropdown">
                                        <button type="button" class="btn  text-light"
                                            data-bs-toggle="dropdown">
                                            CATEGORIES
                                        </button>
                                        <ul class="dropdown-menu">
                                        <?php  for($i=0;$i<count($cat_code);$i++){
        ?>     <li><a class="dropdown-item" href="courses.php?cat_code=<?=$cat_code[$i]?>"><?=$cat_name[$i]?></a></li><?php
       
    }?>
                                        </ul>
                                    </div>
                                </li>


                                <li class="nav-item">
                                    <a href="user_quiz.php" class="btn  text-light" role="button">QUIZ</a>&nbsp;
                                </li>
                                <li class="nav-item">
                                    <a href="compiler.php" class="btn  text-light" role="button">PRACTICE</a>&nbsp;
                                </li>
                                <?php if (!isset($_SESSION['isLoggedin'])) {
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
        <div class="pt-5">
        </div>
        <div class="pt-5">
        </div>
        <div class="pt-5">
        </div>
        <div class="text-center text-light pt-5">
            <h1 style="font-size: 80px;">Learn Our <span class="text-danger">COURSES</span> and<br>
                Earn New<span class="text-danger"> SKILLS</span>
            </h1>
            <br><br>
            <!-- <h1 style="font-size: 100px;">EASY WITH OUR <span class="text-danger">GYM</span></h1> -->

            <a href="#" class="btn btn-danger btn-lg" role="button">BECOME A LEARNER</a><br><br>
        </div>
        <div class="pt-5">
        </div>
        <div class="pt-5">
        </div>
        <div class="pt-5">
        </div>
        <div class="pt-5">
        </div>
        <div class="pt-5">
        </div>
        <div class="pt-5">
        </div>
    </div><br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>