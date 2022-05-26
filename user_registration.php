<?php
use PHPMailer\PHPMailer\PHPMailer;
session_start();
try{
 //fetch posted values
$name = $_POST['Fullname']; 
$emailid = $_POST['email']; 
 $password = $_POST['password']; 
 $msg="";
$status="";
    include('dbconnect.php');


    $stmt=$conn->prepare("select * from admin where Email=? and password=?;");
    $stmt->bindParam(1,$username);
    $stmt->bindParam(2,$password);
    $stmt->execute();
    $c=$stmt->rowCount();
    if($c>=1){
          $_SESSION['isLoggedin']='true';

          $_SESSION["session_email"]=$username;
          $_SESSION["session_password"]=$password;
        header("location:index.php");
    }
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("insert into student(name,email ,password)  values(?,?,?)");
    $stmt->bindparam(1, $name);
    $stmt->bindparam(2, $emailid);
    $stmt->bindparam(3, $password);
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
        $mail->addAddress($emailid, $name);
 
 
        // Create email headers
        $mail->SMTPDebug = 0;

        $mail->isHTML(true); 
        $mail->CharSet = "UTF-8";
        $mail->addCustomHeader('Content-Type', 'text/html;charset=utf-8');
        $mail->Subject = 'WelCome  To KLEIT E-Learning';
        $mail->Body = "<h3>Dear $name<br><br>Your registered Successfully</h3> <br<br>
        <h4>Your login details:<h4>
        <br>emailid or username : $emailid<br>
            password : $password<br><br><br>

            Regards<strong> KLEIT E-Learn Tutor.</strong><br>
        
        <br><br>";
                $mail->send();

            $_SESSION["isAdded"]="true";
                header("location:login.php");
     }
     else{
        echo "<script>alert('Emailid Already Exist!!')</script>";
        header("location:registration.php");
     } 
   
       
    }catch(Exception $e){
        echo "<script>alert('Emailid Already Exist!!'); window.location.replace('http://localhost/codefiest/registration.php');</script>";
       
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