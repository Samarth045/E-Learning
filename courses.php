<?php include('header_link.php');

?>
<!DOCTYPE html>
<html>

<head>
    <title>LEARN PROGRAMMING</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  
</head>

<body>
<div class="container">
   
   
       
    <?php 
        if(isset($_GET["cat_code"])){
            $course_code=array();
            $course_name=array();
            $cat_name=array();
            $duration=array();
            $img=array();
            $discription=array();
            $lecture_count=array();
            $teacher_name=array();
               $cat_code=$_GET["cat_code"];
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("select * from courses inner join categories on courses.cat_code=categories.cat_code where courses.cat_code=".$cat_code." order by categories.cat_code ");
            $stmt->execute();
            if($stmt->rowCount()>0){
            while($data=$stmt->fetch(PDO::FETCH_ASSOC)){
                array_push($course_code,$data['course_code']);
                array_push($course_name,$data['course_name']);
                array_push($cat_name,$data['cat_name']);
                array_push($duration,$data['duration']);
                array_push($discription,$data['discription']);
                array_push($lecture_count,$data['lecture_count']);
                array_push($teacher_name,$data['teacher_name']);
                array_push($img,$data['preview_img']);

            }
        }
        }
?>
 <div class="row">
      <h1><?php if(count($course_code)>0) echo $cat_name[0]?> courses</h1> 
<div class="pt-5">
</div>
<h2>Courses to get you started</h2>
<?php  for($i=0;$i<count($course_code);$i++){?>
            <div class="col-3" >
            <div class="card" style="width: 18rem;min-height:100% !important">
                    <img src="<?=$img[$i]?>" class="card-img-top" alt="<?=$img[$i]?>" style="width:18rem;height:16rem;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?=$course_name[$i]?></h5>
                        <p class="card-text"><?=$discription[$i]?></p>
                        <a href="about_course.php?course_code=<?=$course_code[$i]?>" class="btn btn-primary mt-auto" >View Course</a>
                    </div>
                </div>
                </div>
                <?php 
}
        ?> 
        
    </div>
</body>

</html>