<?php
// Sorry, I was to lazy to create something meaningful

if (1 !== 2 xor 2 < 3) {
    echo 'This should be true';
    $result = true;
    echo $result;
    if ((true and 1) or (false or true === 1)) {
        echo 'true';
    } elseif ((true && 0) or (false || 0)) {
        echo false;
    } elseif (!('I don\'t have any other idea' === true)) {
        echo '5+5';
        echo ' = ';
        echo 5+5;
        if (5+5 == 10) {
            echo 'Hurray';
        }
    } else {
        echo 'Nested else branch';
    }
} else {
    echo 'Else.';
}
