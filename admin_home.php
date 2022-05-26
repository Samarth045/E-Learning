   
   <?php  include('admin_header.php'); 
    include('dbconnect.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard </title>
    <?php 
 
    
    ?>
     <style>
    * {
        box-sizing: border-box;
    }

    /* Create two equal columns that floats next to each other */
    .column {
        float: left;
        width: 50%;
        padding: 10px;
        height: 300px;
        /* Should be removed. Only for demonstration */
    }

    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }
    </style>
</head>

<body>

<?php 
     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM categories inner join courses group by cat_name;");
    $stmt->execute();
    $studCount=$stmt->rowCount();
    $stmt = $conn->prepare("SELECT * FROM student;");
    $stmt->execute();
    $courseCount=$stmt->rowCount();
    ?>
    <body>
          
                <div class="container" style='margin-top:1rem'>
                    <div class="row">
                    <div class="col-6">
                        <ul class="nav justify-content-center">
                            <li class="nav-item">
                                <button class=" active btn btn-primary" aria-current="page" href="#">Courses(<?=$courseCount?>)</button>
                            </li>
                           
                        </ul>
                        <table class="table table-bordered">
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

                      <tbody>
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
                                      
                                      <!-- <td>
                                           <a href="upload.php?id=<?=$data['jobid']?>" class="btn btn-info"> Edit</a> 
                                      </td> -->
                                </tr>

                           <?php
                              }
                         }
                              ?>
                      </tbody>
                 </table>
                    </div>
                        <div class="col-6">
                        <ul class="nav justify-content-center">
                                                       <li class="nav-item">
                                <button class=" active btn btn-primary" href="#">Students List(<?=$studCount?>)</button>
                            </li>
                        </ul>
                        <table class="table table-bordered">
                      <thead>
                            <tr>
                                 <th>Student Id</th>
                                 <th>Full Name</th>
                                 <th>Email Id</th> 
                            </tr>
                      </thead>

                      <tbody>
                           <?php
                              
                              $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                              $stmt = $conn->prepare("select * from student");
                              $stmt->execute();
                              if($stmt->rowCount()>0){
                              while($data=$stmt->fetch(PDO::FETCH_ASSOC)){
                              
                           ?>

                                <tr>
                                      <td><?=$data['student_id']?></td>
                                      <td><?=$data['name']?></td>
                                      <td><?=$data['email']?></td>
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