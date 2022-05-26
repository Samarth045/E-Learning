<?php

 include('dbconnect.php');

?>
<!DOCTYPE html>
<html>

<head>
    <title>LEARN PROGRAMMING</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  
</head>
</body>
<?php  include('header_link.php'); ?>
<div class="container text-center">
    <form method="POST">
<h1>Upload Your Code Here</h1>

<textarea  name="code" rows="10" cols="70">

</textarea><br><br>
<input type="submit" value="Upload" name='AddCode' class="btn btn-primary"/>
</form>
<?php

if(isset($_POST['AddCode']))
           {
             
             $code=$_POST['code']; 
             $Student_id=$_SESSION["session_studentid"];
               $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
               $stmt = $conn->prepare("insert into code (student_id,code)  values(?,?)");
               $stmt->bindparam(1,$Student_id);
            $stmt->bindparam(2,$code);
                $c=$stmt->execute();
               if($c>0){
               echo "<script>alert('Add Code Successfully')</script>";
               }else{
               echo "<script>alert('Not Added')</script>";
               } 
     }?>
</div>
</body>