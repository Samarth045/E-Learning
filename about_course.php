<?php 
include('header_link.php'); 
include('dbconnect.php');
  $course_code='';
  $course_name='';
  $cat_name='';
  $duration='';
  $discription='';
  $lecture_count='';
  $teacher_name='';
  $img='';
 if(isset($_GET["course_code"])){ 
   $course_code=$_GET["course_code"];
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("select * from courses where course_code=".$course_code." ");
    $stmt->execute();
    if($stmt->rowCount()>0){
    while($data=$stmt->fetch(PDO::FETCH_ASSOC)){
        $course_code=$data['course_code'];
        $course_name=$data['course_name'];
        $cat_name=$data['cat_name'];
        $duration=$data['duration'];
        $discription=$data['discription'];
        $lecture_count=$data['lecture_count'];
        $teacher_name=$data['teacher_name'];
        $img=$data['preview_img'];
    }
}
$vtitle=array();
$vdiscription=array();
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conn->prepare("select * from course_videos where course_code=".$course_code." ");
$stmt->execute();
if($stmt->rowCount()>0){
    while($data=$stmt->fetch(PDO::FETCH_ASSOC)){
        array_push($vtitle,$data["v_title"]);
        array_push($vdiscription,$data["v_discription"]);
    }
}
}
 ?>
<!DOCTYPE html>
<html>

<head>
    <title>LEARN PROGRAMMING</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> 
</head> 
<body class="bg-dark">
    <div class="container" style=" background-image: linear-gradient(black, white, white);">
        <div class="row">
            <div class="col-md-8 ">
                <div class="text-light">
                <h1><?=$course_name?></h1>
                <h5><?=$discription?></h5>
                <div class="pt-5">
                </div>
                <h6>Created by <span class="text-light"><?=$teacher_name?></span></h6>
                <h6><span class="glyphicon">&#x2a;</span> <span class="text-light">Last Updated:</span> 3/2022</h6>
                <h6><span class="glyphicon">&#x2a;</span><span class="text-light">Lang:</span>English</h6>
                <h6><span class="glyphicon">&#x2a;</span><span class="text-light">caption:</span>English</h6>
</div>
                <div class="pt-5">
                </div>
               
                <div class="pt-5">
                </div>
                <h1>Course content</h1>
                <h6><span class="glyphicon">&#x2a;</span>Lectures : <?=$lecture_count?> &nbsp;&nbsp;&nbsp;&nbsp;<span
                        class="glyphicon">&#x2a;</span>Duration of the course : <?=$duration?> </h6>
                <div class="border">
                    <ul>
                    <?php  for($i=0;$i<count($vtitle);$i++){
        ?>     <li><?=$vtitle[$i]?> <br>
          <?=$vdiscription[$i]?></li><?php
       
    }?>

                    </ul>
                </div>
                <h1></h1>
            </div>
            <div class="col-md-4">
                <div class="card" style="width: 25rem;">
              
                    <img src="<?=$img?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h4 class="card-title">Free</h4>
                        <h5 class="card-text">This course includes:</h5>
                        <ul class="card-text" >
                            <li style="line-height:40px;">1 hour on-demand video</li>
                            <li style="line-height:40px;">Full lifetime access</li>
                            <li style="line-height:40px;">Access on mobile and TV</li>
                            <li style="line-height:40px;">Certificate of completion</li><br><br>
                        </ul> 
                        <div class="text-center">
                    <?php   
                        $Student_id=$_SESSION["session_studentid"];
                        $emailid=$_SESSION["session_email"];
                        $stmt=$conn->prepare("select enrollid from enroll where course_code=? and student_id=?");
                        $stmt->bindParam(1,$course_code);
                        $stmt->bindParam(2,$Student_id);
                        $stmt->execute();
                        $isRegistered=$stmt->fetch(PDO::FETCH_ASSOC); 
                        if($isRegistered["enrollid"] ==0){?> 
                        <a href="enroll.php?course_code=<?=$course_code?>&course_name=<?=$course_name?>&duration=<?=$duration?>" class="btn btn-primary btn-lg"> ENROLL    </a>
                    <?php }else{?>
                        <a href="watch.php?course_code=<?=$course_code?>&course_name=<?=$course_name?>&duration=<?=$duration?>" class="btn btn-primary btn-lg"> Resume Course </a>
                        <?php }?>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>