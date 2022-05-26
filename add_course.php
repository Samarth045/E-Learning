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
 
    <div class="container">
      <div class="row">
      <h2>Add Courses</h2>
            <div class="col-md-6">
                 <form action="add_course.php" method="post"  enctype="multipart/form-data">
                   <div class="form-group m-2">
                   <!-- <input type="text" placeholder="enter a categories" name="categories" class="form-control">   -->
                   <select name="cat_code"  class="form-control">
                        <option value="">Select Categories</option>
                        <?php
                                   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                   $stmt = $conn->prepare("select * from categories order by cat_code");
                                   $stmt->execute();
                                   if($stmt->rowCount()>0){
                                   while($data=$stmt->fetch(PDO::FETCH_ASSOC)){  
                                         ?><option value="<?=$data['cat_code']?>"><?= $data['cat_name']?></option><?php
                                    }
                              }else{
                                   ?><option>No Category found</option><?php
                              }
                        ?>
                   </select>
                   </div>


                  
                   <div class="form-group m-2">
                   <input type="text" placeholder="Enter a course Name" name="course_name" class="form-control">
                   </div>

                   <div class="form-group m-2">
                   <input type="text" placeholder="Enter Courses Description" name="discription" class="form-control">  
                   </div>

                   
                   <div class="form-group m-2">
                   <input type="text" placeholder="Enter duration" name="duration" class="form-control">
                   </div>
                   <div class="form-group m-2">
                   <input type="number" placeholder="Enter video count" name="lecture_count" class="form-control">
                   </div>
                   <div class="form-group m-2">
                   <input type="text" placeholder="Enter lecture name" name="teacher_name" class="form-control">
                   </div>
                   <div class="form-group m-2">
                   <label for="img">Select image:</label>
                     <input type="file" id="img" name="file" accept="image/*">
                   </div>
                    <input type="submit"  name="AddCourse" value="Submit" class="btn btn-primary">
                 </form>
            </div>
            <div class="col-md-6">
                 <h2 class="text-center">Existing Courses</h2>
                 <table class="table">
                      <thead>
                            <tr>
                                 <!-- <th>Course ID</th> -->
                                 <th>Course title</th>
                                 <th>Category Name</th>
                                 <th>Course duration</th> 
                                 <!-- <th>Course description</th>  -->
                                 <th>Lecture Count</th>
                                 <th>Lecture Name</th> 
                                 <!-- <th>Action</th> -->
                            </tr>
                      </thead>

                      <tbody id="mytable">
                           <?php
                              
                              $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                              $stmt = $conn->prepare("select * from courses inner join categories on courses.cat_code=categories.cat_code order by categories.cat_code");
                              $stmt->execute();
                              if($stmt->rowCount()>0){
                              while($data=$stmt->fetch(PDO::FETCH_ASSOC)){
                              
                           ?>

                                <tr>
                                      <!-- <td><?=$data['course_code']?></td> -->
                                      <td><?=$data['course_name']?></td>
                                      <td><?=$data['cat_name']?></td>
                                      <td><?=$data['duration']?></td> 
                                      <!-- <td><?=$data['discription']?></td>  -->
                                      <td><?=$data['lecture_count']?></td>
                                      <td><?=$data['teacher_name']?></td> 
                                      
                                      
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
           if(isset($_POST['AddCourse']))
           {
               $status="";
               if (isset($_FILES["file"]["type"]))
               {
                   $validextensions = array("jpeg", "jpg", "png");
               
                   //split file, extension and store into $temporary
                   $temporary = explode(".", $_FILES["file"]["name"]);
               
                   //get file extension from $temporary variable
                   $file_extension = end($temporary);
               
                   //check the mime type provided by the browser
                   if((($_FILES["file"]["type"] == "image/png")  
                           || ($_FILES["file"]["type"] == "image/jpg")
                           || ($_FILES["file"]["type"] == "image/jpeg"))  
                        && ($_FILES["file"]["size"] < 500000)  && in_array($file_extension, $validextensions))
                      {
               
                                //if file was not uploaded correctly or partially uploaded, returns 0 if valid
                             if ($_FILES["file"]["error"] > 0) 
                                     $msg = $_FILES["file"]["error"];
               
                                   //check if file is already uploaded
                                //  else if(file_exists("./pre_imgs/" . $_FILES["file"]["name"])) 
                                //   $msg = "this file already exists.";
                            else {
               
                                    $sourcePath = $_FILES['file']['tmp_name'];
                                    $targetPath = "./pre_imgs/" . $_FILES['file']['name'];
                                    $photo = $targetPath;
                                    move_uploaded_file($sourcePath, $targetPath);
                         $status = "ok";
                         $msg='ok';
                                }
                       } else {
                       $msg = "inavalid file size or type";
                   }
               }
               else {
                         $msg="please select file";
                         
               } 
               if($msg=="ok"){ 
             $course_name=$_POST['course_name'];
             $cat_code=$_POST['cat_code'];
             $duration=$_POST['duration']; 
             $discription=$_POST['discription']; 
             $lecture_count=$_POST['lecture_count'];
             $teacher_name=$_POST['teacher_name'];
          
               $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
               $stmt = $conn->prepare("insert into courses (course_name,
               cat_code,
               duration, 
               discription,
               preview_img,
               lecture_count,
               teacher_name)  values(?,?,?,?,?,?,?)");
             
               $stmt->bindparam(1,$course_name);
            $stmt->bindparam(2,$cat_code);
            $stmt->bindparam(3,$duration); 
            $stmt->bindparam(4,$discription);
            $stmt->bindparam(5,$photo);
            $stmt->bindparam(6,$lecture_count);
            $stmt->bindparam(7,$teacher_name);
               $c=$stmt->execute();
               if($c>0){
               echo "<script>alert('Add Course Successfully')</script>";
               }else{
               echo "<script>alert('Not Added')</script>";
               }
        }
     }
?>