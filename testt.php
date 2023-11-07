<?php

    $date = getdate();

    echo "Thứ: ".$date['weekday']."<hr>";
    echo "Ngày: ".$date['mday']."<hr>";
    echo "Tháng: ".$date['mon']."<hr>";
    echo "Năm: ".$date['year']."<hr>";
    echo "Giờ: ".$date['hours']."<hr>";
    echo "Phút: ".$date['minutes']."<hr>";
    echo "Giây: ".$date['seconds']."<hr>";

?>