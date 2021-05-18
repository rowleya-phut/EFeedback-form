<?php
    function convertUnix($unixTime){
        $date_time_format = date("F j, Y, g:i a", $unixTime);
        return $date_time_format;
    }
?>