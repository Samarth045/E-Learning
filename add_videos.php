<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Courses |CODEFIESTA </title>
    <?php 
    include('dbconnect.php'); 
    include('admin_header.php');

    ?>
</head>

<body>

    </div>

    <div class="container">
        <div class="row">
        <div class="col-md-6"> 
            <form method='POST'  enctype="multipart/form-data">
                <h1 class="text-center"> Add Video Content</h1>
                <div class="mb-3">
                    <label for="c_id" class="form-label">Select Course Name</label>
                    <!-- <input type="text" placeholder="enter a categories" name="categories" class="form-control">   -->
                    <select name="course_code" class="form-control">
                        <option value="">Select Course</option>
                        <?php
                                   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                   $stmt = $conn->prepare("select * from courses order by course_code ");
                                   $stmt->execute();
                                   if($stmt->rowCount()>0){
                                   while($data=$stmt->fetch(PDO::FETCH_ASSOC)){  
                                         ?><option value="<?=$data['course_code']?>"><?= $data['course_name']?>
                        </option><?php
                                    }
                              }else{
                                   ?><option>No Course found</option><?php
                              }
                        ?>
                    </select>

                </div>
                <div class="mb-3">
                    <label for="v_title" class="form-label">Video Title</label>
                    <input type="text" class="form-control" id="v_title" name="v_title" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="v_duration">Video Duration</label>
                    <input type="text" class="form-control" id="v_duration" name="v_duration" required>

                </div>
                <div class="mb-3">
                    <label class="form-label" for="v_description">Video Description</label>
                    <input type="textarea" class="form-control" id="v_description" name="v_description"
                        maxlength="1000">

                </div>
                <div class="mb-3">
                    <label class="form-label" for="video">Upload Video</label>
                    <input type="file" class="form-control" id="video" name="video" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary " name='addvideo'>Submit</button>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <table class="table">
                <thead>
                    <tr>
                    <th>video id </th>
                    <th>video Title </th>
                        <th>Course Name</th> 
                        <th>Video duration</th>
                        <th>Video description</th>   
                    </tr>
                </thead> 
                <tbody id="mytable">
                    <?php
                              $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                              $stmt = $conn->prepare("select * from course_videos inner join courses on courses.course_code=course_videos.course_code order by course_videos.vid");
                              $stmt->execute();
                              if($stmt->rowCount()>0){
                              while($data=$stmt->fetch(PDO::FETCH_ASSOC)){
                           ?>
                    <tr>
                        <td><?=$data['vid']?></td>
                        <td><?=$data['v_title']?></td>
                        <td><?=$data['course_name']?></td>
                        <td><?=$data['duration']?></td>
                        <td><?=$data['discription']?></td>  
                    </tr>
                    <?php
                              }
                         }
                              ?>
                </tbody>
            </table>
        </div>
    </div>
    </div>
</body>
</html>

<?php 
$msg = ""; 
if(isset($_POST['addvideo'])){
if (isset($_FILES["video"] ["type"])) {
    $validextensions = array("mp4");
    $temporary = explode(".", $_FILES["video"] ["name"]);
    $file_extension = end($temporary);
    if ( $_FILES["video"]["type"] == "video/mp4")
            if ($_FILES["video"] ["error"] > 0) {
            echo $_FILES["video"] ["error"]."dfsfsfd";
            $msg = $_FILES["video"] ["error"];
        } else {

            if (file_exists("../videos/" . $_FILES["video"] ["name"])) {

                $msg = "already exists.";
            } else {
                $vsourcepath = $_FILES['video'] ['tmp_name'];
                $vtargetpath = "./videos/" . $_FILES['video'] ['name'];
                move_uploaded_file($vsourcepath, $vtargetpath);
                $vphoto = $vtargetpath;
                $msg = "ok";
            }
        } else {

        $msg = "inavalid file size or type2";
    }
}
  if($msg=="ok"){  
    $msg='';
    
    $course_code=$_POST['course_code'];
     $v_title=$_POST['v_title'];
     $duration=$_POST['v_duration'];
     $discription=$_POST['v_description'];
            
          
               $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
               $stmt = $conn->prepare("insert into course_videos (           v_title,
               course_code,
               v_duration,
               v_description,
               videourl
               )  values(?,?,?,?,?)");
             
               $stmt->bindparam(1,$v_title);
            $stmt->bindparam(2,$course_code);
            $stmt->bindparam(3,$duration); 
            $stmt->bindparam(4,$discription);
            $stmt->bindparam(5,$vphoto); 
               $c=$stmt->execute();
               if($c>0){
               echo "<script>alert(' video added Successfully')</script>";
               }else{
               echo "<script>alert('Not Added')</script>";
               }
        }
    }
?>