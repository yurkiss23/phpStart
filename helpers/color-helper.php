<?php
function create_color(){
    if(!isset($_POST['submit'])){
        echo '<br><b class="text-center" style="color:black;">ПЕРЕВІРКА</b>';
    }else{
        $color=sprintf("#%02x%02x%02x",$_POST["red"],$_POST["green"],$_POST["blue"]);
        echo $color;
        echo '<br><b class="text-center" style="background-color:'.$color.';">ПЕРЕВІРКА</b>';
    }
}

?>