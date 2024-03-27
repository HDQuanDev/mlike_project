<?php

require_once('../module/view.php');

if($_GET['sv'] == 1) {
    echo check_view(1);
} elseif($_GET['sv'] == 2) {
    echo check_view(2);
}
