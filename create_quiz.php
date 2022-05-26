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
        <div class="col-md-6" style="margin:auto"> 
            <form method='POST'  enctype="multipart/form-data">
                <h1 class="text-center"> Add Quiz</h1>
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
                    <label for="txtquestion" class="form-label">Enter Question</label>
                    <input type="text" class="form-control" id="txtquestion" name="txtquestion" required>
                </div>
                <tr><td>option A</td>
                    <td><input type="text" name="txtoptionA" required="" class="form-control"/></td>
                </tr>
                <tr><td>option B</td>
                    <td><input type="text" name="txtoptionB" required="" class="form-control"/></td>
                </tr>
                <tr><td>option C</td>
                    <td><input type="text" name="txtoptionC" required="" class="form-control"/></td>
                </tr>
                <tr><td>option D</td>
                    <td><input type="text" name="txtoptionD" required="" class="form-control"/></td>
                </tr>
                <tr>
                <td>correct ans</td>
                <td>
                    A <input type="radio" name="correctanswer" value="A" style="margin-right: 20px" />
                    B <input type="radio" name="correctanswer" value="B" style="margin-right: 20px"/>
                  
                    C <input type="radio" name="correctanswer" value="C" style="margin-right: 20px"/>
                    D <input type="radio" name="correctanswer" value="D" style="margin-right: 20px"/>
                </td>
                </tr>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary " name='addQuiz'>Submit</button>
                </div>
            </form>
        </div>
          
    </div>
    </div>
</body>
</html>

<?php 
$msg = ""; 
if(isset($_POST['addQuiz'])){
    $course_code=$_POST['course_code'];  
     $question=$_POST['txtquestion'];
     $optionA=$_POST['txtoptionA'];
     $optionB=$_POST['txtoptionB'];
     $optionC=$_POST['txtoptionC'];
     $optionD=$_POST['txtoptionD'];
     $correctanswer=$_POST['correctanswer'];        
      
                $stmt = $conn->prepare("insert into quiz(Question,A,B,C,D,answer,course_code) values(?,?,?,?,?,?,?)");
                $stmt->bindParam(1, $question);
                $stmt->bindParam(2, $optionA);
                $stmt->bindParam(3, $optionB);
                $stmt->bindParam(4, $optionC);
                $stmt->bindParam(5, $optionD);
                $stmt->bindParam(6,$correctanswer);
                $stmt->bindParam(7,$course_code);
                
                $c =   $stmt->execute();
                $conn = null;
                if ($c>0) {  
                       echo "<script>alert(' Quiz added Successfully')window.location.replace('http://localhost/codefiest/create_quiz.php');</script>";
                    ?> 
                        <?php
                } else {
                    echo "<script>alert(' Quiz adding failed')window.location.replace('http://localhost/codefiest/create_quiz.php');</script>";
                } 
        
    }
?>