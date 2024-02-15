<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

include "./task_1.php";
$list = [
    [1, 2, 3],
    [
        [4, 4, 4],
        ["rrr", 5, 5]
    ],
    7
];
writer($list);

