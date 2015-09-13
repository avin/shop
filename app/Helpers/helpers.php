<?php

/**
 * Convert solo item to array
 * @param $array
 * @return array
 */
function always_array($array){
    if (! is_array($array)){
        $array = [$array];
    }
    return $array;
}