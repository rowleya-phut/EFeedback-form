<?php
    function calcTimeTaken($unixTimeStart, $unixTimeEnd){
        $interval = $unixTimeEnd - $unixTimeStart;
        return $interval;
    }
?>