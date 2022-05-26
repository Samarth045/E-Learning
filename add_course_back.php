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