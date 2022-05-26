
<?php
session_start();
if(isset($_POST["vercode"])){
	if ($_POST["vercode"] != $_SESSION["vercode"] OR $_SESSION["vercode"]=='')  {
        echo "<script>alert('Incorrect verification code');</script>" ;
    } 
	else{
		echo "<script>alert('Verification code match !');</script>" ;
        session_start();
$username=$_POST['Username'];
$password=$_POST['Password'];
$_SESSION['username']=$username;

$conn=new PDO("mysql:host=localhost;dbname=codefiest","root",null);
$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
try{
    $stmt=$conn->prepare("select * from admin where Email=? and password=?;");
    $stmt->bindParam(1,$username);
    $stmt->bindParam(2,$password);
    $stmt->execute();
    $c=$stmt->rowCount();
    if($c>=1){
          $_SESSION['isAdminLoggedin']='true';

          $_SESSION["session_admin_email"]=$username;
          $_SESSION["session_admin_password"]=$password;
        header("location:admin_home.php");
    }
    else{
        $_SESSION['isAdminLoggedin']='true';
        header("location:admin_home.php"); 
        echo "Login failed";
    }
}
catch(Exception $e){
    echo "<script>alert('Unexpected Error!!'); window.location.replace('http://localhost/codefiest/admin_login.php');</script>";
}
	}
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login form Design </title>
        <link rel="stylesheet" type="text/css" href="Loginstyle.css">
    </head>
    <body>
        <div>
            
        </div>
        <div class="Loginbox">
            <img src="man.png" class="man">
            <h1> Admin Login </h1>
                <form method='post'>
                    <p> Username </p>
                    <input type="text" id="Username" name="Username" placeholder="Username" maxlength="30" required>
                    <p> Password </p>
                    <input type="Password" id="Password" name="Password" placeholder="Password" maxlength="10" required>
                   
                    <div class="form-group"> 
                    <div class="form-group small clearfix">
                        <label class="checkbox-inline">Verification Code</label>
                        <img src="captcha.php" >
                    </div>  <input type="text" name="vercode" class="form-control" placeholder="Verfication Code" required="required">
                    </div>
                    <input type="submit" value="login"><br />
                  
                </form>          
        </div>   
    </body>
</html>