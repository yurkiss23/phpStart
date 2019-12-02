<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include "_styles.php";?>
    <link rel="stylesheet" href="/css/login.css">
    <title>HW</title>
</head>
<body>
<?php include "_navbar.php";
include "helpers/input-helper.php";
include "helpers/color-helper.php";
?>
<div class="container">
    <div class="row">

        <div class="col-md-6 text-center">
            <div>
                <span class="fa-stack fa-lg">
                    <i class="fa fa-square-o fa-stack-2x"></i>
                    <span>1</span>
                </span>
            </div>
            <div>
                <form method="post" action="hw-step.php">
                    <?php create_input("red","RED","text");?>
                    <?php create_input("green","GREEN","text");?>
                    <?php create_input("blue","Blue","text");?>
                    <div class="form-group">
                        <input type="submit" class="btn btn-block btn-outline-success" value="create color" name="submit"/>
                    </div>
                    <div class="form-group">

                        <?php create_color();?>

                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-6 text-center">
            <div>
                <span class="fa-stack fa-lg">
                    <i class="fa fa-square-o fa-stack-2x"></i>
                    <span>2</span>
                </span>
            </div>

            <div>
                <table id="month" class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">ПН</th>
                        <th scope="col">ВТ</th>
                        <th scope="col">СР</th>
                        <th scope="col">ЧТ</th>
                        <th scope="col">ПТ</th>
                        <th scope="col">СБ</th>
                        <th scope="col">НД</th>
                    </tr>
                    </thead>
                    <tbody>
<!--                    <tr>-->
                        <?php
                        $days=[31,28,31,30,31,30,31,31,30,31,30,31];
                        if(isset($_GET['submit'])&&$_GET['month']<12){
                            if(!$_GET['month']){
                                echo '<a href="hw-step.php" class="ForgetPwd">Оновити</a>';
                                return;
                            }
                            $count=0;
                            $day=1;
                            $week=1;
                            $total=$days[$_GET['month']-1];
                            echo '<tr></tr>';
                            while ($day!=$total){
                                if($count==7){
                                    $week++;
                                    echo '<tr></tr>';
                                    $count=0;
                                }
                                echo '<td>'.$day.'</td>';
                                $count++;
                                $day++;
                            }
                            echo '<td>'.$total.'</td>';
                        }else{
//                            echo "2";
                        }

                        ?>
<!--                    </tr>-->
                    </tbody>
                </table>
            </div>
            <form method="get" class="form-inline justify-content-center">
                <div class="form-group">
                    <input type="text"
                           class="form-control"
                           name="month"
                           placeholder="Your Month *"
                           value="">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Ok" name="submit"/>
                </div>
            </form>

        </div>

    </div>
</div>
<?php include "_scripts.php";?>
</body>
</html>