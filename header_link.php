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
<style>
.nav-item {
    margin-right: 1rem;
}
</style>  
<div class="container-fluid " style='background-color:black !important; height: 50px; '>
    <div class="row">
        <div class="col-md-6">
            <h1 style="color:white;">KLEIT <span class="text-danger"> E-LEARNING</span></h1>
        </div>
        <div class="col-md-6"> 
            <nav class="navbar navbar-expand-sm  navbar-dark">
                <div class="container-fluid">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="index.php" class="btn  text-light" role="button">HOME</a>&nbsp;
                        </li>
                        <li class="nav-item">
                            <div class="dropdown">
                                <button type="button" class="btn  text-light" data-bs-toggle="dropdown">
                                    CATEGORIES
                                </button>
                                <ul class="dropdown-menu">
                                    <?php  for($i=0;$i<count($cat_code);$i++){
        ?> <li><a class="dropdown-item" href="courses.php?cat_code=<?=$cat_code[$i]?>"><?=$cat_name[$i]?></a></li><?php
       
    }?>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a href="user_quiz.php" class="btn  text-light" role="button">QUIZ</a>&nbsp;
                        </li>
                        <li class="nav-item">
                        <li class="nav-item">
                                    <a href="compiler.php" class="btn  text-light" role="button">PRACTICE</a>&nbsp;
                                </li>
                        </li>
                        <?php if (!isset($_SESSION['isLoggedin'])) {
?>
                        <li class="nav-item">
                            <a href="login.php" class="btn  text-light" role="button">LOGIN</a>&nbsp;
                        </li>
                        <li class="nav-item">
                            <a href="registration.php" class="btn btn-danger" role="button">SIGNUP</a>
                        </li>
                        <?php    
}else{?>
                        <li class="nav-item">
                            <a href="logout.php" class="btn  text-light" role="button">LOGOUT</a>&nbsp;
                        </li>
                        <?php }?>

                    </ul>
                </div>
            </nav>



        </div>
    </div>
</div>