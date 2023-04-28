<?php
ini_set('max_execution_time', 0); // Disable time limit

function recursive_function($count) {
    if ($count > 0) {
        recursive_function($count - 1);
    } else {
        // Perform a large number of calculations
        for ($i=0; $i<100000; $i++) {
            sqrt($i) * atan($i);
        }
    }
}

// Increase the load by calling the recursive function multiple times
for ($i=0; $i<10; $i++) {
    recursive_function(500);
}
?>
