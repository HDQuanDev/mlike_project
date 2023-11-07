<?php
if($_GET['act'] == 'on'){
 			$t6 = time();
			$myfil = fopen("s6.txt", "w+");
			 fwrite($myfil, $t6);
}elseif($_GET['act'] == 'off'){
  			$t6 = time()+1000000;
			$myfil = fopen("s6.txt", "w+");
			 fwrite($myfil, $t6);
}