<?php
session_start();
include("dbconnect.php")
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    </head>
    <body onload=" Displaynone()"> 
    <div class="container">
        <div class="row">
            <div class="col"> 
        <span id='ct' ></span>
        <?php
        $course_code = $_REQUEST["course_code"];   
        $course_name = $_REQUEST["course_name"];  
        $stmt = $conn->prepare("select * from quiz where course_code=?");
        $stmt->bindParam(1, $course_code);
        $c = $stmt->execute();
        $stmt->rowCount();
        $question_id = array();
        $question = array();
        $optionA = array();
        $optionB = array();
        $optionC = array();
        $optionD = array();
        $correctanswer=array();
        if ($c > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($question_id, $row['qid']);
                array_push($question, $row['Question']);
                array_push($optionA, $row['A']);
                array_push($optionB, $row['B']);
                array_push($optionC, $row['C']);
                array_push($optionD, $row['D']);
                array_push($correctanswer, $row['Answer']);
            }
            $arrlen = count($question_id);
            ?>
            <form method='POST' id="exam"  name="exam" action='submitexam.php?qlen=<?= $arrlen ?>'> 
                <h3 class='text-center p-2'><?=$course_name?> Questions list </h3>

                <input class='form-control-sm disabaled' type=hidden name='course_code' value=<?= $course_code ?>  readonly> 
                <input type='submit' class='btn-success btn ' style="float: right; margin-right:20px;"  value='submit'>

                <ul class="nav nav-tabs ">
    <?php for ($k = 0; $k < $arrlen; $k++) { ?>
                        <li class="nav-item ">
                            <button class="nav-link " href="#" type="button" style="margin:auto 5px;" onclick="nextQuestion(<?= $k ?>)"><?= $k + 1 ?></button>
                        </li>
    <?php } ?>
                </ul>
                </div>

                </div>
                </div>

    <?php
    for ($i = 0; $i < $arrlen; $i++) {
        $dis = '';
        $ndis = '';
        if ($i == 0) {
            $dis = "disabled";
        }
        if ($i == $arrlen - 1) {
            $ndis = "disabled";
        }
        ?>
                    <div class='container-fluid'> 
                        <div class="row" id="<?= $i ?>" style="width: 100%">
                            <div class="col-md-2"> 
                                <button class="btn-info btn  "   <?= $dis ?>  style="margin-top: 180px; " type="button" id="prev" onclick="nextQuestion(<?= $i - 1 ?>)">previous </button>   
                            </div>
                            <div class="col-md-9">
                                <ul class="list-group" >
                                    <input class="invisible    " type=text name='qid[]' value="<?= $question_id[$i] ?>" readonly></li>
                                    <li class="list-group-item">
                                    <?= $i + 1 ?> : <?= $question[$i] ?>
                                    </li> 
                                    <li class="list-group-item"><input type='radio'  name='<?= $i ?>' value='A'/> <?= $optionA[$i] ?></li>
                                    <li class="list-group-item"><input type='radio'  name='<?= $i ?>' value='B'/> <?= $optionB[$i] ?></li>
                                    <li class="list-group-item"><input type='radio'  name='<?= $i ?>' value='C'/> <?= $optionC[$i] ?></li>
                                    <li class="list-group-item"><input type='radio'  name='<?= $i ?>' value='D'/> <?= $optionD[$i] ?></li>
                                </ul>
                            </div>
                            <div class="col-md-1">                    
                                <button style="margin-top: 180px"  <?= $ndis ?>  class="btn-info btn " type="button" onclick="nextQuestion(<?= $i + 1 ?>)" id="next">Next </button>
                            </div>
                        </div>
                    </div>
    <?php }
    ?>

            </form> 
            <?php
        } else {
            echo "no questions to show";
        }
        ?>
        <script>
                            function Displaynone() {
                                for (var i = 1; i < <?= $arrlen ?>; i++) {
                                    document.getElementById(i).style.display = 'none';
                                }
                            }
                            function nextQuestion(i) {
                                document.getElementById(i).style.display = 'flex';
                                hideOthers(i);
                            }

                            function hideOthers(j) {
                                for (var i = 0; i <<?= $arrlen ?>; i++) {
                                    if (j == i) {

                                    } else {
                                        document.getElementById(i).style.display = 'none';
                                    }

                                }
                            }

        </script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>
