<?php 
include('header_link.php'); 
$course_code = $_GET['course_code']; 
$course_name = $_GET['course_name'];
$duration = $_GET['duration'];  ?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
<body>
     
  <h1>Course contents</h1> 
   <?php  $vtitle=array();
    $vdescription=array();
    $videof=array();
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("select * from course_videos where course_code=".$course_code." ");
    $stmt->execute();
    if($stmt->rowCount()>0){
    while($data=$stmt->fetch(PDO::FETCH_ASSOC)){
        array_push($vtitle,$data["v_title"]);
        array_push($vdescription,$data["v_description"]);
        array_push($videof,$data["videourl"]);
    }
    }  ?>
    <h6><span class="glyphicon">&#x2a;</span><?=count($vtitle)?> lectures&nbsp;&nbsp;&nbsp;&nbsp;<span
            class="glyphicon">&#x2a;</span><?=$duration?> Total Length </h6>
    
        <div class="container-fluid">
            <div class="row">
                <div class="col col-md-8"> 
                    <?php
                    $arrlen = count($vtitle);
                    if ($arrlen > 0) {
                        ?> 
                        <div style="text-align:center"> 
                            <video id="video1" width="720">
                                <source id="vsrc" src="<?=$videof[0]?>"  type="video/mp4">
                                Your browser does not support HTML video.
                            </video>
                            <br><br>
                            <button onclick="playPause()">Play/Pause</button> 
                            <button onclick="makeBig()">Big</button>
                            <button onclick="makeSmall()">Small</button>
                            <button onclick="makeNormal()">Normal</button>
                        </div> 
                        <script>
                            var myVideo = document.getElementById("video1");
                            var vsrc = document.getElementById("vsrc");
                            function  change(src) {
                                myVideo.src=src;
                                myVideo.play();
                            }
                            function playPause() {
                                if (myVideo.paused)
                                    myVideo.play();
                                else
                                    myVideo.pause();
                            }

                            function makeBig() {
                                myVideo.width = 900;
                            }

                            function makeSmall() {
                                myVideo.width = 520;
                            }

                            function makeNormal() {
                                myVideo.width = 720;
                            }
                        </script> 


                    </div><div class="col col-md-4"  style="cursor: pointer !important;">
                        <h4><?= $course_name ?> chpaters</h4>
                        <table class="table  table-hover" style="margin-top: 20px">
                            <thead class="bg-primary">
                            <thead>
                            <th>Chapter Title</th>
                            <th>Chapter Description</th>
                            </thead>
                            <tbody>
                            <?php
                            for ($i = 0; $i < $arrlen; $i++) {
                                echo '<tr>';
                                ?><td onClick='change("<?=$videof[$i]?>")'><?=$vtitle[$i]?></td>
                            <td onClick='change("<?=$videof[$i]?>")'> <?=$vdescription[$i]?> </td>

                                <?php  
                               
                                echo '</tr>';
                            }
                            ?>
                            </tbody> 
                        </table>
                    <?php } else echo 'no chapter available'; ?>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col">
                <form method="POST">
        <h1>Upload Your comment Here</h1>
        <textarea  name="comment" rows="5" cols="70">
        </textarea><br><br>
        <input type="submit" value="Upload" name='AddComment' class="btn btn-primary"/>
        </form>
        <?php
        if(isset($_POST['AddComment']))
                {
                    $code=$_POST['comment']; 
                    $Student_id=$_SESSION["session_studentid"];
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $stmt = $conn->prepare("insert into comment (student_id,comment,course_code)  values(?,?,?)");
                    $stmt->bindparam(1,$Student_id);
                    $stmt->bindparam(2,$code);
                    $stmt->bindparam(3,$course_code);
                        $c=$stmt->execute();
                    if($c>0){
                    echo "<script>alert('Comment Added Successfully')</script>";
                    }else{
                    echo "<script>alert('Not Added')</script>";
                    } 
            }?>
                </div>
            </div>
        </div> 
        <div class="container">
            <div class="row">
                <div class="col">
                    <h4>Comments</h4>
                                <?php
                                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                    $stmt = $conn->prepare("select * from comment inner join student on comment.student_id=student.student_id where comment.course_code=?");
                                    $stmt->bindparam(1,$course_code);
                                    $stmt->execute();
                                    if($stmt->rowCount()>0){
                                    while($data=$stmt->fetch(PDO::FETCH_ASSOC)){
                                ?>
                                        <p style="border:1px solid black; padding:1rem;">
                                            <strong> <?=$data['name']?></strong><br> 
                                            <?=$data['comment']?>
                                        </p> 
                                <?php
                                    }
                                }
                      ?>  
                </div>
            </div>
        </div> 
    </body>
</html>