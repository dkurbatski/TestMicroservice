<?php
function calculate(int $number): float|int
{
    return pow($number, 3) / 2;
}
function writer(array $list): void
{
    foreach ($list as $value) {
        if (is_array($value)) {
            writer($value);
        } else {
            var_dump(is_int($value) ? calculate($value) : $value);
        }
    }
}
