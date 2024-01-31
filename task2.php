<?php
$a='fghjklrtyu';
for ($i=0;$i<strlen($a);$i++){
    if ($i%3==2){
        echo $a[$i];
    }
}