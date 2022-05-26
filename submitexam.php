
<?php
  include("dbconnect.php");
  include("header_link.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Exam Submitted</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <body>
        <?php
        $course_code = $_POST["course_code"];
        $arrqid = array();
        $arrans = array();
        $candidate_id = $_SESSION["session_studentid"]; 
       
        $stmt = $conn->prepare("select * from quiz where course_code=?");

        $stmt->bindParam(1, $course_code);
        $c = $stmt->execute();

        $correctanswer = array();
        if ($c > 0) {
           while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($arrqid, $row['qid']);
                array_push($correctanswer, $row['Answer']);
            }
        }

        $arlen = $_REQUEST["qlen"];
        for ($i = 0; $i < $arlen; $i++) {
            array_push($arrans, $_POST["$i"]);
        }
        $c = 0;
         $score = 0;
        for ($j = 0; $j < count($arrqid); $j++) {
            if ($correctanswer[$j] == $arrans[$j])
            {$score++;}
             
        }
    
        ?>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="text-center" >Your Performance in Quiz</h2>
                <table class="table table-success table-striped " style='width:50%; margin:auto;'>
                <tr>
                    <th class='text-center'>Total Questions</th>
                    <th class='text-center'><?= $arlen?></th>
                </tr>
                <tr>
                    <th class='text-center'>Correct Answers</th>
                    <th class='text-center'><?=$score?></th>
                </tr>
                <tr>
                    <th class='text-center'>Wrond Answers</th>
                    <th class='text-center'><?= $arlen-$score?></th>
                </tr>
                <tr>
                    <th class='text-center'>Your Score</th>
                    <th class='text-center'><?=$score?>/<?= $arlen?></th>
                </tr>
             </table>
                </div>
            </div>
        </div>
    </body>
</html>
