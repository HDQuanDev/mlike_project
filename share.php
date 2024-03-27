<?php

if($_GET['ref_code']) {
    $code = $_GET['ref_code'];
    Header('location:/reg.php?ref='.$code);
} else {
    Header('location:/index.php');
}
