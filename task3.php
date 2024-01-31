<?php
$list=[
    [
        [4, 4, 4],
        ["rrr", 5, 5]
    ],
    [
        [4, 4, 4],
        ["rrr", 5, 5]
    ]
];
writer($list);

function writer(array $currentList)
{
    foreach ($currentList as $item){
        if (is_array($item)){
            writer($item);
        } else {
            var_dump($item);
        }
    }
}