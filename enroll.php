<?php
use PHPMailer\PHPMailer\PHPMailer;
session_start();
try{
 //fetch posted values
$course_code = $_GET['course_code']; 
$course_name = $_GET['course_name'];  
$duration= $_GET['duration'];  
 $msg="";
$status="";
    include('dbconnect.php');
    $Student_id=$_SESSION["session_studentid"];
    $emailid=$_SESSION["session_email"];
    $stmt=$conn->prepare("select * from enroll where course_code=? and student_id=?;");
    $stmt->bindParam(1,$course_code);
    $stmt->bindParam(2,$Student_id);
    $stmt->execute();
    $c=$stmt->rowCount();
    if($c>=1){
        echo "<script>alert('already registered');</script>window.location.replace('http://localhost/codefiest/watch.php?course_code=$course_code&course_name=$course_name');";

    }
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("insert into enroll(student_id,course_code)  values(?,?)");
    $stmt->bindparam(1, $Student_id);
    $stmt->bindparam(2, $course_code); 
    $c=$stmt->execute();
     if($c>0){ 
        require 'vendor/autoload.php';
        $mail = new PHPMailer;
        $mail->isSMTP(); 
        $mail->Host = 'smtp.gmail.com'; 
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = 'takusd2015@gmail.com';
        $mail->Password = '9972840598';
        $mail->setFrom('takusd2015@gmail.com', 'Admin@KLEIT');
        $mail->addReplyTo('takusd2015@gmail.com', 'Admin@KLEIT');
        $mail->addAddress($emailid, 'Student'); 
        // Create email headers
        $mail->SMTPDebug = 0;

        $mail->isHTML(true); 
        $mail->CharSet = "UTF-8";
        $mail->addCustomHeader('Content-Type', 'text/html;charset=utf-8');
        $mail->Subject = "You have successfully enrolled to ".$course_name;
        $mail->Body = "<h3>Dear Student<br><br you have enrolled for the course keep learning.</h3> <br<br>
        <h4>Watch anytime, anywhere<h4>
            Regards<strong> KLEIT E-Learn</strong><br>
        
        <br><br>";
                $mail->send();

            $_SESSION["isAdded"]="true"; 
            echo "<script>alert('You  have enrolled for the course!!'); window.location.replace('http://localhost/codefiest/watch.php?course_code=$course_code&course_name=$course_name&duration=$duration');</script>";
     }
     else{
        echo "<script>alert('You have already enrolled!!'); window.location.replace('http://localhost/codefiest/index.php');</script>";
     } 
   
       
    }catch(Exception $e){
        echo "<script>alert('Unexpected Error!!'); window.location.replace('http://localhost/codefiest/index.php');</script>";
       
    }
?>
<html>

<head>
    <title></title>
</head>

<body>
    <?php
			echo $msg;
		?>
</body>

</html>